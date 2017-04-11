<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 4/1/2017
 * Time: 1:54 PM
 */

namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    protected function sendTo($template, $email, array $data)
    {
        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use ($email) {
            $message->from('189281351@qq.com', 'Laravel');
            $message->to($email);
        });
    }
}