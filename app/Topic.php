<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int id 话题ID
 * @property string name 话题名
 * @property string bio 话题简介
 * @property integer questions_count 问题数量
 * @property integer followers_count 关注数量
 */
class Topic extends Model
{
    protected $fillable = [
        'name', 'questions_count', 'bio'
    ];


    /**
     * 问题关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions(){
        return $this->belongsToMany(Question::class)->withTimestamps();
    }


}
