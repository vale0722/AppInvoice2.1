<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ExportReady extends Notification
{
    public $file, $type,  $firstCreationDate, $finalCreationDate, $state;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($file, $type, $firstCreationDate, $finalCreationDate, $state)
    {
        $this->file = $file;
        $this->type = $type;
        $this->firstCreationDate = $firstCreationDate;
        $this->finalCreationDate = $finalCreationDate;
        $this->state = $state;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => $this->type,
            'link' => $this->file,
            'firstCreationDate' => $this->firstCreationDate,
            'finalCreationDate' => $this->finalCreationDate,
            'state' => $this->state,
        ];
    }
}
