<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\sM0100RepositoryInterface as sM0100Repository;

class sM0100Controller extends Controller
{
    private $sM0100Repository;  
    public function __construct(sM0100Repository $sM0100Repository){
        try{
            $this->sM0100Repository = $sM0100Repository;
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
        $params['company_cd'] = $user['company_cd'] ?? '';
        $result = $this->sM0100Repository->getData($params);
        $data['date']               = $result[0];
        $data['selectbox']          = $result[1];
        return view('sM0100.index',compact('data'));
    }
    public function saveData(Request $request)
    {
        try {
            $messageErrors = [
                'beginning_date.required'           => 8,
                'beginning_date_1on1.required'      => 8,
            ];
            $validator = Validator::make($request->all(), [
                'beginning_date'            => 'required',
                'beginning_date_1on1'       => 'required',
            ],$messageErrors );
            if ($validator->fails()) {
                $this->respon['status'] = NG;
                $errors = $this->validateError($validator -> errors()->toArray()); 
                $this->respon['errors']  =  $errors;
                return response()->json($this->respon);
            }
            $user = Session('login_session');
            $params = [
                'company_cd'                => $user['company_cd'] ?? '',
                'beginning_date'            => $request->beginning_date?? '',
                'beginning_date_1on1'       => $request->beginning_date_1on1?? '',
                'password_length'           => $request->password_length?? '',
                'password_character_limit'  => $request->password_character_limit?? '',
                'password_age'              => $request->password_age?? '',
                'employee_nm'               => $user['employee_nm'] ?? '',
                'ip'                        => $request->ip()?? '',
                'prg'                       => 'sM0100',
            ];
            $result = $this->sM0100Repository->saveData($params);
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
}
