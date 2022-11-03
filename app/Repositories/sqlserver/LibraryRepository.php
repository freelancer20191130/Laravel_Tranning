<?php
namespace App\Repositories\sqlserver;

use App\Repositories\LibraryRepositoryInterface;
use App\Utill\DAO;

class LibraryRepository implements LibraryRepositoryInterface
{
    /**
     * getLibrary
     *
     * @param  Array $request
     * @return Array
     */
    public function getLibrary($request)
    {
        return DAO::execute('SPC_L0010_LST1',$request);
    }
}

