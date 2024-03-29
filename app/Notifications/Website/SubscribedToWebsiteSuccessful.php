<?php

namespace App\Notifications\Website;

use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscribedToWebsiteSuccessful extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Website $website)
    {
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
        return (new MailMessage)
            ->subject("Website Subscription Successful")
            ->lines([
                "Your subscription to the {$this->website->title} website was successful.",
            ]);
    }
}
