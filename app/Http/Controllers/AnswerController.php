<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Auth;

class AnswerController extends Controller
{
    protected $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    /**
     * 保存答案
     * @param Request $request
     * @param int $question 问题ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $question)
    {
        $answer = $this->answer->create([
            'question_id' => $question,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ]);
        $answer->question()->increment('answers_count');
        return back();
    }
}
