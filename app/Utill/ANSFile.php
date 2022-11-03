<?php

namespace App\Utill;
use Storage;
use Validator;
/*
*	ANSFile
*	IIS : upload_max_filesize : 2M (default)
*	IIS : post_max_size : 8M (default)
*	IIS : enabled php_ftp when using FTP 
*
*/
class ANSFile
{
	public function __construct()
    {
           
    }
	/**
	 * upload one file
	 *
	 * @param  array  $request  	Request nhận file từ client
	 * @param  string  $disk  		Nơi lưu trữ local|public|s3|ftp defualt = local
	 * @param  string  $folder  	Tên folder muốn lưu file default = 'upload' 
	 * @param  array  $rules 		Rules validate file default = []
	 * @return array  $result 
	 * @throws \Exception
	 */
	public static function upload($request, $params = [])
	{
		$result['status'] 	= 200;
		$result['message']	= 'Uploading is successfuly';
		if($request->isMethod('post'))
		{
			$rules = ['file'];
			// get php.ini values
			$maxSize = ANSFile::_getKiloByte(ini_get('post_max_size'));
			if($maxSize > 0){
				array_push($rules,'max:'.$maxSize);
			}
			$folder = '';
			$disk 	= 'local';
			if(!empty($params['rules'])){
				$rules = $params['rules'];
			}
			if(isset($params['folder']) && $params['folder'] != ''){
				$folder = $params['folder'];
			}
			if(isset($params['disk']) && $params['disk'] != ''){
				$disk = $params['disk'];
			}
			//
			try{
				$inputs = $request->all();
				if(count($inputs) <= 0){
					$result['status']	= 203;
					$result['error'] 	= [];
					$result['result'] 	= [];
					$result['message']	= 'No request';
					return $result;
				}
				//
				$error = [];
				$savename = '';
				if(isset($request->savename) && $request->savename != ''){
					$savename = $request->savename;
				}
				// Get all file
				foreach ($inputs as $input => $content) {
					//
					if($input != 'savename'){
						if($request->hasFile($input)){
						// Get file
							$file 			= $request->file($input);
							$originalName 	= $file->getClientOriginalName();
							$extension 		= $file->getClientOriginalExtension();
							$validator 		= Validator::make([$input=>$file],[$input=>$rules]);
							if($validator->fails())
							{
								array_push($error,$validator->errors()->first());
								$result['result'] = [
									'uid' 				=> uniqid(),
									'originalName' 		=> $originalName,
									'savename'			=> '',
									'url'				=> '',
									'status' 			=> 'error', 
								];
							}
							else
							{
								// if save file is sucessful
								$filename = ANSFile::_upload($file,$savename,$disk,$folder);
								if($filename != null){
									$result['result'] = [
										'uid' 				=> uniqid(),
										'originalName' 		=> $originalName,
										'savename'			=> $savename.'.'.$extension,
										'url'				=> asset('storage/'.$filename),
										'status' 			=> 'done', 
									];
								}else{
									array_push($error,['error'=>'Upload file is unsuccessfuly']);
									$result['result'] = [
										'uid' 				=> uniqid(),
										'originalName' 		=> $originalName,
										'savename'			=> '',
										'url'				=> '',
										'status' 			=> 'error', 
									];
								}
							}
						}else{
							array_push($error,'File not exits');
						}
					}
				}
				// check error 
				if(count($error) > 0){
					$result['status']	= 500;
					$result['error'] 	= $error;
					$result['message']	= 'Has some error when uploading file';
					return $result;
				}
			}catch(Exception $e){
            	$result['status']	= 500;
				$result['error'] 	= $e->getTrace();
				$result['result'] 	= [];
				$result['message']	= $e->getMessage();
				return $result;
			}
		}else{
			$result['status']	= 403;
			$result['error'] 	= [];
			$result['result'] 	= [];
			$result['message']	= 'Method Not Allowed';
			return $result;
		}
		//
		return $result;
	}
	/**
	 * _upload
	 *
	 * @param  string  $disk
	 * @param  file  $file
	 * @param  string  $savename
	 * @return array
	 */
	private static function _upload($file,$savename = '',$disk = 'local',$folder = '')
	{
		if($savename == ''){
			$savename = $file->getClientOriginalName();
		}else{
			$savename = $savename.'.'.$file->getClientOriginalExtension();
		}
		try {
			//code...
			$result = Storage::disk($disk)->putFileAs($folder,$file,$savename);
			return $result;
		} catch (\Throwable $th) {
			return null;
			//throw $th;
		}
	}
	/**
	 * _getKiloByte
	 *
	 * @param  string  $val
	 * @return int 
	 */
	private static function _getKiloByte($val = '')
	{
		$result = 0;
		//
		if(!$val || $val == ''){
			return $result;
		}
		//
		$last = strtolower($val[strlen($val)-1]);
		//
		if($last == 'g'){
			$result = (int)$val * 1024 * 1024;
		}else if ($last == 'm'){
			$result = (int)$val * 1024;
		}else if($last == 'k'){
			$result = (int)$val;
		}else{
			$result = (int)$val/1024;
		}
		return $result;
	}
}