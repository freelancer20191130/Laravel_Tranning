<?php
namespace App\Repositories;

interface M0080RepositoryInterface {
    
    /**
     * get left_view's data
     *
     * @param  Array $request
     * @return Array
     */
    public function getLeft($request = []);

    /**
     * get right_view's data
     *
     * @param  Array $request
     * @return Array
     */
    public function getRight($request = []);

    /**
     * add new record into db
     *
     * @param  Array $request
     * @return Array
     */
    public function addNewData($request = []);

    /**
     * edit data
     *
     * @param  Array $request
     * @return Array
     */
    public function editData($request = []);

    /**
     * delete data
     *
     * @param  Array $request
     * @return Array
     */
    public function deleteData($request = []);
}
