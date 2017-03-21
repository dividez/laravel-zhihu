<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package App
 */
class Question extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title','body','user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author zhangpengyi
     */
    public function topic()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author zhangpengyi
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     * @author zhangpengyi
     */
    public function scopePublished($query)
    {
        return $query->where('is_hidden','F');
    }
}
