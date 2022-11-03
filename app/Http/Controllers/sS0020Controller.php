<?php

namespace App\Http\Controllers;
use App\Utill\DAO;
use Illuminate\Http\Request;
use Validator;
use App\Repositories\sS0020RepositoryInterface as sS0020Repository;

class sS0020Controller extends Controller
{
    public $sql;
    public function __construct(sS0020Repository $sS0020Repository){
        try{
            $this->sql = $sS0020Repository;
            $this->respon['status']     = OK; 
            $this->respon['errors']     = [];
        } catch(\Exception $e) {
            $e->getMessage();
        } 
    }
    /*
    * function getIndex --  list data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function getIndex(Request $request){
        $user = Session('login_session');
        $data = [
            "belong_cd1" =>  $user['belong_cd1'],
            "belong_cd2" =>  $user['belong_cd2'],
            "belong_cd3" => $user['belong_cd3'],
            "belong_cd4" => $user['belong_cd4'],
            "belong_cd5" => $user['belong_cd5'],
        ];
        $params['json'] = json_encode($data);
        $params['company_cd'] = $user['company_cd'] ?? '';

        $result = $this->sql->getData($params);
    
        $data['L0030']      = $result[0];
        $data['L0010']      = $result[2];
        $data['M0020']      = $result[4];
        $data['S9020']      = $result[5];
        $data = array_merge($this->postSearch($request),$data);
        return view('sS0020.index',compact('data'));
    }

    /*
    * function postSearch --  search data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function postSearch(Request $request){
        try{  
            $user = Session('login_session');
            $params['company_cd'] = $user['company_cd'] ?? '';
            $params['keyword'] =  $request->keyword ?? '';
            $params['page_current']= $request->page_current ?? 1;
            $result = $this->sql->searchData($params);
            if($request->ajax()){
                return view('sS0020.list',compact('result'));
            }else{
                return  $result;
            }  
        } catch(\Exception $e) {
            $this->respon['status']     = EX;
            $this->respon['Exception']  = $e->getMessage();
        }
       
    }
    /*
    * function postIndex --  save data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function saveData(Request $request){
        try{ 
            $data['data_1'] = json_decode($request->data_s9021, true);
            $data['data_2'] = $request->list_data;
            $mess=[];
            // custom message
            foreach($data['data_2'] as $key => $value){
                foreach($value as $k => $item){
                    $mess["data_2.$key.$k.required"] = ["",'8'] ;
                }
            }
            $validator = Validator::make($data, [
                'data_2.*.authority_nm'        => 'required',
                'data_2.*.use_typ'             => 'required',
                'data_2.*.organization'        => 'required',
                'data_2.*.arrange_order'       => 'required',
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
            $list_data = $request->list_data;
            $list_data[0]['ip']             = $request->ip() ?? '';
            $list_data[0]['company_cd']     = $user['company_cd'] ?? '';
            $list_data[0]['user_id']        = $user['user_id'] ?? '';
            $list_data[0]['prg']            = 'sS0020';
            $params['data']                 = $request->data;
            $params['list']                 = json_encode($list_data,true);
            $params['list_organization']    = $request->list_organization;
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
    * function referData --  refer list data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */
    public function referData(Request $request){
      $user = Session('login_session');
      $params['company_cd']   = $user['company_cd'] ?? '';
      $params['authority_cd'] = $request->authority_cd ?? '';
      $result =$this->sql->referData($params);
      $this->respon['data'] = $result;
      return response()->json($this->respon);
    }

    /*
    * function deleteData --  delete data
    * @author    : tuyen – tuyendn@ans-asia.com - create 2022/06/30
    * @return    : json
    * @access    : public
    * @see       : init
    */

    public function deleteData(Request $request){
       try{
        $user = Session('login_session');
        $params['authority_cd']   = $request->authority_cd ?? '';
        $params['company_cd']     = $user['company_cd'] ?? '';
        $params['ip']             = $request->ip() ?? '';
        $params['user_id']        = $user['user_id'] ?? '';
        $params['prg']            = 'sS0020';
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
