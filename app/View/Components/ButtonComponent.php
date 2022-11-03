<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Exception;
use Session;
use Illuminate\Http\Request;
use App\Utill\DAO;

class ButtonComponent extends Component
{
    public $result = [];

    public static $temp_arr = [];
    public static $url = '';
    /**
	 * renderButtons
	 * @author manhnd
	 * @created at 2022-06-26
	 * @return void
	 */
    public static function renderButtons($items = array()){
        try {
            // Check permission to render button
            $permission = self::getAuthority();
            
            // array buttons
            $addNewButton = array('id' => 'add-new-btn', 'icon' => 'fa fa-plus-circle', 'text' => '新規追加', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $saveButton = array('id' => 'save-btn', 'icon' => 'fa fa-pencil-square-o', 'text' => '登録', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $deleteButton = array('id' => 'delete-btn', 'icon' => 'fa fa-trash', 'text' => '削除', 'class' => 'delete-btn', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $backButton = array('id' => 'back-btn', 'icon' => 'fa fa-reply', 'text' => '戻る', 'class' => '', 'permission' => $permission);
            $createOrgButton = array('id' => 'create-org-btn', 'icon' => 'fa fa-plus-circle', 'text' => '新規作成', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $createDevisionButton = array('id' => 'create-division-btn', 'icon' => 'fa fa-plus-circle', 'text' => '下位組織の作成', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $changeOrgNameButton = array('id' => 'change-org-name-button', 'icon' => 'fa fa-pencil-square-o', 'text' => '組織名変更', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $mailButton = array('id' => 'mail-btn', 'icon' => 'fa fa-adjust', 'text' => 'パスワード通知', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $releasedPassButton = array('id' => 'released-pass-btn', 'icon' => 'fa fa-paper-plane-o', 'text' => 'パスワード一括発行', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);
            $printEmployeeButton = array('id' => 'print-employee-btn', 'icon' => 'fa fa-upload', 'text' => '社員一覧出力', 'class' => '', 'permission' => $permission == 1 ? 'disabled' : $permission);

            $randomPassButton = array('id' => 'random-pass-btn', 'icon' => '', 'text' => '自動発行する', 'class' => 'button-popup button-basic', 'permission' => $permission);
            $retiredButton = array('id' => 'retired-btn', 'icon' => '', 'text' => '退職処理', 'class' => 'button-popup button-basic', 'permission' => $permission);
            $reflectButton = array('id' => 'reflect-btn', 'icon' => '', 'text' => '一括反映', 'class' => 'button-popup button-basic', 'permission' => $permission);
            $searchBasicButton = array('id' => 'search-basic-btn', 'icon' => '', 'text' => '社員抽出', 'class' => 'button-popup button-basic', 'permission' => $permission);
            $lockButton = array('id' => 'lock-btn', 'icon' => 'fa fa-check', 'text' => '組織４を利用する', 'class' => 'button-lock', 'permission' => $permission);
            $showButton = array('id' => 'show-btn', 'icon' => 'fa fa-eye-slash', 'text' => '属性情報非表示', 'class' => 'button-popup show-btn', 'permission' => $permission);
            $showPasswordButton = array('id' => 'show-password-btn', 'icon' => 'fa fa-eye-slash', 'text' => '', 'class' => 'show-password-btn', 'permission' => $permission);
            $uploadFileButton = array('id' => 'upload-file-btn', 'icon' => 'fa fa-folder-open', 'text' => '', 'class' => 'upload-file-btn', 'permission' => $permission);
            $deleteFileButton = array('id' => 'delete-file-btn', 'icon' => 'fa fa-trash', 'text' => '', 'class' => 'delete-file-btn', 'permission' => $permission);
            $searchButton = array('id' => 'search-btn', 'icon' => 'fa fa-search', 'text' => '検索', 'class' => 'button-popup', 'permission' => $permission ?? 2);

            // render
            if (isset($items) && !empty($items)) {
                // loop
                foreach ($items as $item) {
                    $item_arr 	= isset($$item) ? $$item : null;
                    array_push(self::$temp_arr, $item_arr);
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
    /**
	 * getAuthority
	 * @author manhnd
	 * @created at 2022-06-26
	 * @return void
	 */
    public static function getAuthority(){
        try {
            $user_session = Session::get('login_session');
            $param['company_cd']                            =    $user_session['company_cd'];
            $param['user_id']                               =    $user_session['user_id'];
            $result = Dao::execute('SPC_L0030_LST1', $param);
            foreach ($result[0] as $key => $item) {
                // Check if screen_id = currentUrl => return authority of this screen => render button 
                if (strtolower($item['function_id']) == strtolower(self::$url)) {
                    return $item['authority'];
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, Request $request)
    {  
        try {
            // Get current url
            self::$url = $request->path();
            $list_buttons = [];
            $arr = explode(" ", trim($name));
            foreach ($arr as $key => $value) {
                array_push($list_buttons, $value);
            }
            // Call function 
            self::renderButtons($list_buttons);
            $this->result = self::$temp_arr;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-component');
    }
}
