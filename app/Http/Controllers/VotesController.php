<?php

namespace App\Http\Controllers;

use App\Answer;
use Auth;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    //
    protected $answer;

    /**
     * VotesController constructor.
     * @param $answer
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function users($id)
    {
        $user = Auth::guard('api')->user();

        if ($user->haVoteFor($id)) {
            return response()->json(['voted' => true]);
        }

        return response()->json(['voted' => false]);
    }

    public function vote()
    {

        $voted = Auth::guard('api')->user()->voteFor(request('answer'));

        if (count($voted['attached']) > 0) {
            $userToFollow->notify(new NewUserFollowNotification());
            $userToFollow->increment('followers_count');

            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');

        return response()->json(['followed' => false]);
    }
}
