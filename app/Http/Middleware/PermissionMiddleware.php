<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Utill\DAO;
use Exception;

class PermissionMiddleware
{
    protected $prefix = 'screen_';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        try {
            $temp_arr = [];
            // get current path : /screen
            $path = $request->path();
            // get current module
            $module = $request->segment(1);
            // get current screen
            $screen1 = '';
            $screen2 = '';
            // check exists segment(1)
            if ($request->segment(1)) {
                $screen1 =  $this->prefix . $module;
            }
            // check exists segment(2)
            if ($request->segment(2)) {
                $screen2 =  $screen1 . '_' . $request->segment(2);
            }
            // if login & logout then next request
            $exceptPaths            = ['/', 'logout', 'menu', 'postLogin'];

            // check login
            if (in_array($path, $exceptPaths)) {
                return $next($request);
            }
            // get data
            $user_session = Session::get('login_session');
            if ($user_session == null) {
                return redirect('/');   
            }
            $param['company_cd']                            =    $user_session['company_cd'];
            $param['user_id']                               =    $user_session['user_id'];
            $result = Dao::execute('SPC_L0030_LST1', $param);
            // insert list function_id into temp_arr
            if (isset($result[0]) && !empty($result[0])) {
                foreach ($result[0] as $key => $item) {
                    array_push($temp_arr, strtolower($item['function_id']));
                }
            }
            // if result is empty => error
            if (empty($result[0])) {
                return response(view('layouts.error'));   
            }
            // if exists screen2 
            if ($screen2) {
                return $next($request);
            }
            // if path is not in temp_arr => error
            if (!in_array($path, $temp_arr) && empty($screen2)) {
                return response(view('layouts.error'));    
            }
            return $next($request); 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
