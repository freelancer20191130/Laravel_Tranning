<div class="container">
    <div class="row list-item">
        @if($result[0] != [])
        @foreach($result[0] as $item)
        <div class="row-wap" id="row-wap{{$item['organization_typ']}}">
            <div class="col-tl-5">
                <div class="form-group form-c">
                    <input type="checkbox" class="form-control checkbox checkbox_{{$item['organization_typ']}}" id="use_typ{{$item['organization_typ']}}" data-id={{$item['organization_typ']}} @if( $item['use_typ'] == 1) checked @endif>
                    <label class="control-label btn-input" for="use_typ{{$item['organization_typ']}}" id="label_{{$item['organization_typ']}}">
                        <i class="fa fa-check"></i>
                                組織{{$item['organization_typ']}}を利用する
                    </label>
                </div>
            </div>
            <div class="col-tl-6">
                <div class="form-group form-c">
                    <span class="control-span">
                        <input maxlength="20" type="text" value="{{$item['organization_group_nm']}}" class="form-cr form-control @if( $item['use_typ'] == 1) required @endif  input-nm" id="organization_group_nm{{$item['organization_typ']}}">
                    </span>
                </div>
            </div>
        </div>
        @endforeach
        @else 
         @for($i=1;$i<=5;$i++)
            <div class="row-wap" id="row-wap{{$i}}">
                <div class="col-tl-5">
                    <div class="form-group form-c">
                        <input type="checkbox" class="form-control checkbox checkbox_{{$i}}" id="use_typ{{$i}}" data-id="{{$i}}" checked >
                        <label class="control-label btn-input" for="use_typ{{$i}}" id="label_{{$i}}">
                            <i class="fa fa-check"></i>
                                    組織{{$i}}利用する
                        </label>
                    </div>
                </div>
                <div class="col-tl-6">
                    <div class="form-group form-c">
                        <span class="control-span">
                            <input maxlength="20" type="text" value="" class="form-cr form-control required  input-nm" id="organization_group_nm{{$i}}">
                        </span>
                    </div>
                </div>
            </div>
         @endfor
        @endif
        <div id="save_1-btn" class="button ">
            <div class="icon">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </div>
            <div class="text">
                登録
            </div>
        </div>
   
    </div>
</div>