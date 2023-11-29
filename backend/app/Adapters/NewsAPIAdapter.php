<?php

namespace App\Adapters;

use jcobhams\NewsApi\NewsApi;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class NewsAPIAdapter implements NewsAdapter
{
    private $newsApi;

    public function __construct()
    {
        $this->newsApi = new NewsApi(env('NEWSAPI_API_KEY'));
    }

    public function fetchNews(string $sources = null, string $category = null): Collection
    {
        // TODO: Implement fetchNews() method.
        $apiResponse = $this->newsApi->getTopHeadLines(sources: $sources, category: $category, country: 'us');
        return $this->mappingNewsData($apiResponse->articles);
    }
    /**
     * @param array $data
     * @return Collection
     */
    public function mappingNewsData(array $data) : Collection
    {
        $articles = collect($data)->map(function ($result, int $key) {
            $author = str_replace('By ', '', $result?->author);
            return [
                'external_id' =>$key,
                'source' => 'Open News',
                'author' => $author,
                'title' => $result?->title,
                'description' => $result?->description,
                'url' => $result?->url,
                'published_at' => Carbon::parse($result?->publishedAt),
                'image_url' => $result?->urlToImage,
                'category' => 'Business' // hardcoding category be

            ];
        });
        return $articles;
    }
    /**
     * @return array
     * @throws \jcobhams\NewsApi\NewsApiException
     */
    public function fetchSources(): array
    {
        $sources = $this->newsApi->getSources();
        return $sources->sources;
    }

    /**
     * @param string $keyword
     * @return array
     * @throws \jcobhams\NewsApi\NewsApiException
     */
    public function searchByKey(string $keyword): array
    {
        $apiResponse = $this->newsApi->getTopHeadLines(q: $keyword);
        return $this->responseTransform($apiResponse->articles);
    }

    /**
     * @param string|null $keyword
     * @param string|null $category
     * @param string|null $author
     * @param string|null $date
     * @return array
     * @throws \jcobhams\NewsApi\NewsApiException
     */
    public function filterNews(string $keyword = null, array $category = null, string $author = null, string $date = null): array
    {

        // TODO: Implement fetchNews() method.
        $apiResponse = $this->newsApi->getTopHeadLines(q: $keyword, category: $category);
        $filteredNews = $this->responseTransform($apiResponse->articles);

        if ($author) {
            $filteredNews = $this->getNewsByAuthor($filteredNews, $author);
        }

        if ($date) {
            $filteredNews = $this->getNewsByPublishDate($filteredNews, $date);
        }
        return $filteredNews;
    }

    /**
     * @param array $apiResponse
     * @return array
     */
    public function responseTransform(array $apiResponse): array
    {
        $transformedResponse = collect($apiResponse)->map(function ($item) {

            return [
                "title" => $item->title,
                "description" => $item->description,
                "image" => $item->urlToImage,
                "url" => $item->url,
                "author" => $item->author,
                "source" => $item->source,
                "published_at" => Carbon::parse($item->publishedAt)->format('m-d-y'),
            ];
        });
        return $transformedResponse->all();
    }

    /**
     * @param array $newsData
     * @param $author
     * @return array
     */
    public function getNewsByAuthor(array $newsData, $author): array
    {
        $filteredNews = array_filter($newsData, function ($obj) use ($author) {
            return $obj['author'] == $author;
        });
        return $filteredNews;
    }

    /**
     * @param array $newsData
     * @param $date
     * @return array
     */
    public function getNewsByPublishDate(array $newsData, $date): array
    {
        $filteredNews = array_filter($newsData, function ($obj) use ($date) {
            return $obj['published_at'] == $date;
        });
        return $filteredNews;
    }

}
