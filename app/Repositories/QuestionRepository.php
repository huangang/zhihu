<?php
namespace App\Repositories;


use App\Question;
use App\Topic;

class QuestionRepository
{

    /**
     * 通过问题ID查询问题和话题和答案
     * @param $id
     * @return mixed
     */
    public function byIdWithTopicsAndAnswers($id)
    {
        return $question = Question::where('id', $id)->with(['topics', 'answers'])->first();
    }

    /**
     * 通过问题ID查询问题
     * @param $id
     * @return Question
     */
    public function byId($id)
    {
        return Question::find($id);
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

    /**
     * 问题流
     * @return mixed
     */
    public function getQuestionFeed(){
        return Question::published()->latest('updated_at')->with('user')->get();
    }
}