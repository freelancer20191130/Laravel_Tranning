{{-- Search input --}}
<div class="row w-100">
    <div class="form-group m-0">
        <span class="control-span">
            <div class="input-group-btn right-btn">
                <input type="text" id="search_key" class="form-control" maxlength="20" autocomplete="off">
                <div class="input-group-append-btn">
                    <button class="btn btn-transparent border-left-0" id="search-button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </span>
    </div>
</div>

{{-- Paging --}}
<div id="paging" class="row w-100 mt-3">
    {!! \App\Utill\Pagingate::Pagingate($left_view_data[1][0] ?? []) !!}
</div>

{{-- List data --}}
<div class="row w-100 pt-3">
    <div id="list-search">
        <div class="list-search-head d-flex align-items-center justify-content-center">
            登録リスト
        </div>
        <div class="list-search-content d-flex flex-column align-items-center justify-content-center">
            @foreach ($left_view_data[0] as $item)
                <div class="list-item w-100 d-flex align-items-center" position_cd="{{$item['position_cd']}}">
                    <span class="pl-3 w-100 h-100 d-flex align-items-center position_nm">{{$item['position_nm']}}</span>
                    <span class="h-100 d-flex align-items-center pr-3 arrange_order">{{$item['arrange_order']}}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>