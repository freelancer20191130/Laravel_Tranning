<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utill\DAO;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie as FacadesCookie;
use Illuminate\Support\Facades\Validator;
use Cookie;

class LoginController extends Controller
{
    /*
     * getIndex
     * @author namnth@ans-asia.com
     * @created at 2022/05/21 
     * @return view
     */
    public function getIndex(Request $request)
    {
        if (session()->has('login_session')){
               return redirect('/menu');
        }
        $_data_login            = $request->cookie('_data_login');
        $_data_login            = json_decode($_data_login); 
        $remember_id            = isset($_data_login->remember_id) ? $_data_login->remember_id : '';
        $remember_contract_cd   = isset($_data_login->remember_contract_cd) ? $_data_login->remember_contract_cd : '';
        $data['user_id'] = '';
        $data['contract_cd'] = '';
        if ( !empty($remember_id) ) {
            $data['user_id'] = isset($_data_login->user_id) ? $_data_login->user_id : '';
        }
        if ( !empty($remember_contract_cd) ) {
            $data['contract_cd'] = isset($_data_login->contract_cd) ? $_data_login->contract_cd : '';
        }
        $data['remember_id']            = $remember_id;
        $data['remember_contract_cd']   = $remember_contract_cd;
        return view('login.index',$data);
    }
    /*
     * postLogin
     * @author namnth@ans-asia.com
     * @created at 2022/05/21 
     * @return json
     */
    public function postLogin(Request $request)
    {
        try {   
            $messageErrors = [
                'contract_cd.required'  => 8,
                'user_id.required'      => 8,
                'password.required'     => 8,
            ];
            $validator = Validator::make($request->all(), [
                'contract_cd'   => 'required',
                'user_id'       => 'required',
                'password'      => 'required'
            ],$messageErrors );
            if ($validator->fails()) {
                $this->respon['status'] = NG;
                $errors = $this->validateError($validator -> errors()->toArray()); 
                $this->respon['errors']  =  $errors;
                return response()->json($this->respon);
            }
            $contract_cd    = $request->contract_cd?? '';
            $user_id        = $request->user_id?? '';
            $password       = $request->password?? '';
            $ip             = $request->ip()?? '';
            $params = [
                'contract_cd'   => $contract_cd,
                'user_id'       => $user_id,
                'password'      => $password,
                'ip'            => $ip,
            ];
            $user = Dao::execute('SPC_S0010_INQ1',$params);
            if(isset($user[0][0]['error_typ'])){
                $this->respon['status']     = NG;
                if($user[0][0]['error_typ'] == '999'){
                    $this->respon['Exception']  = $user[0][0]['remark'];
                }else{
                    $errors = [];
                    foreach ($user[0] as $temp) {
                        array_push($errors, $temp);
                    }
                    $this->respon['errors']  =  $errors;
                }
            }else if(isset($user[0]) && !empty($user[0])){
                $timeout = config('session.lifetime');
                $data_Cookie = [
                                    'user_id'  =>'',
                                    'contract_cd'  =>'',
                                    'remember_id'  =>'',
                                    'remember_contract_cd'  =>'',
                                    'time'      =>Carbon::now()
                                ];
                Cookie::queue('_data_login',json_encode($data_Cookie), $timeout);
                $remember_id            =   isset($request->remember_id)&&($request->remember_id==1) ? true : false;
                $remember_contract_cd   =   isset($request->remember_contract_cd)&&($request->remember_contract_cd==1) ? true: false;
                if($remember_id || $remember_contract_cd) {
                    $request->user_id = $remember_id ? $request->user_id : '';
                    $request->contract_cd = $remember_contract_cd ? $request->contract_cd : '';
                    $data_Cookie =  [
                        'user_id'               =>$request->user_id,
                        'contract_cd'           =>$request->contract_cd,
                        'remember_id'           =>$request->remember_id,
                        'remember_contract_cd'  =>$request->remember_contract_cd,
                        'time'                  =>Carbon::now()
                    ];
                    Cookie::queue('_data_login', json_encode($data_Cookie), $timeout);
                }
                Session(['login_session'=>$user[0][0]]); 
            }else{
                $this->respon['status'] = NG;
            } 
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
        return response()->json($this->respon);
    }
    /*
     * getLogout
     * @author namnth@ans-asia.com
     * @created at 2022/06/14 
     * @return redirect
     */
    public function getLogout(Request $request)
    {
        session()->forget('login_session');
        $request->session()->flush();
        return redirect('/');
    }
}
