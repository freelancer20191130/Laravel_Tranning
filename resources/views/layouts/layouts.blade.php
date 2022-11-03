<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Link file Bootstrap --}}
    <link rel="stylesheet" href="css/common/bootstrap.min.css" type="text/css">
    <!-- Link file Sweetalert2 -->
    <link rel="stylesheet" href="css/common/sweetalert2.min.css">
    {{-- Link file Fontawesome --}}
    <link rel="stylesheet" href="css/common/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="css/common/font-awesome.min.css" type="text/css">
    {{-- Link file Common --}}
    <link rel="stylesheet" href="css/common/common.css" type="text/css">
    <title>Documents</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('asset_header')
</head>
<body>
    {{-- Header --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light header">
        <a class="navbar-brand" href="/menu">
            <img src="images/system/logo-icon.png" alt="">
        </a>
        <div class="navbar-content">
            <ul class="navbar-nav mr-auto">
                <li class="d-flex align-items-center">
                    <ul id="breadcrumb">
                        <li>
                            <a tabindex="-1" href=""> 社員情報管理</a>
                        </li>
                        <li class="active">
                            <a tabindex="-1" href="">社員情報管理</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a tabindex="-1" class="nav-link text-danger"></a>
                </li>
            </ul>
            <ul class="navbar-nav right">
                <li class="dropdown">
                    <a tabindex="-1" class="nav-link dropdown-toggle" href="" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-data">
                            <img src="images/system/user-solid.png" alt="">
                            <ul>
                                <li>ID:{{$_data_sesion['user_id']}}</li>
                                <li>{{$_data_sesion['employee_nm']}}</li>
                            </ul>
                        </div>
                    </a>
                    <div class="dropdown-menu show-popup-btn" target-url="password" target-width="350px" aria-labelledby="dropdownMenu2">
                        <button id="dropdown-header-btn" class="dropdown-item">パスワード変更</button>
                    </div>
                </li>
                <li class="nav-item">
                    <a tabindex="-1" class="nav-link icon logout" href="/logout">
                        <img src="images/system/sign-out-alt-solid.png" alt="">
                        <span>ログアウト</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    {{-- Hidden Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light hidden-navbar">
        <div class="row w-100 m-0 align-items-center">
            <a class="navbar-brand" href="/menu">
                <img src="images/system/logo-icon.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="w-100">
			<div class="col-12 p-0">
				<div class="navbar-collapse menu-common collapse pb-2" id="navbarSupportedContent">
					<div class="row m-100">
						<div class="col-12">
							<ul class="nav flex-column">
								<li class="nav-item">
                                    <a tabindex="-1" class="nav-link icon logout" href="/menu">
                                        <img src="images/system/icon-home.png" alt="">
                                        <span>ホーム</span>
                                    </a>
                                </li>
								<li class="nav-item">
                                    <a tabindex="-1" class="nav-link icon logout" href="">
                                        <img src="images/system/redo-solid.png" alt="">
                                        <span>パスワード変更</span>
                                    </a>
                                </li>
								<li class="nav-item">
                                    <a tabindex="-1" class="nav-link icon logout" href="">
                                        <span>利用方法・よくある質問
                                            <br>
                                            （管理者用）
                                        </span>
                                    </a>
                                </li>
							</ul>
						</div>
						<div class="col-12 mt-3 mb-3">
							<button class="btn btn-primary w-100">
								<a class="nav-link p-0 text-dark" href="/logout">
                                    <span>
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </span>
                                    ログアウト
                                </a>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </nav>

    {{-- Main --}}
    <div class="main"> 
        {{-- Main Navbar --}}
        <div class="main-nav">
            <ul class="list-group main-nav-menu">
                <li class="list-item">
                    <a tabindex="-1" id="home_url" href="/menu">
                        <p><img src="images/system/icon-home.png"></p>
                        <div>ホーム</div>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="main-content">
            {{-- Title each screen --}}
            <div class="container-fluid">
                <div class="row justify-content-between pt-3">
                    <div class="header pl-3">
                        <h5 class="title-screen">
                            @yield('title-screen')
                        </h5>
                    </div>
                    
                    <div class="list-buttons pr-3">
                        {{-- List buttons of each screen --}}
                        @yield('list-buttons')
                    </div>
                    
                    <div class="dropdown-list-btns" data-toggle="collapse" href="#dropdown-list-btns" role="button" aria-expanded="false" aria-controls="test">
                        <img src="/images/system/icon_1.png" alt="">
                        <div class="row collapse" id="dropdown-list-btns">
                            {{-- List buttons of each screen (mobile) --}}
                            @yield('list-buttons')
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row align-items-start pb-5 pl-3">
                    {{-- Content of each screen --}}
                    @yield('main-content')
                </div>
            </div>
            {{-- Footer --}}
           <div class="footer">
           </div>
        </div>
    </div>

    {{-- Popup --}}
    <div id="overlay">
        <div id="popup" class="popup">
            <div class="popup-header">
                <div class="text">
    				パスワード変更
                </div>
                <div id="close-popup-icon" class="close-icon">
                </div>
            </div>
            <div class="popup-content">
                <div class="container-fluid">
                    <div id="main-content" class="row">
                        {{-- Popup Content  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- text error --}}
    <script>
        var _text ={!! json_encode($_text) !!}
    </script>
    {{-- Link file jQuery --}}
    <script src="js/common/jquery-3.6.0.min.js" ></script>
    {{-- Link file JS Bootstrap --}}
    <script src="js/common/bootstrap.min.js " ></script>
    <!-- Link file JS sweetalert2 -->
    <script  src="js/common/sweetalert2.all.min.js"></script>
    <!-- Link file JS ajaxzip3 -->
    <script  src="js/common/ajaxzip3-source.js"></script>
    {{-- Link file Common --}}
    <script src="js/common/common.js" ></script>
    {{-- Link file Sortable --}}
    <script src="js/common/Sortable.min.js" ></script>
    @yield('asset_footer')
    <div id="loading" class="overlay">
        <img class="img-loading" src="images/system/loading.gif">
    </div>
</body>
</html>