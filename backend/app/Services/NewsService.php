<?php

namespace App\Services;

use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\Preferences\PreferenceRepository;
use Illuminate\Support\Collection;
use App\Models\Article;

class NewsService
{
//    private $newsApiAdapters;
    public function __construct(private NewsRepositoryInterface $newRepository)
    {

    }
//    public function __construct(private PreferenceRepository $preferenceRepository, protected array $newsApiAdapters)
//    {
////        $this->newsApiAdapters =  $newsApiAdapters;
//    }
//    public function getAllNews(string $keyword= null, array $filters = []) : array
//    {
//        $newsData = [];
//
//        foreach ($this->newsApiAdapters as $adapter) {
//            $data = $adapter->fetchNews();
//
//            if($keyword){
//                $data =  $adapter->searchByKey($keyword);
//            }
//
//            if($keyword && !empty($filters)){
//                $data =  $adapter->filterNews($keyword, category:$filters[0], author: $filters[1], date: $filters[2]);
//            }
//            if(!$keyword && !empty($filters)){
//                $data =  $adapter->filterNews(category:$filters[0], author: $filters[1], date: $filters[2]);
//            }
//            // Transform and merge the data into the standardized format
//            $newsData = array_merge($newsData, $data);
//        }
//        return $newsData;
//
//        // TODO: Implement getByCategory() method.
//    }
//
//    public function getSources(): array
//    {
//        $sourcesData = [];
//
//        foreach ($this->newsApiAdapters as $adapter) {
//            $data = $adapter->fetchSources();
//            // Transform and merge the data into the standardized format
//            $sourcesData = array_merge($sourcesData, $data);
//        }
//
//        return $sourcesData;
//
//    }
//
//    /**
//     * @return array
//     */
//    public function getAuthors() : array
//    {
//        $authors = [];
//        $newsData =  $this->getAllNews();
//        foreach ($newsData as $data) {
//            if($data['author']){
//       //split authors into array if a news having more than one authors with comma
//                if(strpos($data['author'], ',')){
//                    $newsAuthors = explode(",", $data['author']);
//                    foreach ($newsAuthors as $key => $value){
//                        $authors[] = trim($value);
//                    }
//                }else {
//                    $authors[] =  $data['author'];
//                }
//            }
//        }
//        return $authors;
//    }
//
//    public function getByUserPreferences($userId)
//    {
//        // Retrieve the user's preferred sources, categories, and authors based on $userId
//        $userPreferences = $this->preferenceRepository->getUserPreferences($userId);
//        $preferredSources = $userPreferences->sources;
//        $preferredCategories = $userPreferences->categories;
//        $preferredAuthors = $userPreferences->authors;
//
//        // Use the retrieved preferences to fetch news data
//        $newsData = [];
//        foreach ($this->newsApiAdapters as $adapter) {
//            $adapterData = $adapter->getNewsByPreferences($preferredSources, $preferredCategories, $preferredAuthors);
//            $newsData = array_merge($newsData, $adapterData);
//        }
//
//        // Return the news data
//        return $newsData;
//    }
//
//
    /**
     * @param Collection $articles
     * @return mixed
     */
    public function importNews(Collection $articles)
    {
        return $this->newRepository->importNews($articles);
    }

    public function getFilteredArticles($author = null, $category = null, $publishedDate = null, $source = null, $search = null, $perPage = 10)
    {
        $query = Article::query();

        // Apply filters
        if ($author) {
            $query->whereIn('author', explode(",",$author));
        }

        if ($category) {
            $query->whereIn('category', explode(",",$category));
        }

        if ($publishedDate) {
            $query->whereDate('published_at', $publishedDate);
        }

        if ($source) {
            $query->whereIn('source', explode(",",$source));
        }

        // Apply search
        if ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Fetch paginated articles
        $articles = $query->orderBy('published_at', 'desc')->get();

        return $articles;
    }

    public function getAuthors()
    {
        return Article::distinct('author')
            ->whereNotNull('author') // to exclude null authors, if any
            ->pluck('author')
            ->unique()
            ->values();
    }
    public function getCategories()
    {
        return Article::distinct('category')
            ->whereNotNull('category') // to exclude null categories, if any
            ->pluck('category')
            ->unique()
            ->values();
    }

    public function getSources(): Collection
    {
        return collect(
            ['Open News','New York Times', 'The Guardian']
        );
    }

}
