<?php
namespace App\Repositories\sqlserver;

use App\Repositories\sS0020RepositoryInterface;
use App\Utill\DAO;

class Ss0020Repository implements sS0020RepositoryInterface
{
    /**
     * getData
     *
     * @param  Array $params
     * @return Array
     */
    public function getData($params){ 
        return Dao::execute('SPC_sS0020_INQ1',$params);
    }
    /**
     * searchData
     *
     * @param  Array $params
     * @return Array
     */
    public function searchData($params){ 
        return  Dao::execute('SPC_sS0020_FND1',$params);
    }
    /**
     * saveData
     *
     * @param  Array $params
     * @return Array
     */
    public function saveData($params){ 
        return  Dao::execute('SPC_sS0020_ACT1',$params);
    }

    /**
     * referData
     *
     * @param  Array $params
     * @return Array
     */
    public function referData($params){ 
        return Dao::execute('SPC_sS0020_INQ2',$params);

    }
    /**
     * deleteData
     *
     * @param  Array $params
     * @return Array
     */
    public function deleteData($params){ 
        return  Dao::execute('SPC_sS0020_ACT0',$params);

    }
}

