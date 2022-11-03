@extends('layouts.layouts')

@section('asset_header')
    <link rel="stylesheet" href="css/screens/M0060.css" type="text/css">
@endsection

@section('asset_footer')
    <script src="js/screens/m0060.js"></script>
@stop

@section('title-screen')
    社員区分マスタ  
@stop

@section('list-buttons')
    <x-button-component name="addNewButton saveButton deleteButton backButton"/>
@stop

@section('main-content')
<div class="container-fluid p-0 pt-3 pr-3">
    <div class="row m-0 p-0 justify-content-start">
        {{-- left --}}
        <div id="leftcontent" class="col-sm-12 col-md-4 col-lg-2 pl-0 ">
            <div class="inner">
                {{-- left  --}}
                @include('m0060.left')
            </div>
        </div>

        {{-- right --}}
        <div id="rightcontent" class="col-sm-12 col-md-8 col-lg-10 p-0">
            <div class="inner">
                {{-- Row 1 --}}
                <div class="row pl-2">
                    <div class="col-md-1">
                        <div class="form-group m-0 mb-2">
                            <label class="control-label">コード</label>
                            <span class="control-span">
                                <input type="text" max_employee_typ="{{$left_view_data[1][0]['max_employee_typ']}}" maxlength="3" id="employee_typ" class="form-control" autocomplete="off" disabled>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group m-0 mb-2">
                            <label class="control-label label-required">社員区分名</label>
                            <span class="control-span">
                                <div class="num-length w-100">
                                    <input type="text" id="employee_typ_nm" class="form-control required" autocomplete="off" maxlength="10">
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group m-0 mb-2">
                            <label class="control-label">並び順</label>
                            <span class="control-span">
                                <input type="text" id="arrange_order" maxlength="4" class="form-control" autocomplete="off">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop