<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Repositories\LibraryRepositoryInterface as LibraryRepository;
use App\Utill\DAO;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /** LibraryRepository */
    private $lib_repo;
    public function __construct(LibraryRepository $lib_repo)
    {
        try{
            $this->lib_repo = $lib_repo;
            $this->respon['status']     = OK; 
            $this->respon['errors']     = [];
        } catch(\Exception $e) {
            $e->getMessage();
        } 
    }

    /**
     * getLibrary
     *
     * @param  String $name_typ
     * @return Array
     */
    public function getLibrary($name_typ)
    {
        try{ 
            $param['name_typ'] = $name_typ;
            return $this->lib_repo->getLibrary($param);
        } catch(\Exception $e) {
            $e->getMessage();
        } 
    }
    /*
     * @function  : validateError -- convert validate to table error 
     * @author    : tuyen – tuyendn@ans-asia.com - create
     * @param     : array , number
     * @return    : array
     * @access    : public
     * @see       : init
     */
    public function validateError($error,$error_typ = 0){
        try{  
            $arr_error=[];
            foreach($error as $key => $item){
                $array_temp = [
                    'item'       => '#'.$key,       //  id item
                    'message_no' => $item[0],       //  key one message
                    'error_typ'  => $error_typ,     //  type error 
                    'value1'     => '' 
                ];
               
                array_push($arr_error,$array_temp);
            }
            return $arr_error;
        } catch(\Exception $e) {
            $e->getMessage();
        }  

    }
    /*
     * @function  : validateError -- convert validate to table error 
     * @author    : quangnd - create
     * @param     : array , number
     * @return    : array
     * @access    : public
     * @see       : init
     */
    public function catchError($message){
        try{   
            $arr_error=[[
                    'error_typ'  => 999,     //  type error 
                    'remark'     => $message 
                ]];
            return $arr_error;
        } catch(\Exception $e) {
            $e->getMessage();
        }  

    }
}
