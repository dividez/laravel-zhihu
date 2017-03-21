<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepositories;
use Illuminate\Http\Request;
use Auth;

/**
 * Class AnswersController
 * @package App\Http\Controllers
 */
class AnswersController extends Controller
{
    /**
     * @var AnswerRepositories
     */
    protected $answer;

    /**
     * AnswersController constructor.
     * @param $answer
     */
    public function __construct(AnswerRepositories $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param StoreAnswerRequest $request
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     * @author zhangpengyi
     */
    public function store(StoreAnswerRequest $request, $question)
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
