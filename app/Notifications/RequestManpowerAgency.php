<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestManpowerAgency extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user_notif;
    protected $manpower;
    protected $manpower_department;
    protected $manpower_position;
    public function __construct($user_notif,$manpower,$manpower_department,$manpower_position)
    {
        //
        $this->user_notif = $user_notif;
        $this->manpower = $manpower;
        $this->manpower_department = $manpower_department;
        $this->manpower_position = $manpower_position;
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
        ->subject('Manpower Request')
        ->greeting('Good day,')
        ->line('We would like to request Manpower.')
        ->line('Requestor: '.$this->user_notif->name)
        ->line('Number of Manpower: '.$this->manpower->approved_number)
        ->line('Department : '.$this->manpower_department->name)
        ->line('Position : '.$this->manpower_position->work_name)

        ->action('Manpower Request', url('/manpower'))
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
            //
        ];
    }
}
