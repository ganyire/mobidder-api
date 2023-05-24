<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CredentialsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $password;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $_password)
    {
        $this->password = $_password;
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
            ->subject('Your credentials')
            ->line("Hello {$notifiable->name}. Welcome to Mobidder,")
            ->line('You have been registered as a new user and here are your credentials:')
            ->line("Email is: {$notifiable->email}")
            ->line("Password is: {$this->password}")
            ->action('Sign in', route('action.login'))
            ->line('Thank you for using our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
