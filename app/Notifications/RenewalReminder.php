<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RenewalReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $customername;
    public $policyname;
    public $policy_no;

    public function __construct($customername,$policyname,$policy_no)
    {
        $this->customername = $customername;
        $this->policyname = $policyname;
        $this->policy_no = $policy_no;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('This is the renewal reminder for policy: '.$this->policyname)
                    ->line('Policy no. :'.$this->policy_no)
                    ->line('Customer name : '.$this->customername)
                    ->line('Please Login and check the policy')
                    ->action('Login', url('/admin/login'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
