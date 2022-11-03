<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Components</title>
    {{-- Link file Bootstrap --}}
    <link rel="stylesheet" href="css/common/bootstrap.min.css" type="text/css">
    {{-- Link file Fontawesome --}}
    <link rel="stylesheet" href="css/common/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="css/common/font-awesome.min.css" type="text/css">
    {{-- Link file Common --}}
    <link rel="stylesheet" href="css/common/common.css" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div class="container">
            
        {{-- add-new-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button add-new-btn">
                <div class="icon">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </div>
                <div class="text">
                    新規追加
                </div>
            </div>
        </div>
        {{-- save-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button save-btn">
                <div class="icon">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
                <div class="text">
                    登録
                </div>
            </div>
        </div>
        {{-- delete-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button delete-btn">
                <div class="icon">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
                <div class="text">
                    削除
                </div>
            </div>
        </div>
        {{-- back-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button back-btn">
                <div class="icon">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                </div>
                <div class="text">
                    戻る
                </div>
            </div>
        </div>
        {{-- create-org-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button create-org-btn">
                <div class="icon">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </div>
                <div class="text">
                    新規作成
                </div>
            </div>
        </div>
        {{-- create-division-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button create-division-btn">
                <div class="icon">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </div>
                <div class="text">
                    下位組織の作成
                </div>
            </div>
        </div>
        {{-- change-org-name-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button create-division-btn">
                <div class="icon">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
                <div class="text">
                    組織名変更
                </div>
            </div>
        </div>
        {{-- mail-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button mail-btn">
                <div class="icon">
                    <i class="fa fa-adjust" aria-hidden="true"></i>
                </div>
                <div class="text">
                    パスワード通知
                </div>
            </div>
        </div>
        {{-- save-popup-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup save-popup-btn">
                <div class="icon">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
                <div class="text">
                    登録
                </div>
            </div>
        </div>
        {{-- cancel-popup-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup cancel-popup-btn">
                <div class="icon">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                </div>
                <div class="text">
                    登録
                </div>
            </div>
        </div>
        {{-- print-employee-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button print-employee-btn">
                <div class="icon">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </div>
                <div class="text">
                    社員一覧出力
                </div>
            </div>
        </div>
        {{-- search-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup search-btn">
                <div class="icon">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
                <div class="text">
                	検索
                </div>
            </div>
        </div>
        {{-- new-signup-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button new-signup-btn">
                <div class="icon">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </div>
                <div class="text">
                    新規登録
                </div>
            </div>
        </div>
        {{-- random-pass-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup button-basic random-pass-btn">
                <div class="text">
                    自動発行する
                </div>
            </div>
        </div>
        {{-- retired-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup button-basic retired-btn">
                <div class="text">
                    退職処理
                </div>
            </div>
        </div>
        {{-- reflect-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup button-basic reflect-btn">
                <div class="text">
                    一括反映
                </div>
            </div>
        </div>
        {{-- search-basic-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup button-basic search-basic-btn">
                <div class="text">
                    社員抽出
                </div>
            </div>
        </div>
        {{-- lock-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-lock">
                <div class="icon">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <div class="text">
					組織４を利用する
                </div>
            </div>
        </div>

        {{-- show-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button button-popup show-btn">
                <div class="icon">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div>
                <div class="text">
                    属性情報非表示
                </div>
            </div>
        </div>
        {{-- show-password-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button show-password-btn">
                <div class="icon">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        {{-- upload-file-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button upload-file-btn">
                <div class="icon">
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        {{-- delete-file-button --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="button delete-file-btn">
                <div class="icon">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        
        {{-- basic-input --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <label class="control-label">姓</label>
                <span class="control-span">
                    <input type="text" class="form-control">
                </span>
            </div>
        </div>
        {{-- basic-disable-input --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <label class="control-label">コード</label>
                <span class="control-span">
                    <input type="text" class="form-control" disabled>
                </span>
            </div>
        </div>
        {{-- basic-required-input --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <label class="control-label label-required">コード</label>
                <span class="control-span">
                    <input type="text" class="form-control required">
                </span>
            </div>
        </div>
        {{-- basic-input with appended-left-btn --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <label class="control-label label-required">コード</label>
                <span class="control-span">
                    <div class="input-group-btn left-btn">
                        <input type="text" class="form-control">
                        <div class="input-group-append-btn">
                            <button class="btn bg-transparent" disabled>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </span>
            </div>
        </div>
        {{-- basic-input with appended-right-btn --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <label class="control-label">FAX番号</label>
                <span class="control-span">
                    <div class="input-group-btn right-btn">
                        <input type="text" class="form-control">
                        <div class="input-group-append-btn">
                            <button class="btn btn-transparent" disabled>
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </span>
            </div>
        </div>
        {{-- select-input --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <label class="control-label">項目の種類</label>
                <span class="control-span">
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                </span>
            </div>
        </div>
        {{-- select-input-required --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <label class="control-label">項目の種類</label>
                <span class="control-span">
                    <select class="form-control required">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                </span>
            </div>
        </div>
        {{-- checkbox has label --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <span class="control-span">
                    <div class="form-check">
                        <label class="form-check-label check-box" >
                            該当グループなし
                            <input type="checkbox" class="form-check-input" id="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </span>
            </div>
        </div>
        {{-- checkbox --}}
        <div class="row" style="margin:15px 0; padding-left: 15px">
            <div class="form-group">
                <span class="control-span">
                    <div class="form-check">
                        <label class="form-check-label check-box" >
                            <input type="checkbox" class="form-check-input" id="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </span>
            </div>
        </div>
    </div>

    {{-- Link file jQuery --}}
    <script src="js/common/jquery-3.6.0.min.js" ></script>
    {{-- Link file JS Bootstrap --}}
    <script src="js/common/bootstrap.min.js " ></script>
    <!-- Link file JS sweetalert2 -->
    <script  src="js/common/sweetalert2.all.min.js"></script>
    {{-- Link file Common --}}
    <script src="js/common/common.js" ></script>
</body>
</html>
