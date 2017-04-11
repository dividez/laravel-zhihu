<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 4/11/2017
 * Time: 5:50 PM
 */

namespace App\Mailer;

use App\User;
use Auth;

/**
 * Class UserMailer
 * @package App\Mailer
 */
class UserMailer extends Mailer
{
    /**
     * @param $email
     * @author zhangpengyi
     */
    public function followNotifyEmail($email)
    {
        // 模板变量
        $data = [
            'url' => url('http://zhihu.dev'),
            'name' => Auth::guard('api')->user()->name
        ];

        $this->sendTo('zhihu_app_new_user_follow',$email,$data);
    }


    /**
     * @param $email
     * @param $token
     * @author zhangpengyi
     */
    public function passwordReset($email, $token)
    {
        // 模板变量
        $data = [
            'url' => url('password/reset',$token),
        ];

        $this->sendTo('zhihu_app_password_reset',$email,$data);

    }


    /**
     * @param User $user
     * @author zhangpengyi
     */
    public function welcome(User $user)
    {
        // 模板变量
        $data = [
            'url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' => $user->name
        ];

        $this->sendTo('zhihu_app_register',$user->email,$data);
    }

}