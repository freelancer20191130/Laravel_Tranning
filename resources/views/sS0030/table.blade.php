{{-- Row 6 --}}
<div class="row">
    <div class="col-md-12 p-0 pt-3 pb-3">
        <div id="paging" class="row m-0 pl-3 flex-column">
            @if ($table_result[0] != [])
                {!! \App\Utill\Pagingate::Pagingate($table_result[1][0] ?? []) !!}
                <div class="row m-0 p-0">
                    <div class="pager-info">
                        <select name="cb_page" id="cb_page" class="form-control pager-size" data-selected="{{$table_result[1][0]['pagesize']}}">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="pager-text">
                            検索結果（全{{$table_result[1][0]['totalRecord']}}件中　{{$table_result[1][0]['start_index'] ?? $table_result[1][0]['offset']}}～{{$table_result[1][0]['end_index'] ?? $table_result[1][0]['pagesize']}}件を表示）
                        </div>
                    </div>
                </div>  
            @endif
        </div>
    </div>
</div>
{{-- Row 7 --}}
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="top-scroll">
                    <div class="scroll-div1"></div>
                </div>
            </div>
        </div>
        {{-- Table --}}
        <div id="table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="w-50px">
                            <div class="form-check">
                                <label class="form-check-label check-box">
                                    <input id="check-box-all" type="checkbox" class="form-check-input">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </th>
                        <th class="w-120px text-center">社員番号</th>
                        <th class="w-160px text-center">社員名	</th>
                        <th class="w-160px text-center col_hide">社員区分</th>
                        <th class="w-160px text-center col_hide">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][0]['use_typ'] == "1")
                                <label class="control-label m-0">{{$other_cbx_results[0][0][0]['organization_group_nm']}}</label>
                            @endif
                        </th>
                        <th class="w-160px text-center col_hide">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][1]['use_typ'] == "1")
                                <label class="control-label m-0">{{$other_cbx_results[0][0][1]['organization_group_nm']}}</label>
                            @endif
                        </th>
                        <th class="w-160px text-center col_hide">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][2]['use_typ'] == "1")
                                <label class="control-label m-0">{{$other_cbx_results[0][0][2]['organization_group_nm']}}</label>
                            @endif
                        </th>
                        <th class="w-160px text-center col_hide">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][3]['use_typ'] == "1")
                                <label class="control-label m-0">{{$other_cbx_results[0][0][3]['organization_group_nm']}}</label>
                            @endif
                        </th>
                        <th class="w-160px text-center col_hide">
                            {{-- Refer organization_group_nm --}}
                            @if ($other_cbx_results[0][0][4]['use_typ'] == "1")
                                <label class="control-label m-0">{{$other_cbx_results[0][0][4]['organization_group_nm']}}</label>
                            @endif
                        </th>
                        <th class="w-120px text-center col_hide">職種</th>
                        <th class="w-120px text-center">役職</th>
                        <th class="w-120px text-center">等級</th>
                        <th class="w-120px text-center">事業所</th>
                        <th class="w-120px text-center">ユーザーID</th>
                        <th class="w-120px text-center">現在の権限</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($table_result[0]))
                        {{-- Build content --}}
                        @foreach ($table_result[0] as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label check-box">
                                            <input type="checkbox" class="form-check-input">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="text-left" employee_cd="{{$item['employee_cd']}}">{{$item['employee_cd']}}</td>
                                <td class="text-left">{{$item['employee_nm']}}</td>
                                <td class="text-left col_hide" employee_typ="{{$item['employee_typ']}}">{{$item['employee_typ_nm']}}</td>
                                <td class="text-left col_hide" belong_cd1="{{$item['belong_cd1']}}">{{$item['organization_nm1']}}</td>
                                <td class="text-left col_hide" belong_cd2="{{$item['belong_cd2']}}">{{$item['organization_nm2']}}</td>
                                <td class="text-left col_hide" belong_cd3="{{$item['belong_cd3']}}">{{$item['organization_nm3']}}</td>
                                <td class="text-left col_hide" belong_cd4="{{$item['belong_cd4']}}">{{$item['organization_nm4']}}</td>
                                <td class="text-left col_hide" belong_cd5="{{$item['belong_cd5']}}">{{$item['organization_nm5']}}</td>
                                <td class="text-left col_hide" job_cd="{{$item['job_cd']}}">{{$item['job_nm']}}</td>
                                <td class="text-left" position_cd="{{$item['position_cd']}}">{{$item['position_nm']}}</td>
                                <td class="text-left" grade="{{$item['grade']}}">{{$item['grade_nm']}}</td>
                                <td class="text-left" office_cd="{{$item['office_cd']}}">{{$item['office_nm']}}</td>
                                <td class="text-left" user_id="{{$item['user_id']}}">{{$item['user_id']}}</td>
                                <td class="text-left" setting_authority_cd="{{$item['setting_authority_cd']}}">{{$item['authority_nm']}}</td>
                            </tr>  
                        @endforeach
                    @else 
                        <tr>
                            <td class="text-center" colspan="15">該当データは存在しませんでした。</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>