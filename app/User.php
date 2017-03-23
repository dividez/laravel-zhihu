<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param Model $model
     * @return bool
     * @author zhangpengyi
     */
    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author zhangpengyi
     */
    public function follows()
    {
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }

    /**
     * @param $question
     * @return array
     * @author zhangpengyi
     */
    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    /**
     * @param $question
     * @return bool
     * @author zhangpengyi
     */
    public function followed($question)
    {
        return !! $this->follows()->where('question_id',$question)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author zhangpengyi
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @param string $token
     * @author zhangpengyi
     */
    public function sendPasswordResetNotification($token)
    {
        // 模板变量
        $data = [
            'url' => url('password/reset',$token),
        ];
        $template = new SendCloudTemplate('zhihu_app_password_reset', $data);

        Mail::raw($template, function ($message) {
            $message->from('189281351@qq.com', 'Laravel');
            $message->to($this->email);
        });
    }
}
