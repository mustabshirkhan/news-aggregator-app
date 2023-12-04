<?php

namespace App\Adapters;

use App\Adapters\NewsAdapter;
use Carbon\Carbon;
use App\GuardianClient\GuardianAPI;
use Illuminate\Support\Collection;

class TheGuardianAdapter implements NewsAdapter
{
    private $api;
    public function __construct()
    {
        $this->api =  new GuardianAPI(env('THE_GUARDIAN_API_KEY'));
    }

    /**
     * @return Collection
     */
    public function fetchNews()
    {
        // TODO: Implement fetchNews() method.
        $response = $this->api->content()
            ->setFromDate(new \DateTimeImmutable())
            ->setShowTags("contributor")
            ->setShowFields("starRating,headline,thumbnail,short-url,trailText")
            ->setOrderBy("relevance")
            ->fetch();
        return $this->mappingNewsData($response->response->results);
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function mappingNewsData(array $data) : Collection
    {
        $articles = collect($data)->map(function ($data) {
            return [
                'external_id' => $data->id,
                'source' => 'The Guardian',
                'author' => $data->tags[0]->webTitle ?? null,
                'title' => $data->webTitle,
                'description' => $data->fields->trailText,
                'url' => $data->webUrl,
                'published_at' => Carbon::parse($data->webPublicationDate),
                'image_url' => isset($data->fields->thumbnail) ? $data->fields->thumbnail : null,
                'category' => $data->sectionName,
            ];
        });
        return $articles;
    }
}
