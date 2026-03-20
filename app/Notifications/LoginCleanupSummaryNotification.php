<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LoginCleanupSummaryNotification extends Notification
{
    use Queueable;

    public function __construct(public int $deleted, public string $cutoffDate)
    {
    }

    public function via($notifiable): array
    {
        return ['database']; // or add 'mail', 'slack', etc.
    }

    public function toDatabase($notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'message' => "[Scheduled] {$this->deleted} login attempt(s) deleted (older than {$this->cutoffDate}).",
            'type' => 'cleanup',
            'level' => 'info',
        ]);
    }
}
