@extends('layouts.layouts')
@section('asset_header')
    <link rel="stylesheet" href="css/screens/sS0020.css" type="text/css">
@endsection
@section('asset_footer')
    <script src="js/screens/sS0020.js" ></script>
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
            {!! \App\Utill\Pagingate::Pagingate($data[1][0] ?? []) !!}
            <div class="card-left">
                <div class="card-title">登録リスト</div>
                <ul id="card-list">
                    @foreach($data[0] as $item)
                    <li class="card-item authority_nm" data-cd="{{$item['authority_cd']}}">{{$item['authority_nm']}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col-lt-10 col-sm-12 col-md-8 col-lg-9  ">
    <div class="right-layout">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group width-input-required">
                    <label class="control-label label-required">
                        権限名称
                    </label>
                    <span class="control-span  control-span-custom ">
                        <input id="authority_nm" type="text" data-id="" class="form-control required " maxlength="20">
                    </span>
                    
                </div>
                <div class="form-group width-flex width-checkbox">
                    <span class="control-span">
                        <div class="form-check">
                            <label class="control-label">利用区分</label>
                            <label class="form-check-label check-box">
                                本人の役職より下位の社員のみ
                                <input type="checkbox" class="form-check-input" id="use_typ">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </span>
                </div>
                <div class="form-group width-flex">
                    <label class="control-label">並び順
                    </label>
                    <span class="control-span">
                        <input maxlength="4" type="text" class="form-control" id="arrange_order">
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xl-6">
                <div class="powers-wap">
                    <span class="powers-text">機能毎の権限設定</span>
                    <div class="powers-right">
                        <button class="button button-popup button-basic reflect-btn" id="btn-function">
                            一括反映
                        </button>
                        <div class="control-span input-select">
                            <select class="form-control required list-function">
                                @foreach($data['L0010'] as $i )
                                    <option value="{{$i['number_cd']}}">{{$i['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table table-powers table-striped table-bordered" id="table-author">
                    <thead>
                        <tr>
                            <th>機能名称</th>
                            <th>利用権限</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['L0030'] as $item)
                        <tr>
                            <td class="function_id" function_id="{{$item['function_id']}}">{{$item['function_nm']}}</td>
                            <td>
                                <div class="control-span input-select">
                                    <select class="form-control required list_authority">
                                        @foreach($data['L0010'] as $i )
                                        <option value="{{$i['number_cd']}}" >{{$i['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xl-6">
                <p>
                権限範囲
                </p>
                <label class="form-check-label check-box">
                        自分の所属する組織のみ閲覧可能
                    <input type="checkbox" class="form-check-input" id="organization">
                    <span class="checkmark"></span>
                </label>
                <ul id="item-list">
                    @foreach($data['M0020'] as $item)
                   
                    <li class="lv-{{$item['organization_typ']}} lv-item" id="item_{{$item['id']}}"
                        cd_1="{{$item['organization_cd_1']}}"
                        cd_2="{{$item['organization_cd_2']}}"
                        cd_3="{{$item['organization_cd_3']}}"
                        cd_4="{{$item['organization_cd_4']}}"
                        cd_5="{{$item['organization_cd_5']}}"
                        selector="{{$item['selector']}}"
                    >
                        <a href="javascript:void(0)" class="link-checkbox">
                            <input type="checkbox" name="" id="{{$item['id']}}" class="checkbox" value="" cd-1="{{$item['cd_1']}}" cd-2="{{$item['cd_2']}}" cd-3="{{$item['cd_3']}}" cd-4="{{$item['cd_4']}}" >
                            <label class="lable_box" for="{{$item['id']}}"></label>
                            <span class="text-checkbox">{{$item['organization_nm']}}</span>
                        </a>
                    </li>
                  
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection