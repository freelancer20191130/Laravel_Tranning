<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\M0080RepositoryInterface as M0080Repository;
use Session;
use Validator;

class M0080Controller extends Controller
{
    /** M0080Repository */
    private $M0080_repo;

    public function __construct(M0080Repository $M0080_repo)
    {  
        $this->M0080_repo = $M0080_repo;
        $this->respon['status']     = OK; 
        $this->respon['errors']     = [];
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
            $left_view = $this->M0080_repo->getLeft($param);
            return view('m0080.index', ['left_view_data' => $left_view]);
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
            $left_view = $this->M0080_repo->getLeft($param);
            return view('m0080.left', ['left_view_data' => $left_view]);
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * get right_view_data
	 * @author manhnd
	 * @created at 2022-07-14
	 * @return void
	 */
    public function getRightData(Request $request)
    {
        try {
            $login_session = Session::get('login_session');
            // Get value of params
            $param['company_cd']                    =    $login_session['company_cd'];
            $param['item_cd']                       =    $request->item_cd ?? 0;
            // Call function get left_data (searching and paging)
            $right_view = $this->M0080_repo->getRight($param);
            return $right_view;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * add new data
	 * @author manhnd
	 * @created at 2022-07-15
	 * @return void
	 */
    public function addNewData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            // Get value of params
            $param['company_cd']                    =    $login_session['company_cd'];
            $param['m0080_obj']                     =    $request->m0080_obj ?? [];
            $param['m0081_obj']                     =    $request->m0081_obj ?? [];
            $param['m0082_obj']                     =    $request->m0082_obj ?? [];
            $param['cre_user']                      =    $login_session['user_id'] ?? '';
            $param['cre_ip']                        =    $login_session['last_login_ip'] ?? '';
            // Validate m0080_obj
            $validator_m0080_obj = Validator::make($param['m0080_obj'], [
                'item_nm' => 'required',
                'item_kind' => 'required',
            ],
            [
                'item_nm.required' => '8',
                'item_kind.required' => '8',
            ]
            );
            // Validate m0081_obj
            $rows = [ 'rows' => $param['m0081_obj'] ];
            $validator_m0081_obj = Validator::make($rows, [
                'rows.*.detail_no' => 'required', 
                'rows.*.detail_nm' => 'required',
            ],
            [
                'rows.*.detail_no.required' => '8',
                'rows.*.detail_nm.required' => '8',
            ]
            );
            $count = 0;
            $error_arr = [];
            // Get error msgs m0080_obj
            if ($validator_m0080_obj->fails()) {
                $this->respon['status'] = NG;
                $this->respon['errors'] = [];
                $error_m0080_obj = $validator_m0080_obj -> errors()->toArray(); 
                foreach($error_m0080_obj as $key => $item){
                    $temp = [
                        'item'       =>'#'.$key, //trim
                        'message_no' => $item[0],// key one mess
                        'error_typ'  => 0,
                        'value1'     => '' //position row
                    ];
                    array_push($this->respon['errors'], $temp);  
                }
                $error_arr[$count] = $this->respon['errors'];
                $count++;
            }
            // Get error msgs m0081_obj
            if ($validator_m0081_obj->fails()) {
                $this->respon['errors'] = [];
                $this->respon['status'] = NG;
                $error_m0081_obj = $validator_m0081_obj -> errors()->toArray(); 
                foreach($error_m0081_obj as $key => $item){
                    // Get dots index
                    $first_dot_index = strpos($key, '.');
                    $second_dot_index = strrpos($key, '.');
                    // Get err_index and property
                    $err_index = substr($key, $first_dot_index + 1, ($second_dot_index - $first_dot_index - 1));
                    $property = substr($key, $second_dot_index + 1, strlen($key) - $second_dot_index);
                    $temp = [
                        'item'       =>'#'.$property.'-'.$err_index, //trim
                        'message_no' => $item[0],// key one mess
                        'error_typ'  => 0,
                        'value1'     => '' //position row
                    ];
                    array_push($this->respon['errors'], $temp);  
                }
                $error_arr[$count] = $this->respon['errors'];
                $count++;
            }
            if ($count > 0 && !empty($error_arr)) {
                $this->respon['errors'] = $error_arr;
                $this->respon['status'] = NG;
                return response()->json($this->respon);
            }
            else {
                // Call function add new record
                $result = $this->M0080_repo->addNewData($param);
                if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                    $this->respon['status']     = EX;
                    $this->respon['Exception']  = $result[0][0]['remark'];
                }else if(isset($result[0]) && !empty($result[0])){
                    $error_arr = [];
                    $this->respon['status']     = NG;
                    $this->respon['errors']     =  [];
                    foreach($result[0] as $key => $item){
                        $temp = [
                            'item'       => $item['item'], //trim
                            'message_no' => $item['message_no'],// key one mess
                            'error_typ'  => $item['error_typ'],
                            'value1'     => $item['value1']  //position row
                        ];
                        array_push($error_arr, $temp);  
                    }
                    array_push($this->respon['errors'], $error_arr);  
                }
                else {
                    $this->respon['status']     = OK;
                    return response()->json($this->respon);
                }
            }
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
    public function editData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            // Get value of params
            $param['company_cd']                    =    $login_session['company_cd'];
            $param['m0080_obj']                     =    $request->m0080_obj ?? [];
            $param['m0081_obj']                     =    $request->m0081_obj ?? [];
            $param['m0082_obj']                     =    $request->m0082_obj ?? [];
            $param['upd_user']                      =    $login_session['user_id'] ?? '';
            $param['upd_ip']                        =    $login_session['last_login_ip'] ?? '';
            // Validate m0080_obj
            $validator_m0080_obj = Validator::make($param['m0080_obj'], [
                'item_nm' => 'required',
                'item_kind' => 'required',
            ],
            [
                'item_nm.required' => '8',
                'item_kind.required' => '8',
            ]
            );
            // Validate m0081_obj
            $rows = [ 'rows' => $param['m0081_obj'] ];
            $validator_m0081_obj = Validator::make($rows, [
                'rows.*.detail_no' => 'required',
                'rows.*.detail_nm' => 'required',
            ],
            [
                'rows.*.detail_no.required' => '8',
                'rows.*.detail_nm.required' => '8',
            ]
            );
            $count = 0;
            $error_arr = [];
            // Get error msgs m0080_obj
            if ($validator_m0080_obj->fails()) {
                $this->respon['status'] = NG;
                $this->respon['errors'] = [];
                $error_m0080_obj = $validator_m0080_obj -> errors()->toArray(); 
                foreach($error_m0080_obj as $key => $item){
                    $temp = [
                        'item'       =>'#'.$key, //trim
                        'message_no' => $item[0],// key one mess
                        'error_typ'  => 0,
                        'value1'     => '' //position row
                    ];
                    array_push($this->respon['errors'], $temp);  
                }
                $error_arr[$count] = $this->respon['errors'];
                $count++;
            }
            // Get error msgs m0081_obj
            if ($validator_m0081_obj->fails()) {
                $this->respon['errors'] = [];
                $this->respon['status'] = NG;
                $error_m0081_obj = $validator_m0081_obj -> errors()->toArray(); 
                foreach($error_m0081_obj as $key => $item){
                    // Get dots index
                    $first_dot_index = strpos($key, '.');
                    $second_dot_index = strrpos($key, '.');
                    // Get err_index and property
                    $err_index = substr($key, $first_dot_index + 1, ($second_dot_index - $first_dot_index - 1));
                    $property = substr($key, $second_dot_index + 1, strlen($key) - $second_dot_index);
                    $temp = [
                        'item'       =>'#'.$property.'-'.$err_index, //trim
                        'message_no' => $item[0],// key one mess
                        'error_typ'  => 0,
                        'value1'     => '' //position row
                    ];
                    array_push($this->respon['errors'], $temp);  
                }
                $error_arr[$count] = $this->respon['errors'];
                $count++;
            }
            if ($count > 0 && !empty($error_arr)) {
                $this->respon['errors'] = $error_arr;
                $this->respon['status'] = NG;
                return response()->json($this->respon);
            }
            else {
                // Call function edit record
                $result = $this->M0080_repo->editData($param);
                if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                    $this->respon['status']     = EX;
                    $this->respon['Exception']  = $result[0][0]['remark'];
                }else if(isset($result[0]) && !empty($result[0])){
                    $error_arr = [];
                    $this->respon['status']     = NG;
                    $this->respon['errors']     =  [];
                    foreach($result[0] as $key => $item){
                        $temp = [
                            'item'       => $item['item'], //trim
                            'message_no' => $item['message_no'],// key one mess
                            'error_typ'  => $item['error_typ'],
                            'value1'     => $item['value1']  //position row
                        ];
                        array_push($error_arr, $temp);  
                    }
                    array_push($this->respon['errors'], $error_arr);  
                }
                else {
                    $this->respon['status']     = OK;
                    return response()->json($this->respon);
                }
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }

    /**
	 * edit data
	 * @author manhnd
	 * @created at 2022-07-20
	 * @return void
	 */
    public function deleteData(Request $request) 
    {
        try {
            $login_session = Session::get('login_session');
            $last_login_ip = $login_session['last_login_ip'];
            $del_user = $login_session['user_id'];
            $param['company_cd']                =    $login_session['company_cd'];
            $param['item_cd']                   =    $request->item_cd ?? 0;
            $param['del_user']                  =    $del_user ?? '';
            $param['del_ip']                    =    $last_login_ip ?? '';
            // Call stored
            $result = $this->M0080_repo->deleteData($param);
            if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
                $this->respon['status']     = EX;
                $this->respon['Exception']  = $result[0][0]['remark'];
            }else if(isset($result[0]) && !empty($result[0])){
                $this->respon['status']     = NG;
                foreach ($result[0] as $temp) {
                    array_push($this->respon['errors'], $temp);
                }
            }
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
}
