<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Adapters\NYTAdapter;
use App\Adapters\NewsAPIAdapter;
use App\Adapters\TheGuardianAdapter;
use Illuminate\Support\Facades\Log;
use App\Services\NewsService;

class ImportNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news from different sources and data to the database';

    protected $nytData;
    protected $newsApiData;
    protected $theGuardianApiData;
    public function __construct(private NYTAdapter $nytAdapter, private NewsAPIAdapter $newsAPIAdapter, private NewsService $newsService, private TheGuardianAdapter $theGuardianAdapter)
    {
        parent::__construct();
        $this->nytData =  $this->nytAdapter->fetchNews();
        $this->newsApiData =  $this->newsAPIAdapter->fetchNews();
        $this->theGuardianApiData =  $this->theGuardianAdapter->fetchNews();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $this->newsService->importNews($this->nytData);
            $this->info('NYT Data fetched and saved successfully!');

            $this->newsService->importNews($this->newsApiData);
            $this->info('NewsAPI Orgs Data fetched and saved successfully!');

            $this->newsService->importNews($this->theGuardianApiData);
            $this->info('The Guardian Data fetched and saved successfully!');

        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            Log::error('An error occurred while importing NYT data: ' . $e->getMessage());
        }
    }
}
