@extends('layouts.layouts')
@section('asset_header')
    <link rel="stylesheet" href="css/screens/M0030.css" type="text/css">
@endsection
@section('asset_footer')
    <script src="js/screens/m0030.js" ></script>
@endsection
@section('list-buttons')
    @section('list-buttons')
        <x-button-component name="addNewButton saveButton deleteButton backButton"/>
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
            @include('M0030.list')
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-8 col-lg-9 col-ltx-10 col-lt-10">
    <div class="right-layout ">
		<div class="row error justify-content-start">
            <div class="col-md-1">					
                <div class="form-group">
                    <label class="control-label ">コード</label>
                    <span class="num-length">
                        <input type="text" class="form-control " tabindex="1" maxlength="3" id="job_cd" value="" disabled="">
                    </span>
                </div>
            </div>
            <div class="col-md-10">					
                <div class="form-group">
                    <label class="control-label label-required">職種名</label>
                    <span class="num-length">
                        <input type="text" class="job_nm form-control required" tabindex="1" maxlength="20" id="job_nm" value="">
                    </span>
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-6">					
                <div class="form-group">
                    <label class="control-label">職種名略称</label>
                    <span class="num-length">
                        <input type="text" id="job_ab_nm" class="form-control" tabindex="2" maxlength="10" value="">
                    </span>
                </div>
            </div>
            <div class="col-md-1">					
                <div class="form-group">
                    <label class="control-label">並び順</label>
                    <span class="num-length">
                        <input type="text" id="arrange_order" class="form-control only-number" tabindex="3" maxlength="4" value="">
                    </span>
                </div>
            </div>
        </div>			
        </div>
</div>
@endsection