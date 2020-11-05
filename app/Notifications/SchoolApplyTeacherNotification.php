<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SchoolApplyTeacherNotification extends Notification
{
    use Queueable;
    public $subject;
    public $job_apply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject,$job_apply)
    {
        $this->subject   = $subject;
        $this->job_apply = $job_apply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];  
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject($this->subject)
                ->markdown('emails.school_apply_teacher',['job_apply' => $this->job_apply]);
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
            'type'      => 'interview',
            'common_id' => $this->job_apply->id,
            'message'   => $this->subject,
        ];
    }
}
