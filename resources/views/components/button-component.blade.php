@foreach ($result as $button_item)
    @if ($button_item['permission'] != 'disabled')
        <div id="{{ $button_item["id"] }}" class="button {{$button_item["class"]}}">
            <div class="icon">
                <i class="{{$button_item["icon"]}}" aria-hidden="true"></i>
            </div>
            <div class="text">
                {{$button_item["text"]}}
            </div>
        </div>
    @endif
@endforeach


