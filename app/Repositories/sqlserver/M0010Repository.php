<?php
namespace App\Repositories\sqlserver;

use App\Repositories\M0010RepositoryInterface;
use App\Utill\DAO;
use Exception;

class M0010Repository implements M0010RepositoryInterface
{
    /**
	 * checkCooperationTyp
	 * @author manhnd
	 * @created at 2022-07-01
	 * @return void
	 */
    public function checkCooperationTyp($company_cd)
    {   
        try {
            $param['company_cd']               =    $company_cd;
            $result = DAO::execute('SPC_M0001_LST1', $param);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
	 * get information => refer
	 * @author manhnd
	 * @created at 2022-07-01
	 * @return void
	 */
    public function getIndex($company_cd, $page_index, $page_size, $search_string)
    {   
        try {
            $param['company_cd']                    =    $company_cd;
            $param['page_index']                    =    $page_index;
            $param['page_size']                     =    $page_size;
            $param['search_string']                 =    $search_string;
            $result = $this->checkCooperationTyp($param['company_cd']);
            $cooperation = $result[0][0]['cooperation_typ'];    
            // if cooperation_typ = 1 => cant use btn 新規追加, 登録, 削除 (FROM M0001)
            $result = DAO::execute('SPC_M0010_LST1', $param);
            array_push($result, [['cooperation_typ' => $cooperation]]);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get data by company_cd and office_cd => refer
	 * @author manhnd
	 * @created at 2022-07-04
	 * @return void
	 */
    public function getDataByCode($request)
    {   
        try {
            $param['company_cd']                    =    $request['company_cd'];
            $param['office_cd']                     =    $request['office_cd'];
            // Call stored
            $result = DAO::execute('SPC_M0010_LST2', $param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * addNewData into DB
	 * @author manhnd
	 * @created at 2022-07-04
	 * @return void
	 */
    public function addNewData($param)
    {   
        try {
            $this->respon['status']     = OK;
            $result = DAO::execute('SPC_M0010_ACT1', $param);
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
	 * editData
	 * @author manhnd
	 * @created at 2022-07-04
	 * @return void
	 */
    public function editData($param)
    {   
        try {
            $this->respon['status']     = OK;
            $result = DAO::execute('SPC_M0010_ACT2', $param);
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
	 * deleteData
	 * @author manhnd
	 * @created at 2022-07-04
	 * @return void
	 */
    public function deleteData($param)
    {   
        try {
            $this->respon['status']     = OK;
            $result = DAO::execute('SPC_M0010_ACT3', $param);
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

