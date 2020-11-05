<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeacherApplySchoolAdminNotification extends Notification
{
    use Queueable;
    public $job_apply;
    public $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job_apply,$subject)
    {
         $this->job_apply = $job_apply;
         $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                ->markdown('emails.teacher_apply_school_admin',['job_apply' => $this->job_apply]);
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
            //
        ];
    }
}
