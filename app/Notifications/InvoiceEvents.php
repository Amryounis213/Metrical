<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class InvoiceEvents extends Notification
{
    use Queueable;
    protected $events;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Event $events)
    {
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
        return [
            'database',
            FcmChannel::class
        ];
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
    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData(['url' => config('app.url') . "/api/events/" . $this->events->id])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('Account Activated')
                
                ->setBody(
                    [
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
                ]
                )
                // ->setImage('https://matjr.host/uploads/logo2.jpeg')
                )
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )
            ->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
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
