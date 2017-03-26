<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id 问题ID
 * @property string title 问题标题
 * @property string body 问题内容
 * @property integer user_id 用户id
 * @property string is_hidden 是否隐藏
 */
class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','body','user_id'];

    /**
     * 是否展示
     * @return bool
     */
    public function is_hidden(){
        return $this->is_hidden === 'T';
    }

    /**
     * 话题
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics(){
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    /**
     * 用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * published 是否发布
     * @param $query
     * @return self
     */
    public function scopePublished($query){
        return $query->where('is_hidden', 'F');
    }

    /**
     * 答案
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
