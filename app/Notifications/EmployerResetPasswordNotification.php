<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class EmployerResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        // $frontendUrl = url('/custom-reset-password-form');

        return (new MailMessage)
            ->subject('Reset Your NKA Employer Account Password') // Custom subject
            ->greeting('Hello!')
            ->line('We received a request to reset the password for your NKA **Employer** account.')
            ->action('Reset Password', url(config('app.url').route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
                'guard' => $notifiable->authGuardName() ?? 'web',
            ], false)))
            ->line('This password reset link will expire in '.config('auth.passwords.'.config('auth.defaults.passwords').'.expire').' minutes.')
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('Regards, NKA Support Team');
    }
}
