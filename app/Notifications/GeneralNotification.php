<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    private $message;
    private $class_bg;
    private $class_icon;
    private $title;
    private $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tilte, $message, $link=null, $class_bg='bg-light-success', $class_icon='check')
    {
        $this->title = $tilte;
        $this->message = $message;
        $this->class_bg = $class_bg;
        $this->class_icon = $class_icon;
        $this->link = $link;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
            'class_bg' => $this->class_bg,
            'class_icon' => $this->class_icon,
        ];
    }
}
