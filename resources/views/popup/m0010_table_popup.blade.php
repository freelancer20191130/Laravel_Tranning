<div class="card w-100">
    {{-- Paging and select-box --}}
    @if(!empty($table_data[1]))
        <div id="paging-popup" class="row m-0 pl-3 flex-column">
            {!! \App\Utill\Pagingate::Pagingate($table_data[1][0] ?? []) !!}
            @if($table_data[1][0]['totalRecord'] != '0')
                <div class="row m-0 p-0">
                    <div class="pager-info">
                        <select id="cb_page" class="form-control pager-size" data-selected="{{$table_data[1][0]['pagesize']}}">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="pager-text">
                            検索結果（全{{$table_data[1][0]['totalRecord']}}件中　{{$table_data[1][0]['start_index'] ?? $table_data[1][0]['offset']}}～{{$table_data[1][0]['end_index'] ?? $table_data[1][0]['pagesize']}}件を表示）
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
    {{-- Table --}}
    <div id="table" class="row w-100 m-0 pl-3 pt-3">
        <div class="container-fluid m-0 p-0 pr-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">退職区分</th>
                        <th class="text-center">社員番号</th>
                        <th class="text-center">社員名</th>
                        <th class="text-center">社員区分</th>
                        <th class="text-center">部署</th>
                        <th class="text-center">グループ</th>
                        <th class="text-center">チーム</th>
                        <th class="text-center">組織4</th>
                        <th class="text-center">組織5</th>
                        <th class="text-center">職種</th>
                        <th class="text-center">役職</th>
                        <th class="text-center">等級</th>
                        <th class="text-center">事業所</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($table_data[0]))
                        @foreach ($table_data[0] as $row)
                            <tr employee_cd="{{$row['employee_cd']}}" employee_nm="{{$row['employee_nm']}}">
                                <td class="text-center">{{$row['check_out']}}</td>
                                <td class="text-right">
                                    <div class="text-overfollow" style="width: 90px;"  data-toggle="tooltip">
                                        {{$row['employee_cd']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['employee_nm']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['employee_typ_nm']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow" data-toggle="tooltip">
                                        {{$row['organization_nm1']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['organization_nm2']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['organization_nm3']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['organization_nm4']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['organization_nm5']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['job_nm']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['position_nm']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['grade_nm']}}
                                    </div>
                                </td>
                                <td class="text-width">
                                    <div class="text-overfollow"  data-toggle="tooltip">
                                        {{$row['office_nm']}}
                                    </div>
                                </td>
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