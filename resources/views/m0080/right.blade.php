{{-- Row 1 --}}
<div class="row pl-2">
    <div class="col-md-9">
        <div class="form-group m-0 mb-2">
            <label class="control-label label-required">項目名称</label>
            <span class="control-span" >
                <div class="num-length w-100">
                    <input max_item_cd="{{$left_view_data[1][0]['max_item_cd']}}" type="hidden" id="item_cd">
                    <input type="text" id="item_nm" class="form-control required" autocomplete="off" maxlength="10">
                </div>
            </span>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group m-0 mb-2">
            <label class="control-label">並び順</label>
            <span class="control-span">
                <input type="text" id="arrange_order" maxlength="3" class="form-control" autocomplete="off">
            </span>
        </div>
    </div>
</div>
{{-- Row 2 --}}
<div class="row pl-2 pt-2">
    <div class="col-md-3">
        <div class="form-group m-0 mb-2" >
            <label class="control-label label-required">項目の種類</label>
            <select id="item_kind" class="form-control required">
                <option value=""></option>
                @foreach ($left_view_data[2] as $item)
                    <option value="{{$item['item_kind']}}">{{$item['name']}}</option>
                @endforeach    
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group m-0 mb-2 w-25">
            <label class="control-label">桁数</label>
            <span class="control-span">
                <input type="text" id="item_digits" maxlength="3" class="form-control" autocomplete="off">
            </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group m-0">
            <label class="control-label">閲覧可能権限</label>
            <span class="control-span pl-3">
                <div class="form-check">
                    <label class="form-check-label check-box">
                        評価者は閲覧可能とする
                        <input type="checkbox" class="form-check-input" id="rater_browsing_kbn">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </span>
        </div>
    </div>
</div>
{{-- Row 3 --}}
<div class="row pl-2 pt-2">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group m-0">
                    <label class="control-label">表示区分</label>
                    <select id="item_display_kbn" class="form-control">
                        <option value="0">非表示</option>
                        <option value="1">表示</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 position-relative">
                <div class="form-group m-0 position-absolute" style="top: 45%">
                    <span class="control-span">
                        <div class="form-check">
                            <label class="form-check-label check-box">
                                検索条件に含める
                                <input type="checkbox" class="form-check-input" id="search_item_kbn">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        {{-- Multiple  --}}
        <div class="row pt-3">
            <div class="col-md-12">
                <div id="table-left">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">コード</th>
                                <th class="text-center">内容</th>
                                <th class="text-center">
                                    <button id="add-new-row-btn" class="btn btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr index="0">
                                <td>
                                  <span class="control-span">
                                      <div class="num-length w-100">
                                          <input id="detail_no-0" type="text" value="" class="form-control required detail_no td-input" autocomplete="off" maxlength="3">
                                      </div>
                                  </span>
                                </td>
                                <td>
                                    <span class="control-span">
                                        <div class="num-length w-100">
                                            <input id="detail_nm-0" type="text" value="" class="form-control required detail_nm td-input" autocomplete="off" maxlength="50">
                                        </div>
                                    </span>
                                </td>
                                <td>
                                  <div>
                                    <button class="btn btn-sm remove-row-btn">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                  </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-md-2">
        
    </div>
    <div class="col-md-4">
        <div class="form-group m-0">
            <label class="control-label">閲覧可能権限</label>
            <div class="col-md-12">
                <div id="table-right">
                    <table class="table table-bordered">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            @foreach ($left_view_data[3] as $item)
                                <tr>
                                    <td>
                                        <label class="form-check-label check-box d-flex justify-content-center">
                                            <input id="authority_cd_{{$item['authority_cd']}}" authority_cd="{{$item['authority_cd']}}" type="checkbox" class="form-check-input td-input">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        <label class="form-check-label">
                                            <input type="text" class="form-check-input hidden td-input">
                                            {{$item['authority_nm']}}
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>