<?php
namespace App\Repositories\sqlserver;

use App\Repositories\sS0030RepositoryInterface;
use App\Utill\DAO;

class sS0030Repository implements sS0030RepositoryInterface
{
    /**
	 * referCombobox
	 * @author manhnd
	 * @created at 2022-07-22
	 * @return void
	 */
    public function referCombobox($param)
    { 
        try {
            $result = DAO::execute('SPC_M0010_LST3', $param);
            return $result;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
	 * referOrganizationCombobox
	 * @author manhnd
	 * @created at 2022-07-22
	 * @return void
	 */
    public function referOrganizationCombobox($param)
    { 
        try {
            $result = DAO::execute('SPC_S9022_FND1', $param);
            return $result;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
	 * referDataTable
	 * @author manhnd
	 * @created at 2022-07-22
	 * @return void
	 */
    public function referDataTable($param)
    { 
        try {
            $result = DAO::execute('SPC_sS0030_FND1', $param);
            return $result;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
	 * editData
	 * @author manhnd
	 * @created at 2022-07-26
	 * @return void
	 */
    public function editData($param)
    { 
        try {
            $result = DAO::execute('SPC_sS0030_ACT2', $param);
            return $result;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}

