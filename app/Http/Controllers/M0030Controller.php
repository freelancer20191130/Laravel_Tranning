<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Repositories\M0030RepositoryInterface as M0030Repository;

class M0030Controller extends Controller
{
    private $M0030Repository;  
    public function __construct(M0030Repository $M0030Repository){
        try{
            $this->M0030Repository = $M0030Repository;
            $this->respon['status']     = OK; 
            $this->respon['errors']     = [];
        } catch(\Exception $e) {
            $e->getMessage();
        } 
    }
    /*
    * function getIndex --  list data
    * @author    : namnth – namnth@ans-asia.com - create 2022/07/04
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function getIndex(Request $request)
    {
        $user = Session('login_session');
        $params = [
            'company_cd'                => $user['company_cd'] ?? '',
            'job_nm'                    => $request->keyword ?? '',
            'page'                      => $request->page_current ?? 1,
        ];
        $result = $this->M0030Repository->getData($params);
        $data['result']                = $result??[];
        $data['params']                 = $params;
        return view('m0030.index',$data);
    }
     /*
    * function postSearch --  search data
    * @author    : namnth – namnth@ans-asia.com - create 2022/07/04
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function postSearch(Request $request){
        try{  
            $user = Session('login_session');
            $params['company_cd']   = $user['company_cd'] ?? '';
            $params['keyword']      =  $request->job_nm ?? '';
            $params['page_current'] = $request->page ?? 1;
            $result = $this->M0030Repository->searchData($params);
            if($request->ajax()){
                return view('m0030.list',compact('result'));
            }else{
                return  $result;
            }  
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }
    /*
    * function saveData --  saveData data
    * @author    : namnth – namnth@ans-asia.com - create 2022/07/04
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function saveData(Request $request)
    {
        try {
            $messageErrors = [
                'job_nm.required'   => 8,
            ];
            $validator = Validator::make($request->all(), [
                'job_nm'            => 'required',
            ],$messageErrors );
            if ($validator->fails()) {
                $this->respon['status'] = NG;
                $errors = $this->validateError($validator -> errors()->toArray()); 
                $this->respon['errors']  =  $errors;
                return response()->json($this->respon);
            }
            $user = Session('login_session');
            $params = [
                'company_cd'            => $user['company_cd'] ?? '',
                'job_cd'                => $request->job_cd?? '',
                'job_nm'                => $request->job_nm?? '',
                'job_ab_nm'             => $request->job_ab_nm?? '',
                'arrange_order'         => $request->arrange_order?? '',
                'user_id'               => $user['user_id'] ?? '',
                'ip'                    => $request->ip()?? '',
                'prg'                   => 'M0030',
            ];
            $result = $this->M0030Repository->saveData($params);
            if(isset($result[0][0]) && isset($result[0][0]['error_typ']) && $result[0][0]['error_typ']== '999'){
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
    /*
    * function deleteData --  deleteData 
    * @author    : namnth – namnth@ans-asia.com - create 2022/07/05
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function deleteData(Request $request){
       try{
        $user = Session('login_session');
        $params = [
                'company_cd'            => $user['company_cd'] ?? '',
                'job_cd'                => $request->job_cd?? '',
                'user_id'               => $user['user_id'] ?? '',
                'ip'                    => $request->ip()?? '',
                'prg'                   => 'M0030',
            ];
        $result =$this->M0030Repository->deleteData($params);
        if(isset($result[0][0]) && $result[0][0]['error_typ'] == '999'){
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $result[0][0]['remark'];
        }else if(isset($result[0]) && !empty($result[0])){
            $this->respon['status']     = NG;
            foreach ($result[0] as $temp) {
                array_push($this->respon['errors'], $temp);
            }
        }
       }catch(\Exception $e){
        $this->respon['status']     = EX;
        $this->respon['Exception']  = $e->getMessage();
       }
       return response()->json($this->respon);
    }
}
