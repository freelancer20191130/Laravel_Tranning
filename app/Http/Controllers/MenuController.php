<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Utill\DAO;
use Exception;

class MenuController extends Controller
{
    /**
	 * getIndex (get view)
	 * @author manhnd
	 * @created at 2022-06-26
	 * @return void
	 */
    public function getIndex(Request $request)
    {
        try {
            $col_1_arr = [];
            $col_2_arr = [];
            $col_3_arr = [];
            $user_session = Session::get('login_session');
            $param['company_cd']                            =    $user_session['company_cd'];
            $param['user_id']                               =    $user_session['user_id'];
            $result = Dao::execute('SPC_L0030_LST1', $param);
            foreach ($result[0] as $key => $value) {
                if ($value['category'] == '1' && $value['authority'] != '0') {
                    array_push($col_1_arr, $value);
                }
                if ($value['category'] == '2' && $value['authority'] != '0') {
                    array_push($col_2_arr, $value);
                }
                if ($value['category'] == '3' && $value['authority'] != '0') {
                    array_push($col_3_arr, $value);
                }
            }
            return view('menu.index',['col_1_arr' => $col_1_arr, 'col_2_arr' => $col_2_arr, 'col_3_arr' => $col_3_arr]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
