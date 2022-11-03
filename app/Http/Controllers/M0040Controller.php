<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\M0040RepositoryInterface as M0040Repository;
use Session;

class M0040Controller extends Controller
{
    /** M0040Repository */
    private $M0040_repo;

    public function __construct(M0040Repository $M0040_repo)
    {  
        $this->M0040_repo = $M0040_repo;
    }

    /**
	 * get view
	 * @author manhnd
	 * @created at 2022-07-12
	 * @return void
	 */
    public function getIndex(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            $company_cd = $login_session['company_cd'];
            // Call function check cooperation_typ
            $check_cooperation_typ = $this->M0040_repo->checkCooperationTyp($company_cd);
            $cooperation_typ = $check_cooperation_typ[0][0]['cooperation_typ'];
            // Call function get left_data (searching and paging) with default param
            $param['company_cd']                    =    $company_cd;
            $param['page_index']                    =    $page_index ?? 1;
            $param['page_size']                     =    $page_size ?? 10;
            $param['search_string']                 =    $search_string ?? '';
            $left_view = $this->M0040_repo->getLeft($param);
            return view('m0040.index', ['cooperation_typ' => $cooperation_typ
                                    ,   'left_view_data' => $left_view   
                                    ]);
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get left_view_data
	 * @author manhnd
	 * @created at 2022-07-12
	 * @return void
	 */
    public function getLeftData(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            // Call function check cooperation_typ
            $check_cooperation_typ = $this->M0040_repo->checkCooperationTyp($login_session['company_cd']);
            $cooperation_typ = $check_cooperation_typ[0][0]['cooperation_typ'];
            // Get value of params
            $param['company_cd']                    =    $login_session['company_cd'];
            $param['page_index']                    =    $request->page_index ?? 1;
            $param['page_size']                     =    $request->page_size ?? 10;
            $param['search_string']                 =    $request->search_string ?? '';
            // Call function get left_data (searching and paging)
            $left_view = $this->M0040_repo->getLeft($param);
            return view('m0040.left', ['cooperation_typ' => $cooperation_typ
                                    ,   'left_view_data' => $left_view   
                                    ]);
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
    public function getDataByCode(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            // Get value of params
            $param['company_cd']                    =    $login_session['company_cd'];
            $param['position_cd']                    =    $request->position_cd ?? 0;
            // Call function get data by position_cd
            $result = $this->M0040_repo->getDataByCode($param);
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
    public function addNewData(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $cre_user = $login_session['user_id'];
            // Get value of params
            $param['company_cd']                     =    $login_session['company_cd'];
            $param['position_cd']                    =    $request->position_cd ?? 0;
            $param['position_nm']                    =    $request->position_nm ?? '';
            $param['position_ab_nm']                 =    $request->position_ab_nm ?? '';
            $param['arrange_order']                  =    $request->arrange_order ?? 0;
            $param['cre_user']                       =    $cre_user ?? '';
            $param['cre_ip']                         =    $last_login_ip ?? '';
            // Call function add new record
            $result = $this->M0040_repo->addNewData($param);
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
            $param['position_cd']                    =    $request->position_cd ?? 0;
            $param['position_nm']                    =    $request->position_nm ?? '';
            $param['position_ab_nm']                 =    $request->position_ab_nm ?? '';
            $param['arrange_order']                  =    $request->arrange_order ?? 0;
            $param['upd_user']                       =    $upd_user ?? '';
            $param['upd_ip']                         =    $last_login_ip ?? '';
            // Call function add new record
            $result = $this->M0040_repo->editData($param);
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
            $param['position_cd']               =    $request->position_cd ?? 0;
            $param['del_user']                  =    $del_user ?? '';
            $param['del_ip']                    =    $last_login_ip ?? '';
            // Call stored
            $result = $this->M0040_repo->deleteData($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}
