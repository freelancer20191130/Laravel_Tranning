@extends('layouts.layouts')

@section('asset_header')
<link rel="stylesheet" href="css/menu/menu.css" type="text/css">
@endsection

@section('asset_footer')
<script src="js/screens/menu.js"></script>
@stop

@section('title-screen')
    基本設定メニュー
@stop

@section('main-content')
    {{-- Col_1 --}}
    <div class="col-md-4">
        @foreach ($col_1_arr as $item)
            <div class="row mt-3 pr-3 pl-0">
                <div class="col-md-12 p-0">
                    <a class="button button-popup button-basic" href="{{strtolower($item['function_id'])}}">{{$item['function_nm']}}</a>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Col_2 --}}
    <div class="col-md-4">
        @foreach ($col_2_arr as $item)
            <div class="row mt-3 pr-3 pl-0">
                <div class="col-md-12 p-0">
                    <a class="button button-popup button-basic" href="{{strtolower($item['function_id'])}}">{{$item['function_nm']}}</a>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Col_3 --}}
    <div class="col-md-4">
        @foreach ($col_3_arr as $item)
            <div class="row mt-3 pr-3 pl-0">
                <div class="col-md-12 p-0">
                    <a class="button button-popup button-basic" href="{{strtolower($item['function_id'])}}">{{$item['function_nm']}}</a>
                </div>
            </div>
        @endforeach
    </div>      
@stop
        


