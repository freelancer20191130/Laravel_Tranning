@extends('layouts.layouts')

@section('asset_header')
<link rel="stylesheet" href="css/screens/sS0030.css" type="text/css">
@endsection

@section('asset_footer')
<script src="js/screens/sS0030.js"></script>
@stop

@section('title-screen')
権限割り当て設定
@stop

@section('list-buttons')
    <x-button-component name="saveButton deleteButton backButton"/>
@stop

@section('main-content')
   <div class="container-fluid p-0 pt-3 pr-3">
        <div class="row m-0 p-0">
            <div class="inner w-100">
                {{-- Row 1 --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="line-border-bottom">
                            <label class="control-label">抽出条件</label>
                        </div>
                    </div>
                </div>
                {{-- Row 2 --}}
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">社員番号</label>
                            <span class="control-span">
                                <div class="input-group-btn right-btn">
                                    <input type="text" id="employee_cd" class="employee_cd form-control target-refer" maxlength="10" autocomplete="off">
                                    <div class="input-group-append-btn show-popup-btn" target-url="employee" target-width="1200px">
                                        <button id="search-employee-btn" class="btn btn-transparent border-left-0">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">事業所名</label>
                            <span class="control-span">
                                <div class="num-length">
                                    <input type="hidden" id="employee_cd_hidden" class="employee_cd target-refer">
                                    <input type="text" id="employee_nm" placeholder="氏名・略・ふりがなで検索" class="employee_nm form-control target-refer" autocomplete="off" maxlength="20">
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">社員区分</label>
                            <select name="employee_typ" id="employee_typ" class="form-control" tabindex="3">
                                <option value="-1"></option>
                                @foreach ($other_cbx_results[1][0] as $item)
                                    <option value="{{$item['employee_typ']}}">{{$item['employee_typ_nm']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">役職</label>
                            <select name="employee_typ" id="position_cd" class="form-control" tabindex="3">
                                <option value="-1"></option>
                                @foreach ($other_cbx_results[2][0] as $item)
                                    <option value="{{$item['position_cd']}}">{{$item['position_nm']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- Row 3 --}}
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][0]['use_typ'] == "1")
                                <label class="control-label">{{$other_cbx_results[0][0][0]['organization_group_nm']}}</label>
                            @endif
                            {{-- Refer organization_nm --}}
                            <select name="organization_cd_1" id="organization-step1" class="form-control">
                                <option value="-1"></option>
                                @foreach ($organization_cbx_data[0] as $item)
                                    @if ($item['organization_typ'] == 1)
                                        <option value="{{$item['organization_cd_1']}}">{{$item['organization_nm']}}</option>
                                    @endif
                                @endforeach  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][1]['use_typ'] == "1")
                                <label class="control-label">{{$other_cbx_results[0][0][1]['organization_group_nm']}}</label>
                            @endif
                            {{-- Refer organization_nm --}}
                            <select name="organization_cd_2" id="organization-step2" class="form-control">
                                <option value="-1"></option>                                  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][2]['use_typ'] == "1")
                                <label class="control-label">{{$other_cbx_results[0][0][2]['organization_group_nm']}}</label>
                            @endif
                            {{-- Refer organization_nm --}}
                            <select name="organization_cd_3" id="organization-step3" class="form-control" tabindex="3">
                                <option value="-1"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][3]['use_typ'] == "1")
                                <label class="control-label">{{$other_cbx_results[0][0][3]['organization_group_nm']}}</label>
                            @endif
                            {{-- Refer organization_nm --}}
                            <select name="organization_cd_4" id="organization-step4" class="form-control" tabindex="3">
                                <option value="-1"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][4]['use_typ'] == "1")
                                <label class="control-label">{{$other_cbx_results[0][0][4]['organization_group_nm']}}</label>
                            @endif
                            {{-- Refer organization_nm --}}
                            <select name="organization_cd_5" id="organization-step5" class="form-control" tabindex="3">
                                <option value="-1"></option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- Row 4 --}}
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label label-required">権限</label>
                            <select name="authority_cd" id="authority_cd" class="form-control required" tabindex="3">
                                <option value="-1"></option>
                                @foreach ($other_cbx_results[3][0] as $item)
                                    <option value="{{$item['authority_cd']}}">{{$item['authority_nm']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-10 d-flex justify-content-end align-items-center">
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="form-group m-0 mr-3">
                                <span class="control-span">
                                    <div class="form-check">
                                        <label class="form-check-label check-box">
                                            未設定の社員を表示する
                                            <input type="checkbox" class="form-check-input" id="check_authority">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </span>
                            </div>
                            <button id="search-btn" class="btn" tabindex="8">社員抽出</button>
                        </div>
                    </div>
                </div>
                {{-- Row 5 --}}
                <div class="row">
                    <div class="col-md-12">
                        <div id="show-btn" class="button button-popup show-btn">
                            <div class="icon">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </div>
                            <div class="text">
                                属性情報非表示
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Include table --}}
                <div id="bottom-table">
                    @include('sS0030.table')
                </div>
            </div>
        </div>
   </div>
@stop