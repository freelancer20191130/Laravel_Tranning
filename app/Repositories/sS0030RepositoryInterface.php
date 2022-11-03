<?php
namespace App\Repositories;

interface sS0030RepositoryInterface 
{
    /**
     * referDataEmployeePopup
     *
     * @param  Array $request
     * @return Array
     */
    public function referCombobox($request);

    /**
     * referComboboxData
     *
     * @param  Array $request
     * @return Array
     */
    public function referOrganizationCombobox($request);
   
    /**
     * referDataTable
     *
     * @param  Array $request
     * @return Array
     */
    public function referDataTable($request);

    /**
     * editData
     *
     * @param  Array $request
     * @return Array
     */
    public function editData($request);
}
