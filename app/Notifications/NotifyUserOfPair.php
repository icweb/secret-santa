<?php

namespace App\Notifications;

use App\Pair;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyUserOfPair extends Notification
{
    use Queueable;

    private $pair;

    /**
     * Create a new notification instance.
     *
     * @param Pair $pair
     * @return void
     */
    public function __construct(Pair $pair)
    {
        $this->pair = $pair;
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
                    ->subject('Secret Santa Results')
                    ->greeting('Hey ' . $this->pair->user->name . ',')
                    ->line('The Secret Santa results are in, you have __' . $this->pair->pair->name . '__.')
                    ->salutation('Ho Ho Ho');
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
