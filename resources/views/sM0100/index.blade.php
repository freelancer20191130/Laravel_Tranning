@extends('layouts.layouts')
@section('asset_header')
    <link rel="stylesheet" href="css/screens/sM0100.css" type="text/css">
@endsection
@section('asset_footer')
    <script src="js/screens/sM0100.js" ></script>
@endsection
    
@section('list-buttons')
    <x-button-component name="saveButton backButton"/>
@endsection
@section('main-content')
<div class="container-fluid">
        <div class="card-body">
			<div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="line-border-bottom">
                                <label class="control-label lb-required">評価開始日</label>
                            </div>
                            <div class="row m-0">
                                <div class="num-length">
                                    @foreach($data['date'] as $date )
                                        <input type="text" id="beginning_date" class="form-control text-center mmdd tab-focus required" placeholder="mm/dd"  maxlength="5" tabindex="1" value="{!!$date['beginning_date']!!}">
                                        <input type="hidden" class="yyyymmdd" id="beginning_date_full" value="{!!$date['beginning_date_full']??''!!}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="line-border-bottom">
                                <label class="control-label lb-required">1on1年度開始日</label>
                            </div>
                            <div class="row m-0">
                                <div class="num-length">
                                    @foreach($data['date'] as $date )
                                        <input type="text" id="beginning_date_1on1" class="form-control text-center mmdd tab-focus required" placeholder="mm/dd"  maxlength="5" tabindex="2" value="{!!$date['beginning_date_1on1']!!}">
                                        <input type="hidden" class="yyyymmdd" id="beginning_date_1on1_full" value="{!!$date['beginning_date_1on1_full']??''!!}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="line-border-bottom">
                            <label class="control-label lb-required">パスワードポリシー</label>
                        </div>
                    </div>
                </div>
                <div class="form row col-md-12 justify-content-start">
                    <div class="col-xs-12 col-md-1  float-left">
                        <label class="control-label">文字数</label><br>
                        <span class="num">
                            @foreach($data['date'] as $date )
                                <input type="text" class="form-control only-number text-right" maxlength="2" id="password_length" value="{!!$date['password_length']!!}" tabindex="3">
                            @endforeach
                        </span>
                    </div>
                    <div class="col-xs-12 col-md-1  float-left">
                        <label class="control-label">&nbsp;</label>
                        <span class="num">
                            <div class="input-group-btn btn-left" style="line-height: 36px;">
                                文字以上
                            </div>
                        </span>
                    </div>						
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label">文字制限</label>
                        <select name="" class="form-control" id="password_character_limit" tabindex="4">
                            @foreach($data['selectbox'] as $selectbox )
                                <option value="{{$selectbox['number_cd']}}" {{ $selectbox['number_cd']?'selected':''}}>{{$selectbox['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-1  float-left">
                        <label class="control-label">有効期間</label>
                        <span class="num">
                            @foreach($data['date'] as $date )
                                <input type="text" class="form-control only-number text-right" maxlength="2" id="password_age" value="{!!$date['password_age']!!}" tabindex="5">
                            @endforeach
                        </span>
                    </div>
                    <div class="col-xs-12 col-md-2  float-left">
                        <label class="control-label">&nbsp;</label>
                        <span class="num">
                            <div class="input-group-btn btn-left" style="line-height: 36px;">
                                ヶ月間
                            </div>
                        </span>
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>

@endsection
