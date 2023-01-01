<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewShop extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                    ->greeting('سلام. به فروشگاه ما خوش امدید.')
                    ->line('برای شکا در سایت SF یک حساب کاربری ایجاد شد. شما می توانید به حساب کاربری خود از طریق لینک زیر دسترسی پیدا کنید و وارد حساب کاربری خود شوید.')
                    ->line('نام کاربری شما uuuu  میباشد و رمز عبور PPP می باشد.')
                    ->action('Notification Action', url('/'))
                    ->line('لطفا جهت امنیت بیشتر پس از ورود به حساب کاربری لطفا حتما روز عبور خود را تغییر دهید.!');
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
