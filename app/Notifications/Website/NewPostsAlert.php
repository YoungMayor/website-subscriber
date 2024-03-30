<?php

namespace App\Notifications\Website;

use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostsAlert extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Website $website,
        public Collection $newPosts
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $lines = [
            "Here are some new posts from **{$this->website->title}** for you to read:",
        ];

        $this->newPosts->each(function ($post) use (&$lines) {
            $lines[] = "- [{$post->title}]({$post->url}): _{$post->description}_";
            $lines[] = "";
        });

        $lines[] = "Happy Reading!!!";

        return (new MailMessage)
            ->subject("New reads for you")
            ->lines($lines);
    }
}
