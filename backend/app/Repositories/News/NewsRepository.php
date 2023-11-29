<?php

namespace App\Repositories\News;

use App\Models\Article;
use App\Adapters\NYTAdapter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class NewsRepository implements NewsRepositoryInterface
{
    public function __construct(private NYTAdapter $nytAdapter)
    {
    }
//    public function getAllNews(string $keyword,array $filters): array;
//    public function getSources(): array;
    public function importNews(Collection $articles)
    {

        try {
            Article::upsert($articles->toArray(), ['url'], ['source', 'author', 'title', 'description', 'url', 'published_at', 'image_url', 'category']);
        } catch (\Exception $e) {
            Log::error('Error fetching and saving NYT data: ' . $e->getMessage());
        }
    }

//    public function getAuthors(): array;
    public function fetchNews()
    {
        // TODO: Implement fetchNews() method.
    }
}
