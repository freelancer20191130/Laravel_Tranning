<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\sqlserver\PopupRepository;
use Session;
use Exception;

class PopupController extends Controller
{
    /** PopupRepository */
    private $Popup_repo;

    public function __construct(PopupRepository $Popup_repo)
    {  
        $this->Popup_repo = $Popup_repo;
    }

    /**
	 * 
	 * @author manhnd
	 * @created at 2022-07-07
	 * @return void
	 */
    public function getEmployeePassword(Request $request)
    {
        try {
            return view('popup.employee_password');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
	 * refer data table (include paging and searching)
	 * @author manhnd
	 * @created at 2022-07-07
	 * @return void
	 */
    public function getEmployeePopup(Request $request)
    {
        try {
            $other_cbx_results = [];
            $login_session = Session::get('login_session');
            $param['company_cd']                =  $login_session['company_cd'] ?? '';
            $param['setting_authority_cd']      =  $login_session['setting_authority_cd'] ?? '';
            // Call function
            $organization_cbx_results = $this->Popup_repo->referOrganizationCombobox($param);
            $cbx_M0010_data = $this->Popup_repo->referCombobox([$param['company_cd'], 'M0010']);
            $cbx_M0030_data = $this->Popup_repo->referCombobox([$param['company_cd'], 'M0030']);
            $cbx_M0040_data = $this->Popup_repo->referCombobox([$param['company_cd'], 'M0040']);
            $other_cbx_results = [$cbx_M0010_data, $cbx_M0030_data, $cbx_M0040_data];
            $table_result = $this->Popup_repo->referDataTable([$param['company_cd'], $login_session['employee_cd']]);
            return view('popup.m0010_search_employee', ['organization_cbx_data' => $organization_cbx_results
                                                        , 'other_cbx_results' => $other_cbx_results
                                                        , 'table_data' => $table_result]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
	 * show popup search employee and refer data combobox
	 * @author manhnd
	 * @created at 2022-07-05
	 * @return void
	 */
    public function referCombobox(Request $request)
    {
        try {
            $login_session = Session::get('login_session');   
            $param['company_cd']     =    $login_session['company_cd'];
            $param['employee_cd']    =    $login_session['employee_cd'];
            $param['table_nm']       =    $request->table_nm ?? '';
            $result = $this->Popup_repo->referCombobox($param);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
	 * refer organizationCombobox data
	 * @author manhnd
	 * @created at 2022-07-07
	 * @return void
	 */
    public function referOrganizationCombobox(Request $request)
    {
        try {
            $login_session = Session::get('login_session');   
            $param['company_cd']                = $login_session['company_cd'];
            $param['setting_authority_cd']      = $login_session['setting_authority_cd'];
            $param['organization_cd_1']         = $request->organization_cd_1 ?? '';
            $param['organization_cd_2']         = $request->organization_cd_2 ?? '';
            $param['organization_cd_3']         = $request->organization_cd_3 ?? '';
            $param['organization_cd_4']         = $request->organization_cd_4 ?? '';
            $result = $this->Popup_repo->referOrganizationCombobox($param);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
	 * refer data employee table
	 * @author manhnd
	 * @created at 2022-07-07
	 * @return void
	 */
    public function referDataTable(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');   
            $param['company_cd']                        = $login_session['company_cd'];
            $param['employee_cd_login']                 = $login_session['employee_cd'];
            $param['employee_cd']                       = $request->employee_cd ?? '';
            $param['employee_nm']                       = $request->employee_nm ?? '';
            $param['office_cd']                         = $request->office_cd ?? 0;
            $param['organization_cd_1']                 = $request->organization_cd_1 ?? '';
            $param['organization_cd_2']                 = $request->organization_cd_2 ?? '';
            $param['organization_cd_3']                 = $request->organization_cd_3 ?? '';
            $param['organization_cd_4']                 = $request->organization_cd_4 ?? '';
            $param['organization_cd_5']                 = $request->organization_cd_5 ?? '';
            $param['job_cd']                            = $request->job_cd ?? 0;
            $param['position_cd']                       = $request->position_cd ?? 0;
            $param['check_retired']                     = $request->company_out_dt_flg ?? 0;
            $param['current_page']                      = $request->current_page ?? 1;
            $param['page_size']                         = $request->page_size ?? 20;
            $table_result = $this->Popup_repo->referDataTable($param);
            if(($table_result[1][0]['page']*$table_result[1][0]['pagesize']) > $table_result[1][0]['totalRecord']){
                $table_result[1][0]['start_index'] = $table_result[1][0]['offset'];
                $table_result[1][0]['end_index'] = $table_result[1][0]['totalRecord'];
            }
            else{
                $table_result[1][0]['start_index'] = $table_result[1][0]['offset'];
                $table_result[1][0]['end_index'] = $table_result[1][0]['page']*$table_result[1][0]['pagesize'];
            }
            return view('popup.m0010_table_popup', ['table_data' => $table_result]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
