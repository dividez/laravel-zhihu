<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 * @package App
 */
class Answer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id','question_id','body'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author zhangpengyi
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author zhangpengyi
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
