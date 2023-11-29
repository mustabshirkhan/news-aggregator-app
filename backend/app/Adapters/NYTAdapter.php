<?php

namespace App\Adapters;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class NYTAdapter implements NewsAdapter
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'https://api.nytimes.com/svc/mostpopular/v2/emailed/1.json?api-key='.env('NYT_API_KEY');
    }

    /**
     * @return Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchNews() : Collection
    {
        // TODO: Implement fetchNews() method.
        try {
            $client = new Client();
            $response = $client->get($this->apiUrl);

            $data = json_decode($response->getBody(), true);

            Log::info('Data fetched successfully!');
            return $this->mappingNewsData($data['results']);
        } catch (\Exception $e) {
            Log::error('Error fetching and saving NYT data: ' . $e->getMessage());
            return new Collection();
        }

    }

    /**
     * @param array $data
     * @return Collection
     */
    public function mappingNewsData(array $data) : Collection
    {
        $articles = collect($data)->map(function (array $result, int $key) {
            $author = str_replace('By ', '', $result['byline']);
            return [
                'external_id' => $result['id'],
                'source' => 'New York Times',
                'author' => $author,
                'title' => $result['title'],
                'description' => $result['abstract'],
                'url' => $result['url'],
                'published_at' => $result['published_date'],
                'image_url' => !empty($result['media']) ? $result['media'][0]['media-metadata'][0]['url'] : null,
                'category' => $result['section'],
            ];
        });
        return $articles;
    }
}
