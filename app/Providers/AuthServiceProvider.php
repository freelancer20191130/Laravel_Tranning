<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use DB;
use Session;
use App\Models\L0020;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /**
        * -- list all mesage 
        * @author    : tuyendn – tuyendn@ans-asia.com - create
        */
        view()->composer("*",function($view){
            $list_message =L0020::all();
            $_text = [];
            $_data_sesion = Session::get('login_session');
            foreach( $list_message as $key => $item){
                if($item != null ){
                    $_text[$item->message_cd] = $item;
                }
            }
            $view->with(compact('_text','_data_sesion'));
        });

        //
    }
}
