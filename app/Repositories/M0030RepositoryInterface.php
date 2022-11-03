<?php
namespace App\Repositories;

interface M0030RepositoryInterface {
    /**
     * 
     *
     * @param  Array $request
     * @return Array
     */
    public function getData($request);
    public function searchData($request);
    public function saveData($request);
    public function deleteData($request);
}
