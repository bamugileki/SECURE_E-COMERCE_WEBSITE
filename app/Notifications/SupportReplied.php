<?php

namespace App\Notifications;

use App\Models\SupportMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SupportReplied extends Notification
{
    use Queueable;

    public function __construct(
        public SupportMessage $message,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "Your support ticket \"{$this->message->subject}\" has received a reply.",
            'url' => route('support.ticket', $this->message->id),
        ];
    }
}