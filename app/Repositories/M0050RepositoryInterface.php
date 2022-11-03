<?php
namespace App\Repositories;

interface M0050RepositoryInterface {
    
    /**
     * getData
     *
     * @param  $request
     * @return Array
     */
    public function getData($request);
     
    /**
     * saveData
     *
     * @param  $request
     * @return Array
     */
    public function saveData($request);

   
    
}
