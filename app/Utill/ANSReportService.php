<?php

namespace App\Utill;

use SoapClient;

class ANSReportService
{
    protected $client;
    private static $instance = null;
    protected $param;
    protected $status;
    /**
     * __construct
     *
     * @param  null
     * @author viettd 2020/03/06
     * @return null
     */
    public function __construct()
    {
        $this->setClient();
        $this->param = new \stdClass();
        $this->status = new \stdClass();
        $this->status->Normal = config('services.wcf_service.status.Normal', 200);
        $this->status->Exception = config('services.wcf_service.status.Exception', 201);
        $this->status->NoMethod = config('services.wcf_service.status.NoMethod', 202);
        $this->status->NoData = config('services.wcf_service.status.NoData', 203);
        $this->status->None = config('services.wcf_service.status.None', 0);
    }
    /**
     * getInstance
     *
     * @param  null
     * @author viettd 2020/03/06
     * @return instance of Service Class
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ANSReportService();
        }
        return self::$instance;
    }
    /**
     * setClient
     *
     * @param  null
     * @author viettd 2020/03/06
     * @return null
     */
    private function setClient()
    {
        try {
            $this->client = new SoapClient(config('services.wcf_service.host'), array("trace" => 1, "exceptions" => 1));
        } catch (\Exception $e) {
            throw new \Exception("Don't create service to export file", 1);
        }
    }
    /** call wcf service
     * @param $service_class	 	string	Service Class Name
     * @param $service_method 		string 	Service Method Name default : M_RunMain
     * @param $store_name 			array	list store procedure
     * @param $store_param 			array 	list param to run store procedure
     * @param $file_name   			array 	File name
     * @param $sendOptions   		array	extend
     * @param $types   				array	extend
     * @return array 
     */
    public function execute($service_class = '', $service_method = 'M_RunMain', $store_name = [], $store_param = [], $file_name = [], $sendOptions = [], $types = [])
    {
        $result = [];
        try {
            $sql = $this->_getSql($store_name, $store_param);
            //
            $this->param->P_RunClassName = $service_class;
            $this->param->P_RunMethodName = $service_method;
            $this->param->P_Types = $types;
            $this->param->P_Queries = $sql;
            $this->param->P_FileNames = $file_name;
            $this->param->P_SendOptions = $sendOptions;
            $service_result = $this->client->{'M_OutputFile'}($this->param);
            $function = 'M_OutputFileResult';
            // get result from service => decode json to array
            $output_result = json_decode(str_replace("\\", "\\\\", $service_result->$function), true);
            // check not exists result
            if (empty($output_result)) {
                $result['status']            =    $this->status->None;
                $result['message']           =  'Do not receive result from service';
                return $result;
            }
            // if exists result => check result
            // check None
            if ($output_result['Status'] == $this->status->None) {
                $result['status']            =    $output_result['Status'];
                $result['message']           =  'Do not receive result from service';
                return $result;
            }
            // check NoMethod
            if ($output_result['Status'] == $this->status->NoMethod) {
                $result['status']            =    $output_result['Status'];
                $result['message']           =  'No method of service';
                return $result;
            }
            // check Exception
            if ($output_result['Status'] == $this->status->Exception) {
                $result['status']            =    $output_result['Status'];
                $result['message']           =  'Exception';
                return $result;
            }
            // check NoData
            if ($output_result['Status'] == $this->status->NoData) {
                $result['status']            =    $output_result['Status'];
                $result['message']           =  'No Data for when run sql';
                return $result;
            }
            // check file is not exists in folder after export
            $path = $output_result['PhysicalPath'] ?? '';
            $extension_loaded = get_loaded_extensions();
            if (in_array('wfio', $extension_loaded)) {
                $path = 'wfio://' . $path;
            } else {
                $path = mb_convert_encoding($path, 'SJIS', 'utf-8');
            }
            //
            if (!file_exists($path)) {
                $result['status']            =    $this->status->None;
                $result['message']            =  'File not exists in folder downloaded';
                return $result;
            }
            ///////////////////////////////////////////////////////////////
            // result file
            ///////////////////////////////////////////////////////////////
            $result['status']               = $this->status->Normal;
            $result['message']              = 'Export file is created';
            $result['Path']                 = $output_result['Path'];
            $result['PhysicalPath']         = $output_result['PhysicalPath'];
            $result['ReceiveOption']        = $output_result['ReceiveOption'];
            $result['basename']             = basename($path);
            return $result;
        } catch (\Exception $e) {
            $result['status']                = $this->status->Exception;
            $result['message']               = $e->getFile() . '|Line:' . $e->getLine() . '|Content:' . $e->getMessage();
            return $result;
        }
    }
    /**
     * _getSql
     *
     * @param  $procArray		array 	store procedure name
     * @param  $paramsArray		array 	store procedure parameter 
     * @author viettd 2020/03/06
     * @return store procedure run cmd
     */
    private function _getSql($procArray = [], $paramsArray = [])
    {
        $sql = [];
        for ($i = 0; $i < count($procArray); $i++) {
            $procName     = $procArray[$i];
            $params     = $paramsArray[$i];
            //
            $len             = count($params);
            $cnt             = 1;
            $sqlString         = '';
            // check store name is exists
            if ($procName == '') {
                continue;
            }
            // check param is empty
            if ($len == 0) {
                $sqlString = 'EXEC ' . $procName;
            } else {
                $sqlString = 'EXEC ' . $procName . ' ';
                foreach ($params as $key => $value) {
                    // last item
                    if ($cnt == $len) {
                        if (is_int($value) || is_float($value)) {
                            $sqlString .= $value;
                        } else {
                            $sqlString .= "N'" . str_replace('\'', '\'\'', $value) . "'";
                        }
                    } else {
                        if (is_int($value) || is_float($value)) {
                            $sqlString .= $value . ',';
                        } else {
                            $sqlString .= "N'" . str_replace('\'', '\'\'', $value) . "',";
                        }
                    }
                    //
                    $cnt++;
                }
            }
            //
            $sql[] = $sqlString;
        }
        return $sql;
    }
    /**
     * getStatus
     *
     * @return object status of service
     * @author viettd 2020/03/06
     */
    public function getStatus()
    {
        return $this->status;
    }
}
