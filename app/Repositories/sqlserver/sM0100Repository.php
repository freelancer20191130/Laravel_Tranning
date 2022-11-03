<?php
namespace App\Repositories\sqlserver;

use App\Repositories\sM0100RepositoryInterface;
use App\Utill\DAO;

class sM0100Repository implements sM0100RepositoryInterface
{
    /**
     * getData
     *
     * @param  Array $params
     * @return Array
     */
    public function getData($request){ 
        return Dao::execute('SPC_sM0100_INQ1',$request);
    }
    public function saveData($request){ 
        return Dao::execute('SPC_sM0100_ACT1',$request);
    }
}

