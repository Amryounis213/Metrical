<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptOfferNotification extends Notification
{
    use Queueable;

    protected $user;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        
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
            'id' => $notifiable->id,
            'title' => [
                'en' => 'Congratulations , Your Offer  was accepted',
                'ar' => 'مبروك , عرضك اصبح مقبولا ',
                'gr' => 'Herzlichen Glückwunsch, Ihr Angebot wurde angenommen'
            ],
            'body' => [
                'en' => "Congratulations, " . $this->user->first_name . "  Your property is on display  " ,
                'ar' => "مبروك, " . $this->user->first_name . "  عقارك اصبح معروضا " ,
                'gr' => "Glückwunsch, " . $this->user->first_name . "  Ihre Immobilie wird ausgestellt  " ,
            ],
            'created_at' => date('Y-m-d H:i:s.uZ'),
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
