<?php
namespace App\Repositories\sqlserver;

use App\Repositories\M0080RepositoryInterface;
use App\Utill\DAO;
use Session;

class M0080Repository implements M0080RepositoryInterface
{
    /**
	 * get left_view data 
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function getLeft($request = [])
    {   
        try {
            $result = DAO::execute('SPC_M0080_LST1', $request); 
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get right_view data 
	 * @author manhnd
	 * @created at 2022-07-14
	 * @return void
	 */
    public function getRight($request = [])
    {   
        try {
            $result = DAO::execute('SPC_M0080_LST2', $request); 
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

     /**
	 * add new data into db 
	 * @author manhnd
	 * @created at 2022-07-19
	 * @return void
	 */
    public function addNewData($request = [])
    {   
        try {
            $param['company_cd'] = $request['company_cd'];
            $param['m0080_obj'] = json_encode($request['m0080_obj']);
            $param['m0081_obj'] = json_encode($request['m0081_obj']);
            $param['m0082_obj'] = json_encode($request['m0082_obj']);
            $param['cre_user'] = $request['cre_user'];
            $param['cre_ip'] = $request['cre_ip'];
            $result = DAO::execute('SPC_M0080_ACT1', $param); 
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * edit data  
	 * @author manhnd
	 * @created at 2022-07-19
	 * @return void
	 */
    public function editData($request = [])
    {   
        try {
            $param['company_cd'] = $request['company_cd'];
            $param['m0080_obj'] = json_encode($request['m0080_obj']);
            $param['m0081_obj'] = json_encode($request['m0081_obj']);
            $param['m0082_obj'] = json_encode($request['m0082_obj']);
            $param['upd_user'] = $request['upd_user'];
            $param['upd_ip'] = $request['upd_ip'];
            $result = DAO::execute('SPC_M0080_ACT2', $param); 
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * delete data
	 * @author manhnd
	 * @created at 2022-07-20
	 * @return void
	 */
    public function deleteData($request = [])
    {   
        try {
            $result = DAO::execute('SPC_M0080_ACT3', $request); 
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}

