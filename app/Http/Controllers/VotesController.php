<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Repositories\AnswerRepository;
use Auth;
use Illuminate\Http\Request;

/**
 * Class VotesController
 * @package App\Http\Controllers
 */
class VotesController extends Controller
{
    //
    /**
     * @var AnswerRepository
     */
    protected $answer;

    /**
     * VotesController constructor.
     * @param $answer
     */
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author zhangpengyi
     */
    public function users($id)
    {
        $user = Auth::guard('api')->user();

        if ($user->haVoteFor($id)) {
            return response()->json(['voted' => true]);
        }

        return response()->json(['voted' => false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @author zhangpengyi
     */
    public function vote()
    {

        $answer = $this->answer->byId(request('answer'));
        $voted = Auth::guard('api')->user()->voteFor(request('answer'));

        if (count($voted['attached']) > 0) {

            $answer->increment('votes_count');

            return response()->json(['voted' => true]);
        }

        $answer->decrement('votes_count');

        return response()->json(['voted' => false]);
    }
}
