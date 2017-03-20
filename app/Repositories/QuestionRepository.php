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
     * @author zhangpengyi
     */
    public function bgIdWithTopics($id)
    {
        return Question::where(['id' => $id])->with('topic')->first();
    }

    /**
     * @param array $data
     * @return static
     * @author zhangpengyi
     */
    public function create(array $data)
    {
        return Question::create($data);
    }

    /**
     * @param $id
     * @return mixed
     * @author zhangpengyi
     */
    public function byId($id)
    {
        return Question::find($id);
    }
    /**
     * @param array $topics
     * @return array
     * @author zhangpengyi
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function($topic){
            if (is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int) $topic;
            }
            $newTopic = Topic::create(['name'=>$topic,'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }

    /**
     * @return mixed
     * @author zhangpengyi
     */
    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();
    }
}