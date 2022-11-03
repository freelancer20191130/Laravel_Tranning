<?php

namespace App\Utill;

use DB, PDO;
use File;
use PDOException;
//use App\Utill\ANSLog;
use Illuminate\Support\Facades\Log;

class DAO
{
    private $_log_status = false;
    //private $ans_log;
    /**
     * Using to connect to Database (SQL server )
     * Call store procedure
     * h
     */
    public function __construct()
    {
        $this->_log_status = env('DB_LOG', false);
    }
    /** 
     * Call store procedure
     * -------------------------------------------
     * @author viettd  <viettd@ans-asia.com>
     * @param string    $store_name     stored procedure name   
     * @param array     $params         parameter
     * @param string    $blank          true : get one blank row
     * @param string    $option         FETCH_ASSOC | FETCH_NUM {default FETCH_ASSOC}
     * If key is japanese then using FETCH_NUM
     * @return array 
     */
    public static function execute($store_name = '', $params = array(), $blank = false, $option = 'FETCH_ASSOC')
    {
        $this_ = new DAO();
        $result = [];
        //
        try {
            $pdo = DB::connection()->getPdo();
            $pdo->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true);
            $pdo->query("SET NOCOUNT ON");
            //Unnamed Placeholder
            $len    = 0;
            $hold   = '';
            if (isset($params) && is_array($params)) {
                $len = count($params);
                for ($i = 1; $i <= $len; $i++) {
                    if ($i == $len) {
                        $hold .= '?';
                    } else {
                        $hold .= '?,';
                    }
                }
            }
            //
            $stmt = $pdo->prepare("{CALL $store_name($hold)}");
            // BIND PARAM
            $index    = 1;
            if (isset($params) && is_array($params)) {
                foreach ($params as &$val) {
                    if (is_null($val)) {
                        $type = PDO::PARAM_NULL;
                    } else if (is_int($val)) {
                        $type = PDO::PARAM_INT;
                    } else if (is_bool($val)) {
                        $type = PDO::PARAM_BOOL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $stmt->bindParam($index, $val, $type);
                    $index++;
                }
            }
            // GET LOG
            if ($this_->_log_status) {
                $debug_sql = $this_->interpolateQuery($store_name, $params);
                //Log::debug($debug_sql);
                $this_->logSQL($debug_sql);
            }
            // EXECUTE SQL
            if (!$stmt->execute()) {
                $result[0][0]['id']         = $stmt->errorCode();
                $result[0][0]['error_typ']  = 999;
                $result[0][0]['data']       = $stmt->errorInfo();
                $result[0][0]['remark']     = 'Execute sql fail';
            }
            // SET FETCH MODE
            if ($option === 'FETCH_NUM') {
                $stmt->setFetchMode(PDO::FETCH_NUM);
            } else {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            // RESULT
            $idx = 0;
            do {
                $result[$idx] = array();
                while ($sql_result = $stmt->fetch()) {
                    array_push($result[$idx], $sql_result);
                }
                //
                if (count($result[$idx]) == 0) {
                    if ($blank) {
                        $result[$idx] = $this_->_getCols($stmt);
                    }
                }
                //
                ++$idx;
            } while ($stmt->nextRowset());
        } catch (PDOException $e) {
            $result[0][0]['id']             = $e->getCode();
            $result[0][0]['error_typ']      = 999;
            $result[0][0]['error_line']     = $e->getLine();
            $result[0][0]['error_message']  = $e->getMessage();
        }
        return $result;
    }
    /**
     * _getCols
     *
     * @param  array $stmt
     * @return array
     */
    private function _getCols($stmt)
    {
        $cols = [];
        for ($i = 0, $cnt = $stmt->columnCount(); $i < $cnt; ++$i) {
            $col = $stmt->getColumnMeta($i);
            $cols[0][$col['name']] = null;
        }
        return $cols;
    }
    /**
     * interpolateQuery
     *
     * @param  string $query
     * @param  array $params
     * @return string
     */
    private function interpolateQuery($query, $params)
    {
        // $keys = array();
        // $values = $params;
        // $arr = array_fill(0, sizeof($params), '?');
        $params_str = implode("','", $params);
        $query = "EXEC " . $query;
        //
        if ($params_str !== '') {
            $query .= " '" . $params_str . "';";
        }
        return $query;
    }
     /**
     * upload one file
     *
     * @param  array  $request      Request nhận file từ client
     * @param  string  $disk        Nơi lưu trữ local|public|s3|ftp defualt = local
     * @param  string  $folder      Tên folder muốn lưu file default = 'upload' 
     * @param  array  $rules        Rules validate file default = []
     * @return array  $result 
     * @throws \Exception
     */
    private function logSQL($debug_sql)
    {
        $path       = storage_path('logs');
        $num_file   = env('DB_LOG_NUM', 10);
        $pathSql    = env('DB_LOG_PATH', storage_path('logs').DIRECTORY_SEPARATOR.'sql');
        //
        if(!File::exists($pathSql))
        {
            File::makeDirectory($pathSql);
        }
        //
        $filesSQL       = File::files($pathSql);
        $files          = File::files($path);
        $filesSQL_num   = count($filesSQL);
        $files_num      = count($files);
        // Delete file when >= $num_file
        if($filesSQL_num > $num_file)
        {
            $index = $filesSQL_num - $num_file;
            for ($i = 0; $i < $index; $i++) { 
                if($i < $index)
                {
                    File::delete($filesSQL[$i]);
                }
            }
        }
        //
        if($files_num > $num_file)
        {
            $index = $files_num - $num_file;
            for ($i = 0; $i < $index; $i++) { 
                if($i < $index)
                {
                    File::delete($files[$i]);
                }
            }
        }
        //
        // Ghi file 
        $logFile = fopen(
            ($pathSql . DIRECTORY_SEPARATOR . date('Ymd') . '_sql_query.log'),
            'a+'
        );
        fwrite($logFile, date("Y-m-d H:i:s"). ': ' . $debug_sql . PHP_EOL);
        fclose($logFile);
    }

}