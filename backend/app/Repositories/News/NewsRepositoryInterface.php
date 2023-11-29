<?php

namespace App\Repositories\News;

use Illuminate\Support\Collection;

interface NewsRepositoryInterface
{
    public function importNews(Collection $articles);
    public function fetchNews();
}
