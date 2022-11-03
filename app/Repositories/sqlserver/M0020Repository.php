<?php
namespace App\Repositories\sqlserver;

use App\Repositories\M0020RepositoryInterface;
use App\Utill\DAO;

class M0020Repository implements M0020RepositoryInterface
{
    /**
     * getData
     *
     * @param  Array $params
     * @return Array
     */
    public function getData($params){
        return  Dao::execute('SPC_M0020_INQ1',$params); 
    }
    /**
     * getOrganization
     *
     * @param  Array $params
     * @return Array
     */
    public function getOrganization($params){
        return  Dao::execute('SPC_M0020_INQ2',$params); 
    }
     /**
     * saveOrganization
     *
     * @param  Array $params
     * @return Array
     */
    public function saveOrganization($params){
        return  Dao::execute('SPC_M0020_ACT1',$params); 
    }
    /**
     * referData
     *
     * @param  Array $params
     * @return Array
     */
    public function referData($params){
        return  Dao::execute('SPC_M0020_INQ3',$params); 
    }
    /**
     * searchData
     *
     * @param  Array $params
     * @return Array
     */
    public function searchData($params){
        return  Dao::execute('SPC_M0020_FND1',$params); 
    }
    /**
     * saveData
     *
     * @param  Array $params
     * @return Array
     */
    public function saveData($params){
        return  Dao::execute('SPC_M0020_ACT2',$params); 
    }
    /**
     * deleteData
     *
     * @param  Array $params
     * @return Array
     */
    public function deleteData($params){
        return  Dao::execute('SPC_M0020_ACT3',$params); 
    }
   
}

