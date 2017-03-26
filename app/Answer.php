<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id 答案ID
 * @property int question_id 问题ID
 * @property int user_id 用户ID
 * @property string body 内容
 * @property string is_hidden 是否隐藏
 * @property int votes_count 点赞数量
 * @property int comments_count 评论数量
 * @property string close_comment 是否关闭评论
 */
class Answer extends Model
{
    protected $fillable = [
        'user_id', 'question_id', 'body', 'votes_count', 'comments_count', 'is_hidden', 'close_comment'
    ];

    /** 用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 问题
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
