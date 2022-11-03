@extends('layouts.layouts')

@section('asset_header')
    <link rel="stylesheet" href={{ asset('css/screens/m0050.css') }} type="text/css">
@endsection
@section('title-screen')
    等級マスタ
@endsection
@section('list-buttons')
    <x-button-component name="saveButton backButton" />
@endsection

@section('asset_footer')
    <script src="js/screens/m0050.js"></script>
@stop

@section('main-content')
    <div class="container-fluid p-0 pr-3 mt-3">
        <div class="card">
            <div class="card-body p-0 p-3">
               <div class="row">
                   <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-wap">
                                <thead>
                                <tr>
                                    <th class="text-center">等級</th>
                                    <th class="text-center">等級名</th>
                                    <th>
                                        <button class="btn btn-rm blue btn-sm" id="add_new_row">
				        					<i class="fa fa-plus"></i>
				        				</button></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="tl-body">
                                @foreach($result[0]  as $key => $item)
                                    @if($loop->count == $key+1) 
                                        <input type="hidden" value ="{{$item['grade']}}" id="last-grade"/>
                                    @endif
                                    <tr>
                                        <td><input id="" type="text" data-id="" class="form-control grade" disabled value="{{$item['grade']}}"></td>
                                        <td><input id="grade_nm{{$item['grade']}}" type="text" data-id="" class="form-control grade_nm  required" value="{{$item['grade_nm']}}" maxlength="10"></td>
                                        <td>
                                            <button class="btn btn-rm red btn-sm btn_remove">
				        		    			<i class="fa fa-remove"></i>
				        		    		</button>
                                        </td>
                                        <td class="text-center row-hover"><i class="fa fa-arrows" aria-hidden="true"></i></td>
                                    </tr>
                                @endforeach
                              
                                </tbody>
                            </table>
                        </div>
                   </div>
               </div>
               
            </div>
        </div>
    </div>
@stop

