<?php

namespace App\Notifications\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\PersonalAccessToken;

class LoginSuccessful extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public PersonalAccessToken $token)
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
        $loginTime = date_create($this->token->created_at)->format('d M Y H:i:s');

        return (new MailMessage)
            ->subject('New Successful Login on your account')
            ->lines([
                "We wanted to let you know that a new login to your account was
                detected on **$loginTime**. If you did not initiate this
                login, we recommend that you reset your password immediately.",
                "If you did initiate this login, you can safely ignore this email.",
                "Thank you for your attention to this matter!"
            ]);
    }
}
