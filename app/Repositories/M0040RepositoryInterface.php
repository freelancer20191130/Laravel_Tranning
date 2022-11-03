<?php
namespace App\Repositories;

interface M0040RepositoryInterface {
    
    /**
     * check cooperation in m0040 screen
     *
     * @param  Array $request
     * @return Array
     */
    public function checkCooperationTyp($request);
    

    /**
     * get left_view's data
     *
     * @param  Array $request
     * @return Array
     */
    public function getLeft($request = []);

    /**
     * refer data by code 
     *
     * @param  Array $request
     * @return Array
     */
    public function getDataByCode($request = []);

    /**
     * add new record when click save-btn
     *
     * @param  Array $request
     * @return Array
     */
    public function addNewData($request = []);

    /**
     * edit record when click save-btn
     *
     * @param  Array $request
     * @return Array
     */
    public function editData($request = []);

    /**
     * delete record when click delete-btn
     *
     * @param  Array $request
     * @return Array
     */
    public function deleteData($request = []);
}
