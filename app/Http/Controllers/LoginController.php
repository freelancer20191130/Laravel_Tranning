<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utill\DAO;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie as FacadesCookie;
use Illuminate\Support\Facades\Validator;
use Cookie;
use App\Repositories\UserRepositoryInterface as UserRepository;

class LoginController extends Controller
{
     /**UserRepository **/
    private $user_repo;

    public function __construct(UserRepository $user_repo)
    {
        $this->user_repo    =   $user_repo;
    }
    /*
     * getIndex
     * @author namnth@ans-asia.com
     * @created at 2022/05/21 
     * @return view
     */
    public function getIndex(Request $request)
    {
        // $user_data  =   $this->user_repo->findById($id);
        return view('login.index');
    }
}
