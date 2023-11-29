<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(private NewsService $newsService)
    {
    }


    public function getAllSources()
    {
        return  response()->json($this->newsService->getSources());
    }
    public function getAllAuthors()
    {
        return  response()->json($this->newsService->getAuthors());
    }
    public function getAllCategories()
    {
        return  response()->json($this->newsService->getCategories());
    }
    public function getAllNews(Request $request)
    {
        $author = $request->input('author');
        $category = $request->input('category');
        $publishedDate = $request->input('published_date');
        $source = $request->input('source');
        $search = $request->input('q');
        $perPage = $request->input('per_page', 10); // Set a default or allow the client to specify

        $articles = $this->newsService->getFilteredArticles($author, $category, $publishedDate,$source, $search, $perPage);
        return response()->json(["data"=>$articles]);
    }
}
