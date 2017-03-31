<?php

namespace App\Notifications;

use App\Channels\SendcloudChannel;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Naux\Mail\SendCloudTemplate;
use Mail;

class NewUserFollowNotification extends Notification
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
        return ['database',SendcloudChannel::class];
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
                    ->action('Notification Action', 'https://laravel.com')
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

    public function toDatabase($notifiable)
    {
        return [
            'name' => Auth::guard('api')->user()->name,
        ];
    }

    public function toSendcloud($notifiable)
    {
        // 模板变量
        $data = [
            'url' => url('http://zhihu.dev'),
            'name' => Auth::guard('api')->user()->name
        ];
        $template = new SendCloudTemplate('zhihu_app_new_user_follow', $data);

        Mail::raw($template, function ($message) use ($notifiable) {
            $message->from('189281351@qq.com', 'Laravel');
            $message->to($notifiable->email);
        });
    }
}
