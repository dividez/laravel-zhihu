<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 3/24/2017
 * Time: 6:07 PM
 */

namespace App\Repositories;


use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @param $id
     * @return mixed
     * @author zhangpengyi
     */
    public function byId($id)
    {
        return User::find($id);
    }
}