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
    {!! \App\Utill\Pagingate::Pagingate($list_data_refer[1][0] ?? []) !!}
</div>

{{-- List data --}}
<div class="row w-100 pt-3">
    <div id="list-search">
        <div class="list-search-head d-flex align-items-center justify-content-center">
            登録リスト
        </div>
        <div class="list-search-content d-flex flex-column align-items-center justify-content-center">
            @foreach ($list_data_refer[0] as $item)
                <div office_cd_data="{{$item['office_cd']}}" company_cd_data="{{$item['company_cd']}}" class="list-item w-100 d-flex align-items-center pl-3">{{$item['office_nm']}}</div>
            @endforeach
        </div>
    </div>
</div>