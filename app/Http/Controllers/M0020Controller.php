<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Utill\Pagingate;
use App\Repositories\M0020RepositoryInterface as M0020Repository;
class M0020Controller extends Controller
{
    //
    public $sql;
    public $pagi;
    public function __construct(M0020Repository $M0020Repo,Pagingate $pagi){
        try{
            $this->pagi = $pagi;
            $this->sql = $M0020Repo;
            $this->respon['status']     = OK; 
            $this->respon['errors']     = [];
        } catch(\Exception $e) {
            $e->getMessage();
        } 
    }
    /*
    * function getIndex --  get view index
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : html
    * @access    : public
    * @see       : init
    */
    public function getIndex(Request $request){
        try{  
          
            return view('m0020.index');
        } catch(\Exception $e) {
            $e->getMessage();
        }
    }
     /*
    * function getData --  get data 
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function getData(Request $request){
        try{  
            $user = Session('login_session');
            $params['company_cd']  = $user['company_cd'];
            $result = $this->getPaginate($request);
            $pagi = $this->pagi->Pagingate($result[1][0]);
            return response()->json(['data'=>$result,'pagi'=>$pagi]);
        } catch(\Exception $e) {
            $e->getMessage();
        }
    }
    /*
    * function getPaginate -- get search data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function getPaginate(Request $request){
        try{  
            $user = Session('login_session');
            $params['company_cd'] = $user['company_cd'] ?? '';
            $params['keyword'] =  $request->keyword ?? '';
            $params['page_current']= $request->page_current ?? 1;
            $result = $this->sql->searchData($params);
            return  $result;
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }

    /*
    * function postSearch -- post search data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function postSearch(Request $request){
        try{  
            $result = $this->getPaginate($request);
            $pagi = $this->pagi->Pagingate($result[1][0]);
            return response()->json(['data'=>$result,'pagi'=>$pagi]);
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
    }

    /*
    * function getDataPopup -- get Data Popup
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function getDataPopup(Request $request){
        try{  
            $user = Session('login_session');
            $params['company_cd']  = $user['company_cd'];
            $result = $this->sql->getOrganization($params);
         
            return view('m0020.popup',compact('result'));
        } catch(\Exception $e) {
            $e->getMessage();
        }
    }

    /*
    * function saveOrganization -- save Organization
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function saveOrganization(Request $request){
        try{  
            $data['data'] = json_decode($request->data,true);
            $mess=[];
            // custom message
            foreach($data['data'] as $key => $value){
                $id = $value['organization_typ'];
                foreach($value as $k => $item){
                    $mess["data.$key.$k.required"] = ["$id",'8'] ;
                }
            }
            $validator = Validator::make($data, [
                'data.*.organization_group_nm'   => 'required',
            ],$mess);
            
            if($validator->fails()) {
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
                //one 1 value
                foreach($error as $key => $item){
                    $index = strpos($key,".") + 3;  //find
                    $temp = [
                        'item'       =>'#'.substr($key,$index).$item[0][0], //trim
                        'message_no' => $item[0][1],// key one mess
                        'error_typ'  => 0,
                        'value1'     => $item[0][0]  //position row
                    ];
                    array_push($this->respon['errors'], $temp);  
                }
                return response()->json($this->respon);
            }
            $user = Session('login_session');
            $params['company_cd']     = $user['company_cd'];
            $params['ip']             = $request->ip() ?? '';
            $params['user_id']        = $user['user_id'] ?? '';
            $params['prg']            = 'M0020';
            $params['json']        = $request->data;
            $result = $this->sql->saveOrganization($params);
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
    /*
    * function referData -- refer Data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function referData(Request $request){
        try {
            $user = Session('login_session');
            $params['company_cd']  = $user['company_cd'];
            $params['cd']          = $request->arr;
            $result = $this->sql->referData($params);
            return response()->json(['data'=>$result]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
       
    } 
    /*
    * function saveData -- save Data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function saveData(Request $request){
        try{
            
            $data['data'] = $request->organization;
            $mess=[];
            // custom message
            foreach($data['data'] as $key => $value){
                foreach($value as $k => $item){
                    $mess["data.$key.$k.required"] = ["",'8'] ;
                }
            }
            $validator = Validator::make($data, [
                'data.*.organization_nm'        => 'required',
            ],$mess);
            if($validator->fails()) {
                $this->respon['status'] = NG;
                $error = $validator -> errors()->toArray(); 
                //one 1 value
                foreach($error as $key => $item){
                    $index = strpos($key,".") + 3;  //find
                    $temp = [
                        'item'       =>'#'.substr($key,$index), //trim
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
            $params['prg']            = 'M0020';
            $params['data']           = json_encode($request->organization,true);
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
     /*
    * function deleteData -- delete Data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function deleteData(Request $request){
        try{
            $user = Session('login_session');
            $params['company_cd']     = $user['company_cd'] ?? '';
            $params['ip']             = $request->ip() ?? '';
            $params['user_id']        = $user['user_id'] ?? '';
            $params['prg']            = 'M0020';
            $params['data']           = json_encode($request->organization,true);
            $result =$this->sql->deleteData($params);
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
