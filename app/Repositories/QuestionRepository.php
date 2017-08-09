<?php

namespace App\Repositories;

use App\Question;
use App\Topic;

/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 3/20/2017
 * Time: 9:53 AM
 */
class QuestionRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function bgIdWithTopicsAndAnswers($id)
    {
        return Question::where(['id' => $id])->with(['topic', 'answers'])->first();
    }

    /**
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        return Question::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Question::find($id);
    }

    /**
     * @param array $topics
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic) {
            if (is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int)$topic;
            }
            $newTopic = Topic::create(['name' => $topic, 'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }

    /**
     * @return mixed
     */
    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();
    }
}