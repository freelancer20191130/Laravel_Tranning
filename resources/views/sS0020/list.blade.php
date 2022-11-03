{!! \App\Utill\Pagingate::Pagingate($result[1][0] ?? []) !!}
<div class="card-left">
    <div class="card-title">登録リスト</div>
    <ul id="card-list">
        @foreach($result[0] as $item)
        <li class="card-item authority_nm" data-cd="{{$item['authority_cd']}}">{{$item['authority_nm']}}</li>
        @endforeach
    </ul>
</div>