<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 3/31/2017
 * Time: 10:16 AM
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

/**
 * Class SendcloudChannel
 * @package App\Channels
 */
class SendcloudChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     * @author zhangpengyi
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSendcloud($notifiable);
    }
}