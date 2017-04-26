<?php

namespace App;

use App\Mailer\UserMailer;
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
        (new UserMailer())->passwordReset($this->email,$token);
    }

    /**
     * 声明用户互相关注关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author zhangpengyi
     */
    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    /**
     * @param $user
     * @return array
     * @author zhangpengyi
     */
    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author zhangpengyi
     */
    public function followersUser()
    {
        return $this->belongsToMany(self::class,'followers','followed_id','follower_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author zhangpengyi
     */
    public function votes()
    {
        return $this->belongsToMany(Answer::class,'votes')->withTimestamps();
    }

    /**
     * @param $answer
     * @return array
     * @author zhangpengyi
     */
    public function voteFor($answer)
    {
        return $this->votes()->toggle($answer);
    }

    /**
     * @param $answer
     * @return bool
     * @author zhangpengyi
     */
    public function haVoteFor($answer)
    {
        return !! $this->votes()->where('answer_id',$answer)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author zhangpengyi
     */
    public function messages()
    {
        return $this->hasMany(Message::class,'to_user_id');
    }
}
