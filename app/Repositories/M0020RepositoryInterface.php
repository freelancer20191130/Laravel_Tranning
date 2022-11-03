<?php
namespace App\Repositories;

interface M0020RepositoryInterface {
    
    /**
     * 
     *
     * @param  Array $request
     * @return Array
     */
    public function getData($request);
    public function getOrganization($request);
    public function saveOrganization($request);
    public function referData($request);
    public function searchData($request);
    public function saveData($request);
    public function deleteData($request);
    
}
