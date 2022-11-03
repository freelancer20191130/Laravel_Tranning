<?php
namespace App\Repositories;

interface UserRepositoryInterface {
    
    /**
     * findById
     * @param  interger $id
     * @return array
     */
    public function findById($id);
}
