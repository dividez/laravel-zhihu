<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 3/31/2017
 * Time: 10:16 AM
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SendcloudChannel
{
    public function send($notifiable,Notification $notification)
    {
        $message = $notification->toSendcloud($notifiable);
    }
}