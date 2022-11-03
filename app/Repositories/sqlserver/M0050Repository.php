<?php
namespace App\Repositories\sqlserver;

use App\Repositories\M0050RepositoryInterface;
use App\Utill\DAO;

class M0050Repository implements M0050RepositoryInterface
{
    /**
     * getData
     *
     * @param  Array $params
     * @return Array
     */
    public function getData($params){ 
        return Dao::execute('SPC_M0050_INQ1',$params);
    }
    /**
     * getData
     *
     * @param  Array $params
     * @return Array
     */
    public function saveData($params){ 
        return Dao::execute('SPC_M0050_ACT1',$params);
    }
  
}

