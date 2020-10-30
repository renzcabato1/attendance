<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestManpower extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $manpower;
    protected $name;
    protected $department;
    protected $work;

    public function __construct($manpower,$name,$department,$work)
    {
        //
        $this->manpower = $manpower;
        $this->name = $name;
        $this->department = $department;
        $this->work = $work;
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
        ->line('Ms/Mr. '.$this->name.' would like to request manpower.')
        ->line('Number of Manpower: '.$this->manpower->number_of_manpower)
        ->line('Department : '.$this->department->name)
        ->line('Position : '.$this->work->work_name)
        ->line('Remarks : '.$this->manpower->remarks)
        ->action('Manpower Request', url('/for-approval'))
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
