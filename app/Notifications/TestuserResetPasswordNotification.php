<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class TestuserResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
            'guard' => $notifiable->authGuardName() ?? 'web',

        ], false));

        $expiry = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        return (new MailMessage)
            ->subject('Reset Your NKA Testuser Account Password')
            ->greeting('Hello!')
            ->line('We received a request to reset the password for your NKA Testuser account.')
            ->action('Reset Password', $resetUrl)
            ->line("This password reset link will expire in {$expiry} minutes.")
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('Regards, NKA Support Team');
    }
}
