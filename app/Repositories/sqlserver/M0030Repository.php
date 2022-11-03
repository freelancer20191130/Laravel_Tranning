<?php
namespace App\Repositories\sqlserver;

use App\Repositories\M0030RepositoryInterface;
use App\Utill\DAO;

class M0030Repository implements M0030RepositoryInterface
{
    /**
     * getData
     *
     * @param  Array $params
     * @return Array
     */
    public function getData($params){ 
        return Dao::execute('SPC_m0030_FND1',$params);
    }
    /**
     * searchData
     *
     * @param  Array $params
     * @return Array
     */
    public function searchData($params){ 
        return  Dao::execute('SPC_m0030_FND1',$params);
    }
    /**
     * saveData
     *
     * @param  Array $params
     * @return Array
     */
    public function saveData($params){ 
        return  Dao::execute('SPC_M0030_ACT1',$params);
    }
    /**
     * deleteData
     *
     * @param  Array $params
     * @return Array
     */
    public function deleteData($params){ 
        return  Dao::execute('SPC_m0030_ACT2',$params);

    }
}

