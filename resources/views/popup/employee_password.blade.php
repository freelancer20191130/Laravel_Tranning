<div class="card-body">
    <div class="row m-0">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">ユーザーID</label>
                <span class="control-span">
                    <input type="text" value="{{$_data_sesion['user_id']}}" class="form-control" disabled>
                </span>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label label-required">旧パスワード</label>
                <span class="control-span">
                    <input type="password" class="form-control required" placeholder="旧パスワード">
                </span>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label label-required">新パスワード</label>
                <span class="control-span">
                    <input type="password" class="form-control required" placeholder="新パスワード">
                </span>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label label-required">新パスワード（確認</label>
                <span class="control-span">
                    <input type="password" class="form-control required" placeholder="新パスワード（確認）">
                </span>
            </div>
        </div>
    </div>
    <div class="row m-0 pt-4 pb-5">
        <div class="col-md-12 d-flex justify-content-end">
            <x-button-component name="saveButton"/>
        </div>
    </div>
</div>