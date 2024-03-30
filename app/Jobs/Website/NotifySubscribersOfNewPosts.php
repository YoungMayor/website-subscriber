<?php

namespace App\Jobs\Website;

use App\Models\Website;
use App\Notifications\Website\NewPostsAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifySubscribersOfNewPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Website $website)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $newPosts = $this->website->newPosts()->limit(10)->get();

        $subscribers = $this->website->subscribedUsers()->get();

        Notification::send($subscribers, new NewPostsAlert($this->website, $newPosts));

        $this->website->update(['last_alert_time' => now()]);
    }
}
