<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptUserNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $need;
    protected $status;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $need, $status)
    {
        $this->user = $user;
        $this->need = $need;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable){
        return [
           'title' => [
               'User Accepted'
           ], 
           'body'=> [
              'en' => "Hi, ". $this->user->first_name . "  Your Request to be  ". $this->need . " Is " . $this->status,
              'ar' => 'اهلا ' . $this->user->first_name . "طلبك لكي"
           ]
        ];
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
