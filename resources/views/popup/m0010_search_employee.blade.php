<div class="card-body">
   <div class="wrapper container-fluid m-0 p-0">
        <div class="row m-0 p-0">
            <div class="col m-0 p-0 mr-3">
                {{-- Top --}}
                <div class="row m-0 p-0">
                    <div class="card w-100">
                        <div class="card-body">
                            {{-- Button hidden when click --}}
                            <div class="hidden-button w-100 text-center">
                                <a href="" data-toggle="collapse" data-target="#collapsePopup" aria-expanded="false" aria-controls="collapsePopup">
                                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                            </div>

                            <div id="collapsePopup" class="collapse show">
                                {{-- Row 1 --}}
                                <div class="row ">
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">社員番号</label>
                                            <span class="control-span">
                                                <div class="num-length w-100">
                                                    <input type="text" id="employee_cd" class="form-control" autocomplete="off" maxlength="50">
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">名前</label>
                                            <span class="control-span">
                                                <div class="num-length w-100">
                                                    <input type="text" id="employee_ab_nm" placeholder="氏名・略・フリガナで検索" class="form-control " autocomplete="off" maxlength="50">
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">事業所</label>
                                            <select name="office_cd" id="office_cd" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                                {{-- Loop --}}
                                                @foreach ($other_cbx_results[0][0] as $item)
                                                    <option value="{{$item['office_cd']}}">{{$item['office_nm']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- Row 2 --}}
                                <div class="row ">
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">部署</label>
                                            <select name="organization_cd_1" id="organization-step1" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                                @foreach ($organization_cbx_data[0] as $item)
                                                    @if ($item['organization_typ'] == 1)
                                                        <option value="{{$item['organization_cd_1']}}">{{$item['organization_nm']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">グループ</label>
                                            <select name="organization_cd_2" id="organization-step2" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">チーム</label>
                                            <select name="organization_cd_3" id="organization-step3" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">組織4</label>
                                            <select name="organization_cd_4" id="organization-step4" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">組織5</label>
                                            <select name="organization_cd_5" id="organization-step5" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- Row 3 --}}
                                <div class="row ">
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">職種</label>
                                            <select name="job_cd" id="job_cd" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                                {{-- Loop --}}
                                                @foreach ($other_cbx_results[1][0] as $item)
                                                    <option value="{{$item['job_cd']}}">{{$item['job_nm']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0 mb-2">
                                            <label class="control-label">役職</label>
                                            <select name="position_cd" id="position_cd" class="form-control" tabindex="3">
                                                <option value="-1"></option>
                                                {{-- Loop --}}
                                                @foreach ($other_cbx_results[2][0] as $item)
                                                    <option value="{{$item['position_cd']}}">{{$item['position_nm']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <div class="form-group m-0 position-absolute" style="top: 50%">
                                            <span class="control-span">
                                                <div class="form-check">
                                                    <label class="form-check-label check-box" >
                                                        該当グループなし
                                                        <input type="checkbox" class="form-check-input" id="company_out_dt_flg">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <x-button-component name="searchButton"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- Bottom --}}
                <div id="table-data" class="row m-0 p-0 pt-2">
                    @include('popup.m0010_table_popup')
                </div>
            </div>
        </div>
   </div>
</div>