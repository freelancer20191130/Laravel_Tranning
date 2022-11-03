<?php
namespace App\Repositories;

interface LibraryRepositoryInterface {
    
    /**
     * getLibrary
     *
     * @param  Array $request
     * @return Array
     */
    public function getLibrary($request);
    
}
