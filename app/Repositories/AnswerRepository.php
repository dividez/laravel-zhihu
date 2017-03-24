<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 3/21/2017
 * Time: 3:55 PM
 */

namespace App\Repositories;


use App\Answer;

/**
 * Class AnswerRepositories
 * @package App\Repositories
 */
class AnswerRepository
{
    /**
     * @param array $data
     * @return static
     * @author zhangpengyi
     */
    public function create(array $data)
    {
        return Answer::create($data);
    }
}