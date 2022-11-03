<?php
namespace App\Repositories\sqlserver;

use App\Repositories\M0040RepositoryInterface;
use App\Utill\DAO;
use Session;

class M0040Repository implements M0040RepositoryInterface
{
    /**
	 * check cooperation in m0040 screen
	 * @author manhnd
	 * @created at 2022-07-12
	 * @return void
	 */
    public function checkCooperationTyp($company_cd)
    {   
        try {
            $param['company_cd']               =    $company_cd;
            $result = DAO::execute('SPC_M0001_LST1', $param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get left_view data 
	 * @author manhnd
	 * @created at 2022-07-12
	 * @return void
	 */
    public function getLeft($request = [])
    {   
        try {
            $result = DAO::execute('SPC_M0040_LST1', $request); 
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get data by position_cd
	 * @author manhnd
	 * @created at 2022-07-12
	 * @return void
	 */
    public function getDataByCode($request = [])
    {
        try {
            $result = DAO::execute('SPC_M0040_LST2', $request); 
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * add new record into M0040 table
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function addNewData($request = [])
    {
        try {
            $this->respon['status']     = OK;
            $result = DAO::execute('SPC_M0040_ACT1', $request); 
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                $this->respon['errors'] = $result[0];
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * edit record when click save-btn
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function editData($request = [])
    {   
        try {
            $this->respon['status']     = OK;
            $result = DAO::execute('SPC_M0040_ACT2', $request);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                $this->respon['errors'] = $result[0];
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * delete record when click delete-btn
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function deleteData($request = [])
    {   
        try {
            $this->respon['status']     = OK;
            $result = DAO::execute('SPC_M0040_ACT3', $request);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                $this->respon['errors'] = $result[0];
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}

