<?php
namespace App\Repositories;

interface sS0020RepositoryInterface {
    
    /**
     * 
     *
     * @param  Array $request
     * @return Array
     */
    public function getData($request);
    public function searchData($request);
    public function saveData($request);
    public function referData($request);
    public function deleteData($request);
    
}
