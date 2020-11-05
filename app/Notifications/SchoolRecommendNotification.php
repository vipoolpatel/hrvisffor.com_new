<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SchoolRecommendNotification extends Notification
{
    use Queueable;
    public $type;
    public $message;
    public $school;
    public $teacher;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type,$message,$school,$teacher)
    {
        $this->type     = $type;
        $this->message  = $message;
        $this->school   = $school;
        $this->teacher     = $teacher;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
       if(!empty($this->school->email))
        {
            return ['mail','database'];    
        }
        else
        {
            return ['database'];       
        }
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
                ->subject('New Teacher Matched(ID '.$this->teacher->teacher_id.')')
                ->markdown('emails.school_recommend',['school' => $this->school,'teacher' => $this->teacher]);
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
            'common_id' => $this->teacher->id,
            'message' => $this->message,
        ];
    }
}
