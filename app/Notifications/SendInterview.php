<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendInterview extends Notification
{
    use Queueable;
    private $applier_id;
    private $job_id;
    private $date;
    private $time;
    private $notes;

    /**
     * Create a new notification instance.
     */
    public function __construct($applier_id,$job_id,$date,$time,$notes)
    {
        $this->applier_id = $applier_id;
        $this->job_id = $job_id;
        $this->date = $date;
        $this->time = $time;
        $this->notes = $notes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable)
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'applier_id'=> $this->applier_id,
            'job_id'=> $this->job_id,
            'date'=> $this->date,
            'time'=> $this->time,
            'notes'=> $this->notes
        ];
    }
}
