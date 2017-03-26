<?php
namespace App\Repositories;


use App\Question;
use App\Topic;

class QuestionRepository
{

    /**
     * 通过问题ID查询问题
     * @param $id
     * @return mixed
     */
    public function byIdWithTopics($id)
    {
        return $question = Question::where('id', $id)->with(['topics'])->first();
    }

    /**
     * 创建问题
     * @param array $attributes
     * @return Question
     */
    public function create(array $attributes)
    {
        return Question::create($attributes);
    }


    /**
     * 处理话题
     * @param $topics
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
            if(is_numeric($topic)){
                Topic::find($topic)->increment('questions_count');
                return (int) $topic;
            }
            /** @var Topic $newTopic*/
            $newTopic = Topic::create(['name' => $topic, 'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }
}