<?php

namespace App\Http\Controllers;
use Validator;
use App\Utill\DAO;
use Illuminate\Http\Request;
use App\Repositories\M0050RepositoryInterface as M0050Repository;
class M0050Controller extends Controller
{
    //
    public $sql;
    public function __construct(M0050Repository $M0050Repo){
        try{
            $this->sql = $M0050Repo;
            $this->respon['status']     = OK; 
            $this->respon['errors']     = [];
        } catch(\Exception $e) {
            $e->getMessage();
        } 
    }
     /*
    * function getIndex -- get Data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/07/14
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function getIndex(Request $request){    
        $user = Session('login_session');
        $params['company_cd']  = $user['company_cd'];
        $result = $this->sql->getData($params);
        return view('m0050.index',compact('result'));
    }
     /*
    * function saveData -- save Data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/07/14
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function saveData(Request $request){
        try{
            $data['data'] = json_decode($request->data, true);
            $mess=[];
            // custom message
            foreach($data['data'] as $key => $value){
                $id = $value['grade'];
                foreach($value as $k => $item){
                    $mess["data.$key.$k.required"] = ["$id",'8'] ;
                }
            }
            $validator = Validator::make($data, [
                'data.*.grade_nm'        => 'required',
            ],$mess);
            if($validator->fails()) {
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
                //one 1 value
                foreach($error as $key => $item){
                    $loop  = strpos($key,".") + 1;
                    $index = strpos($key,".",$loop) + 1; //find
                    $temp = [
                        'item'       =>"#".substr($key,$index).$item[0][0], //trim
                        'message_no' => $item[0][1],// key one mess
                        'error_typ'  => 0,
                        'value1'     => $item[0][0]  //position row
                    ];
                    array_push($this->respon['errors'], $temp);  
                }
                return response()->json($this->respon);
            }
            $user = Session('login_session');
            $params['company_cd']     = $user['company_cd'] ?? '';
            $params['ip']             = $request->ip() ?? '';
            $params['user_id']        = $user['user_id'] ?? '';
            $params['prg']            = 'M0050';
            $params['data']           = $request->data;
            $result = $this->sql->saveData($params);
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
