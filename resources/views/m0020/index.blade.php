@extends('layouts.layouts')
@section('asset_header')
    <link rel="stylesheet" href="css/screens/m0020.css" type="text/css">
@endsection
@section('asset_footer')
    <script src="js/screens/m0020.js" ></script>
@endsection
@section('list-buttons')
    @section('list-buttons')
        <x-button-component name=" changeOrgNameButton createOrgButton createDevisionButton saveButton deleteButton backButton"/>
    @stop
@endsection
@section('main-content')

<div class="col-lt-2 col-sm-12 col-md-4 col-lg-3">
    <div class="left-layout">
        <div class="search">
            <span class="fa fa-search" id="btn-search"></span>
            <input type="search" placeholder="" id="input-search" maxlength="20">
        </div>

        <div id="pagi-wap">
          
        </div>

        <div class="card-left">
            <div class="card-title">登録リスト</div>
            <ul id="list-lv"></ul>
        </div>
       
    </div>
</div>
<div class="col-lt-10 col-sm-12 col-md-8 col-lg-9  ">
    <div class="right-layout">
        <div class="row">
            <div class="col-md-12 breadcrumb-list" check="0">
            </div>
            <input type="hidden" id="org_1" class="org_cd" name="" type_cd="1"value="">
            <input type="hidden" id="org_2" class="org_cd" name="" type_cd="" value="">
            <input type="hidden" id="org_3" class="org_cd" name="" type_cd="" value="">
            <input type="hidden" id="org_4" class="org_cd" name="" type_cd="" value="">
            <input type="hidden" id="org_5" class="org_cd" name="" type_cd="" value="">
            <input type="hidden" id="typ"   class="" name="" value="1">
            <div class="col-lg-10 col-md-12">
                <div class="form-group width-flex flex-c">
                    <label class="control-label">コード
                    </label>
                    <span class="control-span">
                        <input maxlength="20" type="text" class="form-control" id="cd-id" disabled>
                    </span>
                </div>

                <div class="form-group width-input-required width-flex">
                    <label class="control-label label-required">
                        組織名
                    </label>
                    <span class="control-span  control-span-custom ">
                        <input id="organization_nm" type="text" data-id="" class="form-control  required " maxlength="20">
                    </span>
                    
                </div>
                <div class="under-wap">
                    <div class="form-group width-flex-1">
                        <label class="control-label">並び順
                        </label>
                        <span class="control-span">
                            <input maxlength="20" type="text" class="form-control" id="organization_ab_nm">
                        </span>
                    </div>
                    <div class="search form-group width-flex-2">
                    <label class="control-label">責任者
                        </label>
                        <div class="wap-input">
                            <input type="search" placeholder="" id="employee_nm" responsible_cd="" typ="1"  maxlength="20">
                            <span class="fa fa-search" id="search-employee-btn"></span>
                        </div>
                    </div>
                    <div class="form-group width-flex-3">
                        <label class="control-label">並び順
                        </label>
                        <span class="control-span">
                            <input maxlength="4" type="text" class="form-control" id="arrange_order">
                        </span>
                    </div>
                </div>
             
               
            </div>
        </div>
     
    </div>
</div>
@endsection