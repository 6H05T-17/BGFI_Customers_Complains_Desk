<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReclamationNotification extends Notification
{
    use Queueable;

    public $reclamation;
    public $action;
    public $message;

    public function __construct($reclamation, $action, $message)
    {
        $this->reclamation = $reclamation;
        $this->action = $action;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'reclamation_id' => $this->reclamation->id,
            'numero' => $this->reclamation->numero,
            'action' => $this->action,
            'message' => $this->message,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}