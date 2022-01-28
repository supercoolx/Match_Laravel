@if($profile && isset($profile->writings))
    @foreach($profile->writings as $wri)
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#writing{{ $wri->id }}">
                <i class="fas fa-caret-down"></i>{{ $wri->name }}
            </div>
            <div id="writing{{ $wri->id }}" class="collapse show">
                <div class="item-date">{{ (new DateTime($wri->date))->format('Y年m月') }}</div>
            </div>
        </div>
    @endforeach
@endif