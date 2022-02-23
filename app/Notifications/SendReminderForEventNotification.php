<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendReminderForEventNotification extends Notification
{
    use Queueable;

    protected $events;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($events)
    {
        //  $event = Event::findOrFail($event_id);
        $this->events = $events;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->from('metrical@info', 'Metrical Member')
            ->line(__('remember you have an :name event tomorrow :date', ['name' => $this->events->title_ar, 'date' => $this->events->start_date]))
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toDatabase($notifiable)
    {

        return [
            'id' => $this->events->id,
            'title' => [
                'en' => $this->events->title_en,
                'ar' => $this->events->title_ar,
                'gr' => $this->events->title_gr,
            ],
            'body' => [
                'en' => $this->events->description_en,
                'ar' => $this->events->description_ar,
                'gr' => $this->events->description_gr,
            ],

            'created_at' => date('Y-m-d H:i:s.uZ')
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
