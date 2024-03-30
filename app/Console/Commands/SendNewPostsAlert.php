<?php

namespace App\Console\Commands;

use App\Jobs\Website\NotifySubscribersOfNewPosts;
use App\Models\Website;
use Illuminate\Console\Command;

class SendNewPostsAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-new-posts-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compile and send new posts alert';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $websites = Website::chunk(100, function ($websites) {
            foreach ($websites as $website) {
                $newPostsCount = $website->newPosts()->count();

                if (!$newPostsCount) {
                    $this->info('No new posts in ' . $website->title);

                    continue;
                }

                $this->info('Found ' . $newPostsCount . ' new posts in ' . $website->title);

                NotifySubscribersOfNewPosts::dispatch($website);
            }
        });
    }
}
