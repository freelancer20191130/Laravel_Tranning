@extends('layouts.layouts')

@section('asset_header')
<link rel="stylesheet" href="css/screens/M0010.css" type="text/css">
@endsection

@section('asset_footer')
<script src="js/screens/m0010.js"></script>
@stop

@section('title-screen')
    事業所マスタ
@stop

@section('list-buttons')
    {{-- if cooperation_typ = 1 => cant use btn 新規追加, 登録, 削除 (FROM M0001) --}}
    @if ($cooperation_typ == 1)
        <x-button-component name="backButton"/>
    @elseif ($cooperation_typ == 0)
        <x-button-component name="addNewButton saveButton deleteButton backButton"/>
    @endif
@stop

@section('main-content')
   <div class="container-fluid p-0 pt-3 pr-3">
        <div class="row m-0 p-0 justify-content-start">
            {{-- left --}}
            <div id="leftcontent" class="col-sm-12 col-md-4 col-lg-2 pl-0 ">
                <div class="inner">
                    {{-- Left  --}}
                    @include('m0010.left')
                </div>
            </div>

            {{-- right --}}
            <div id="rightcontent" class="col-sm-12 col-md-8 col-lg-10 p-0">
                <div class="inner">
                    <div class="row pl-2">
                        <div class="col-md-1">
                            <div class="form-group m-0 mb-2">
                                <label class="control-label">コード</label>
                                <span class="control-span">
                                    <input type="text" id="office_cd" class="form-control" autocomplete="off" disabled>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group m-0 mb-2">
                                <label class="control-label label-required">事業所名</label>
                                <span class="control-span">
                                    <div class="num-length w-100">
                                        <input type="text" id="office_nm" class="form-control required" autocomplete="off" maxlength="50">
                                    </div>
                                </span>
                            </div>
                        </div>
                        {{-- Hidden input --}}
                        <input type="hidden" id="office_cd" class="form-control" value="{{$list_data_refer[1][0]['max_office_cd']}}" autocomplete="off" disabled>
                    </div>

                    <div class="row pl-2">
                        <div class="col-md-6">
                            <div class="form-group m-0 mb-2">
                                <label class="control-label">事業所名</label>
                                <span class="control-span">
                                    <div class="num-length w-100">
                                        <input type="text" id="office_ab_nm" class="form-control" autocomplete="off" maxlength="20">
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-2">
                        <div class="col-md-2">
                            <div class="form-group m-0 mb-3">
                                <label class="control-label">住所</label>
                                <span class="control-span">
                                    <div class="input-group-btn left-btn">
                                        <input type="text" id="zip_cd" name="zip_cd" class="form-control pl-5" autocomplete="off" placeholder="001-0001" maxlength="7">
                                        <div class="input-group-append-btn">
                                            <button class="btn bg-transparent border-right-0" disabled>
                                                〒
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-10 d-flex align-items-end">
                            <div class="form-group m-0 mb-3 w-100">
                                <span class="control-span">
                                    <div class="input-group-btn left-btn w-100">
                                        <input type="text" id="address1" name="address1" class="form-control" autocomplete="off" maxlength="100">
                                        <div class="input-group-append-btn">
                                            <button class="btn bg-transparent border-right-0" disabled>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-2">
                        <div class="col-md-12 d-flex align-items-end">
                            <div class="form-group m-0 mb-3 w-100">
                                <span class="control-span">
                                    <div class="input-group-btn left-btn w-100">
                                        <input type="text" id="address2" name="address2" class="form-control" autocomplete="off" maxlength="100">
                                        <div class="input-group-append-btn">
                                            <button class="btn bg-transparent border-right-0" disabled>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-2">
                        <div class="col-md-12 d-flex align-items-end">
                            <div class="form-group m-0 mb-2 w-100">
                                <span class="control-span">
                                    <div class="input-group-btn left-btn w-100">
                                        <input type="text" id="address3" name="address3" class="form-control" autocomplete="off" maxlength="100">
                                        <div class="input-group-append-btn">
                                            <button class="btn bg-transparent border-right-0" disabled>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row pl-2">
                        <div class="col-md-3">
                            <div class="form-group m-0 mb-2">
                                <label class="control-label">電話番号</label>
                                <span class="control-span">
                                    <div class="input-group-btn left-btn w-100">
                                        <input type="text" id="tel" class="form-control" autocomplete="off" maxlength="20">
                                        <div class="input-group-append-btn">
                                            <button class="btn bg-transparent border-right-0" disabled>
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="form-group m-0 mb-2">
                                <label class="control-label">FAX番号</label>
                                <span class="control-span">
                                    <div class="input-group-btn left-btn w-100">
                                        <input type="text" id="fax" class="form-control" autocomplete="off" maxlength="20">
                                        <div class="input-group-append-btn">
                                            <button class="btn bg-transparent border-right-0" disabled>
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        {{-- Hidden input --}}
                        <input type="hidden" id="responsible_cd" class="employee_cd form-control target-refer" autocomplete="off" disabled>
                    </div>

                    <div class="row pl-2">
                        <div class="col-md-3">
                            <div class="form-group m-0 mb-2 ">
                                <label class="control-label">責任者</label>
                                <span class="control-span">
                                    <div class="input-group-btn right-btn w-100">
                                        <input type="text" id="employee_nm" class="employee_nm form-control target-refer" autocomplete="off" maxlength="20">
                                        <div class="input-group-append-btn show-popup-btn" target-url="employee" target-width="1200px">
                                            <button id="search-employee-btn" class="btn btn-transparent border-left-0" >
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-1 pl-0">
                            <div class="form-group m-0 mb-2 ">
                                <label class="control-label">並び順</label>
                                <span class="control-span">
                                    <input type="text" id="arrange_order" class="form-control" autocomplete="off" maxlength="4">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@stop