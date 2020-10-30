<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApprovedManpower extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $request;
    protected $agency_selected;
    protected $approved_by;
    public function __construct($request,$agency_selected,$approved_by)
    {
        //
        $this->request = $request;
        $this->agency_selected = $agency_selected;
        $this->approved_by = $approved_by;
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
        ->subject('Approved Request')
        ->greeting('Good day,')
        ->line('Your request of manpower has been approved.')
        ->line('Number of Manpower: '.$this->request->number_of_manpower)
        ->line('Remarks : '.$this->request->remarks)
        ->line('Approved by : '.$this->approved_by)
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
