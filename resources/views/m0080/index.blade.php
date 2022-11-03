@extends('layouts.layouts')

@section('asset_header')
    <link rel="stylesheet" href="css/screens/M0080.css" type="text/css">
@endsection

@section('asset_footer')
    <script src="js/screens/m0080.js"></script>
@stop

@section('title-screen')
    社員任意情報マスタ
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
                @include('m0080.left')
            </div>
        </div>

        {{-- right --}}
        <div id="rightcontent" class="col-sm-12 col-md-8 col-lg-10 p-0">
            <div class="inner">
                {{-- right  --}}
                @include('m0080.right')
            </div> 
        </div>
    </div>
</div>
@stop