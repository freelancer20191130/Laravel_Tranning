<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\M0010RepositoryInterface as M0010Repository;
use Session;

class M0010Controller extends Controller
{
    /** M0010Repository */
    private $M0010_repo;

    public function __construct(M0010Repository $M0010_repo)
    {  
        $this->M0010_repo = $M0010_repo;
    }

    /**
	 * get view
	 * @author manhnd
	 * @created at 2022-07-01
	 * @return void
	 */
    public function getIndex(Request $request)
    {
        try {
            $result = $this->searchData($request);

            $cooperation = $result[3][0]['cooperation_typ'];
            if ($cooperation == 1) {
                return view('m0010.index', ['cooperation_typ' => $cooperation, 'list_data_refer' => $result]);
            }
            else {
                return view('m0010.index', ['cooperation_typ' => $cooperation, 'list_data_refer' => $result]);
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        
    }

     /**
	 * search data
	 * @author manhnd
	 * @created at 2022-07-05
	 * @return void
	 */
    public function searchData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            $company_cd = $login_session['company_cd'];
            $page_index = $request->page_index ?? 1;
            $page_size = $request->page_size ?? 3;
            $search_string = $request->search_string ?? '';
            
            $result = $this->M0010_repo->getIndex($company_cd, $page_index, $page_size, $search_string);
            if($request->ajax()){
                return view('m0010.left', ['list_data_refer' => $result]);
            }else{
                return $result;
            } 
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }

    /**
	 * get data (inputs) when click item of list-search
	 * @author manhnd
	 * @created at 2022-07-01
	 * @return void
	 */
    public function getDataByCode(Request $request) 
    {
        try {
            $param['company_cd']               =    $request->company_cd;
            $param['office_cd']                =    $request->office_cd;
            $result = $this->M0010_repo->getDataByCode($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }

    /**
	 * save data when click save-btn
	 * @author manhnd
	 * @created at 2022-07-04
	 * @return void
	 */
    public function addNewData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $cre_user = $login_session['user_id'];
            $param['company_cd']                =    $request->company_cd ?? '';
            $param['office_cd']                 =    $request->office_cd ?? '';
            $param['office_nm']                 =    $request->office_nm ?? '';
            $param['office_ab_nm']              =    $request->office_ab_nm ?? '';
            $param['zip_cd']                    =    $request->zip_cd ?? '';
            $param['address1']                  =    $request->address1 ?? '';
            $param['address2']                  =    $request->address2 ?? '';
            $param['address3']                  =    $request->address3 ?? '';
            $param['tel']                       =    $request->tel ?? '';
            $param['fax']                       =    $request->fax ?? '';
            $param['responsible_cd']            =    $request->responsible_cd ?? '';
            $param['arrange_order']             =    $request->arrange_order ?? '';
            $param['cre_user']                  =    $cre_user ?? '';
            $param['cre_ip']                    =    $last_login_ip ?? '';
            // Call stored
            $result = $this->M0010_repo->addNewData($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        
    }

    /**
	 * save data when click save-btn
	 * @author manhnd
	 * @created at 2022-07-04
	 * @return void
	 */
    public function editData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $upd_user = $login_session['user_id'];
            $param['company_cd']                =    $request->company_cd ?? '';
            $param['office_cd']                 =    $request->office_cd ?? '';
            $param['office_nm']                 =    $request->office_nm ?? '';
            $param['office_ab_nm']              =    $request->office_ab_nm ?? '';
            $param['zip_cd']                    =    $request->zip_cd ?? '';
            $param['address1']                  =    $request->address1 ?? '';
            $param['address2']                  =    $request->address2 ?? '';
            $param['address3']                  =    $request->address3 ?? '';
            $param['tel']                       =    $request->tel ?? '';
            $param['fax']                       =    $request->fax ?? '';
            $param['responsible_cd']            =    $request->responsible_cd ?? '';
            $param['arrange_order']             =    $request->arrange_order ?? '';
            $param['upd_user']                  =    $upd_user ?? '';
            $param['upd_ip']                    =    $last_login_ip ?? '';
            // Call stored
            $result = $this->M0010_repo->editData($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }

    /**
	 * delete data
	 * @author manhnd
	 * @created at 2022-07-04
	 * @return void
	 */
    public function deleteData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $del_user = $login_session['user_id'];
            $param['company_cd']                =    $request->company_cd ?? '';
            $param['office_cd']                 =    $request->office_cd ?? '';
            $param['del_user']                  =    $del_user ?? '';
            $param['del_ip']                    =    $last_login_ip ?? '';
            // Call stored
            $result = $this->M0010_repo->deleteData($param);
            return $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }
}
