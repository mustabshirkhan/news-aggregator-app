<?php

namespace App\Providers;

use App\Adapters\NewsAPIAdapter;
use App\Adapters\NYTAdapter;
use App\Repositories\News\NewsRepository;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\Preferences\EloquentPreferenceRepository;
use App\Repositories\Preferences\PreferenceRepository;
use App\Services\NewsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
        $this->app->when(NewsService::class)
            ->needs('$newsApiAdapters')
            ->give(function () {
                return [
                    app(NewsAPIAdapter::class),
                    app(NYTAdapter::class),
                ];
            });
        $this->app->bind(PreferenceRepository::class, EloquentPreferenceRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
