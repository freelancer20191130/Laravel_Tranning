<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\M0060RepositoryInterface as M0060Repository;
use Session;

class M0060Controller extends Controller
{
    /** M0060Repository */
    private $M0060_repo;

    public function __construct(M0060Repository $M0060_repo)
    {  
        $this->M0060_repo = $M0060_repo;
    }

    /**
	 * get view
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function getIndex(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            $company_cd = $login_session['company_cd'];
            // Call function get left_data (searching and paging) with default param
            $param['company_cd']                    =    $company_cd;
            $param['page_index']                    =    $page_index ?? 1;
            $param['page_size']                     =    $page_size ?? 10;
            $param['search_string']                 =    $search_string ?? '';
            $left_view = $this->M0060_repo->getLeft($param);
            return view('m0060.index', ['left_view_data' => $left_view]);
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get left_view_data
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function getLeftData(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            // Get value of params
            $param['company_cd']                    =    $login_session['company_cd'];
            $param['page_index']                    =    $request->page_index ?? 1;
            $param['page_size']                     =    $request->page_size ?? 10;
            $param['search_string']                 =    $request->search_string ?? '';
            // Call function get left_data (searching and paging)
            $left_view = $this->M0060_repo->getLeft($param);
            return view('m0060.left', ['left_view_data' => $left_view]);
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get data by employee_typ
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function getDataByCode(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            // Get value of params
            $param['company_cd']                    =    $login_session['company_cd'];
            $param['employee_typ']                    =    $request->employee_typ ?? 0;
            // Call function get data by position_cd
            $result = $this->M0060_repo->getDataByCode($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * add new record into M0060 table
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function addNewData(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $cre_user = $login_session['user_id'];
            // Get value of params
            $param['company_cd']                     =    $login_session['company_cd'];
            $param['employee_typ']                   =    $request->employee_typ ?? 0;
            $param['employee_typ_nm']                =    $request->employee_typ_nm ?? '';
            $param['arrange_order']                  =    $request->arrange_order ?? 0;
            $param['cre_user']                       =    $cre_user ?? '';
            $param['cre_ip']                         =    $last_login_ip ?? '';
            // Call function add new record
            $result = $this->M0060_repo->addNewData($param);
            return $result;
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
    public function editData(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $upd_user = $login_session['user_id'];
            // Get value of params
            $param['company_cd']                     =    $login_session['company_cd'];
            $param['employee_typ']                   =    $request->employee_typ ?? 0;
            $param['employee_typ_nm']                =    $request->employee_typ_nm ?? '';
            $param['arrange_order']                  =    $request->arrange_order ?? 0;
            $param['upd_user']                       =    $upd_user ?? '';
            $param['upd_ip']                         =    $last_login_ip ?? '';
            // Call function add new record
            $result = $this->M0060_repo->editData($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * delete data when click delete-btn
	 * @author manhnd
	 * @created at 2022-07-13
	 * @return void
	 */
    public function deleteData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $del_user = $login_session['user_id'];
            $param['company_cd']                =    $login_session['company_cd'];
            $param['employee_typ']              =    $request->employee_typ ?? 0;
            $param['del_user']                  =    $del_user ?? '';
            $param['del_ip']                    =    $last_login_ip ?? '';
            // Call stored
            $result = $this->M0060_repo->deleteData($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}
