@extends('layouts.layouts')

@section('asset_header')
<link rel="stylesheet" href="css/screens/M0040.css" type="text/css">
@endsection

@section('asset_footer')
<script src="js/screens/m0040.js"></script>
@stop

@section('title-screen')
    職種マスタ
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
                @include('m0040.left')
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
                                <input type="text" maxlength="3" max_position_cd="{{$left_view_data[1][0]['max_position_cd']}}" id="position_cd" class="form-control" autocomplete="off" disabled>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group m-0 mb-2">
                            <label class="control-label label-required">事業所名</label>
                            <span class="control-span">
                                <div class="num-length w-100">
                                    <input type="text" id="position_nm" class="form-control required" autocomplete="off" maxlength="20">
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- Row 2 --}}
                <div class="row pl-2">
                    <div class="col-md-6">
                        <div class="form-group m-0 mb-2">
                            <label class="control-label">役職名略称</label>
                            <span class="control-span">
                                <div class="num-length w-100">
                                    <input type="text" id="position_ab_nm" class="form-control" autocomplete="off" maxlength="10">
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group m-0 mb-2">
                            <label class="control-label">職位順</label>
                            <span class="control-span">
                                <input type="text" maxlength="4" id="arrange_order" class="form-control" autocomplete="off">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop