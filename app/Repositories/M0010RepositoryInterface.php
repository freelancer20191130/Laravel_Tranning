<?php
namespace App\Repositories;

interface M0010RepositoryInterface {
    
    /**
     * createM0010
     *
     * @param  Array $request
     * @return Array
     */
    public function checkCooperationTyp($request);
    

    /**
     * referData
     *
     * @param  Array $request
     * @return Array
     */
    public function getIndex($request1, $request2, $request3, $request4);

    /**
     * getDataByCode
     *
     * @param  Array $request
     * @return Array
     */
    public function getDataByCode($request);

    /**
     * addNewData
     *
     * @param  Array $request
     * @return Array
     */
    public function addNewData($request);

    /**
     * editData
     *
     * @param  Array $request
     * @return Array
     */
    public function editData($request);

    /**
     * deleteData
     *
     * @param  Array $request
     * @return Array
     */
    public function deleteData($request);
}
