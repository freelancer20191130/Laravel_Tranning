<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\sS0030RepositoryInterface as sS0030Repository;
use Session;

class sS0030Controller extends Controller
{
    /** sS0030_repoRepository */
    private $sS0030_repo;

    public function __construct(sS0030Repository $sS0030_repo)
    {  
        $this->sS0030_repo = $sS0030_repo;
        $this->respon['status']     = OK; 
        $this->respon['errors']     = [];
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
            $login_session = Session::get('login_session');
            $param['company_cd']                =  $login_session['company_cd'];
            $param['setting_authority_cd']      =  $login_session['setting_authority_cd'];
            // Call function
            $cbx_M0022_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'M0022']);
            $cbx_M0060_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'M0060']);
            $cbx_M0040_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'M0040']);
            $cbx_S9020_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'S9020']);
            $other_cbx_results = [$cbx_M0022_data, $cbx_M0060_data, $cbx_M0040_data, $cbx_S9020_data];
            $organization_cbx_results = $this->sS0030_repo->referOrganizationCombobox($param);
            $table_result = [[]];
            return view('sS0030.index', ['organization_cbx_data' => $organization_cbx_results
                                                    , 'other_cbx_results' => $other_cbx_results
                                                    , 'table_result' => $table_result]);
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }

    /**
	 * searchData
	 * @author manhnd
	 * @created at 2022-07-25
	 * @return void
	 */
    public function searchData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');   
            $param['company_cd']                        = $login_session['company_cd'];
            $param['employee_cd']                       = $request->employee_cd ?? '';
            $param['employee_nm']                       = $request->employee_nm ?? '';
            $param['employee_typ']                      = $request->employee_typ ?? 0;
            $param['position_cd']                       = $request->position_cd ?? 0;
            $param['organization_cd_1']                 = $request->organization_cd_1 ?? '';
            $param['organization_cd_2']                 = $request->organization_cd_2 ?? '';
            $param['organization_cd_3']                 = $request->organization_cd_3 ?? '';
            $param['organization_cd_4']                 = $request->organization_cd_4 ?? '';
            $param['organization_cd_5']                 = $request->organization_cd_5 ?? '';
            $param['authority_cd']                      = $request->authority_cd ?? 0;
            $param['setting_authority_typ']             = $request->setting_authority_typ ?? 1;
            $param['check_config']                      = $request->check_config ?? 0;
            $param['current_page']                      = $request->page_index ?? 1;
            $param['page_size']                         = $request->cb_page ?? 20;
            $table_result = $this->sS0030_repo->referDataTable($param);
            // Call function
            $cbx_M0022_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'M0022']);
            $cbx_M0060_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'M0060']);
            $cbx_M0040_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'M0040']);
            $cbx_S9020_data = $this->sS0030_repo->referCombobox([$param['company_cd'], 'S9020']);
            $other_cbx_results = [$cbx_M0022_data, $cbx_M0060_data, $cbx_M0040_data, $cbx_S9020_data];
            if(($table_result[1][0]['page']*$table_result[1][0]['pagesize']) > $table_result[1][0]['totalRecord']){
                $table_result[1][0]['start_index'] = $table_result[1][0]['offset'];
                $table_result[1][0]['end_index'] = $table_result[1][0]['totalRecord'];
            }
            else{
                $table_result[1][0]['start_index'] = $table_result[1][0]['offset'];
                $table_result[1][0]['end_index'] = $table_result[1][0]['page']*$table_result[1][0]['pagesize'];
            }
            return view('sS0030.table', ['table_result' => $table_result
                                        , 'other_cbx_results' => $other_cbx_results]);
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }

    /**
	 * editData
	 * @author manhnd
	 * @created at 2022-07-26
	 * @return void
	 */
    public function editData(Request $request)
    {
        try {
            $login_session = Session::get('login_session');   
            $param['company_cd']                            = $login_session['company_cd'];
            $param['authority_cd']                          = $request->authority_cd ?? '';
            $param['json']                                  = json_encode($request->json ?? []);
            $param['mode']                                  = $request->mode ?? '';
            $param['upd_user']                              = $login_session['user_id'] ?? '';
            $param['upd_ip']                                = $login_session['last_login_ip'] ?? '';
            $result = $this->sS0030_repo->editData($param);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                $this->respon['errors']     =  [];
                foreach($result[0] as $key => $item){
                    $temp = [
                        'item'       => $item['item'], //trim
                        'message_no' => $item['message_no'],// key one mess
                        'error_typ'  => $item['error_typ'],
                        'value1'     => $item['value1']  //position row
                    ];
                    array_push($this->respon['errors'], [$temp]);  
                }
                return response()->json($this->respon);
            }
            else {
                $this->respon['status']     = OK;
                return response()->json($this->respon);
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}
