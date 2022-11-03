{!! \App\Utill\Pagingate::Pagingate($result[1][0] ?? []) !!}
<div class="card-left">
    <div class="card-title">登録リスト</div>
    <ul id="card-list">
        @foreach($result[0] as $item)
        <li class="card-item authority_nm job_master" data-job_cd="{{$item['job_cd']}}" data-job_nm="{{$item['job_nm']}}" data-job_ab_nm="{{$item['job_ab_nm']}}" data-arrange_order="{{$item['arrange_order']}}">{{$item['job_nm']}}</li>
        @endforeach
    </ul>
</div>