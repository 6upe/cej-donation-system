<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class ResetPasswordNotification extends Notification
{
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Specify the notification delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail']; // ✅ Ensure Laravel knows it should be sent via email
    }

    /**
     * Send password reset email.
     */
    public function toMail($notifiable)
    {
        $resetUrl = url('auth/reset-password/' . $this->token);

        // ✅ Use Laravel’s default MailMessage or a custom Mailable
        return (new MailMessage)
            ->subject('Reset Your Password')
            ->greeting('Hello!')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $resetUrl)
            ->line('If you did not request a password reset, no further action is required.');
    }
}