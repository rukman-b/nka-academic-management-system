<?php

namespace App\Traits;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notification;

trait SendsCustomPasswordResetNotification
{
    public function sendPasswordResetNotification($token): void
    {
        $guard = $this->getGuardName();

        $this->notify(new class($token, $guard, $this) extends Notification {
            public string $token;
            public string $guard;
            public object $notifiable;

            public function __construct(string $token, string $guard, object $notifiable)
            {
                $this->token = $token;
                $this->guard = $guard;
                $this->notifiable = $notifiable;
            }

            public function via(object $notifiable): array
            {
                return ['mail'];
            }

            public function toMail(object $notifiable)
            {
                $routeName = "{$this->guard}.password.reset";

                $resetUrl = url(route($routeName, [
                    'token' => $this->token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false));

                return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('Reset Your Password')
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset Password', $resetUrl)
                    ->line('If you did not request a password reset, no further action is required.');
            }
        });
    }

   /**
     * Automatically detect the guard name from the model class.
     * Override this method in the model if custom mapping is needed.
     *
     * @return string
     */
    protected function getGuardName(): string
    {
        $class = class_basename($this); // e.g., 'User', 'Student', 'Employer'

        // Special case: Laravel's default User model maps to 'web'
        return $class === 'User'
            ? 'web'
            : Str::snake($class);
    }
}
