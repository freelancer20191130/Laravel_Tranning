<?php
namespace App\Repositories\sqlserver;

use App\Repositories\PopupRepositoryInterface;
use App\Utill\DAO;
use Exception;

class PopupRepository implements PopupRepositoryInterface
{
    /**
	 * referDataEmployeePopup
	 * @author manhnd
	 * @created at 2022-07-06
	 * @return void
	 */
    public function referCombobox($param)
    { 
        try {
            $result = DAO::execute('SPC_M0010_LST3', $param);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
	 * referComboboxData
	 * @author manhnd
	 * @created at 2022-07-07
	 * @return void
	 */
    public function referOrganizationCombobox($param)
    { 
        try {
            $result = DAO::execute('SPC_S9022_FND1', $param);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
	 * referDataTable
	 * @author manhnd
	 * @created at 2022-07-07
	 * @return void
	 */
    public function referDataTable($param)
    { 
        try {
            $result = DAO::execute('SPC_sS0030_FND2', $param);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

