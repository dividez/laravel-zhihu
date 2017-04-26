<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App
 */
class Message extends Model
{
    //
    /**
     * @var array
     */
    protected $fillable = ['from_user_id','to_user_id','body'];

    /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author zhangpengyi
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author zhangpengyi
     */
    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user_id');
    }
}
