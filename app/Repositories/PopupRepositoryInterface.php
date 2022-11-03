<?php
namespace App\Repositories;

interface PopupRepositoryInterface
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
}
