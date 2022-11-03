<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- library CSS -->
    <!-- <link rel="icon" href="D:\ANS_Web_Train\public\images\system/bac"> -->
    <link rel="stylesheet" href="./css/common/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./css/common/jquery-ui.css" type="text/css">
      <!-- Link file Sweetalert2 -->
    <link rel="stylesheet" href="css/common/sweetalert2.min.css">
    {{-- Link file Common --}}
    <link rel="stylesheet" href="css/common/common.css" type="text/css">
    <link rel="stylesheet" href="./css/form/login.css" type="text/css">
    <title>Login</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />
</head>
<body> 
    <div class="center">
        <div class="row input_title">
            <div>
                <input type="text " id="contract_cd" class="input" required placeholder="会社ID" value="{{$contract_cd??''}}">
            </div>
            <div>
                <input class="checkbox" name="remember_contract_cd" id="remember_contract_cd" {{ isset($remember_contract_cd)&&($remember_contract_cd==1)?'checked':''}} type="checkbox" value="1" tabindex=" -1">
                <label for="remember_contract_cd" class="label_checkbox">保存する</label>
            </div>
        </div>
        <div class="row input_title">
            <div>
                <input type="text" id="user_id" class="input" required placeholder="ユーザー名"  value="{{$user_id??''}}">
            </div>
            <div class=" checkbox_row">
                <input class="checkbox" name="remember_id" id="remember_id" {{ isset($remember_id)&&($remember_id==1)?'checked':''}} type="checkbox" value="1" tabindex=" -1">
                <label for="remember_id" class="label_checkbox">保存する</label>
            </div>
        </div>
        <div class="row ">
            <div>
                <input id="password" type="password" class="input" required placeholder="パスワード">
            </div>
        </div>
        <div class="row ">
            <button id="btn_login" type="button" class="btn btn-primary ">ログイン</button>
        </div>
    </div>
    <img class="logo" src="/images/system/logo.png">
</body>
</html>
{{-- text error --}}
<script>
        var _text ={!! json_encode($_text) !!}
</script>
<script src="js/common/jquery.min.js" charset=" utf-8 "></script>
<script src="js/common/bootstrap.min.js " type="text/javascript " charset=" utf-8 "></script> 
<script  src="js/common/sweetalert2.all.min.js"></script>
<script src="/js/common/common.js " type="text/javascript " charset=" utf-8 "></script> 
<script src="js/screens/login.js " type="text/javascript " charset=" utf-8 "></script> 
