<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeacherRecommendNotification extends Notification
{
    use Queueable;
    public $type;
    public $message;
    public $job;
    public $user;
    
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type,$message,$job,$user)
    {
        $this->type     = $type;
        $this->message  = $message;
        $this->job      = $job;
        $this->user     = $user;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if(!empty($this->user->email))
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
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');

         return (new MailMessage)
                ->subject('New School Matched(ID '.$this->job->user->school_id.')')
                ->markdown('emails.teacher_recommend',['job' => $this->job,'user' => $this->user]);
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
            'common_id' => $this->job->id,
            'message' => $this->message,
        ];
    }
}
