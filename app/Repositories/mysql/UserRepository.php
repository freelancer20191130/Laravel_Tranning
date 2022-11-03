<?php
namespace App\Repositories\mysql;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    /**
     * findById
     * @param  interger $id
     * @return array
     */
    public function findById($id)
    {
        return User::findOrFail($id)->toArray();
    }
}

