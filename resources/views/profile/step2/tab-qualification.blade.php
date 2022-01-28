@if($profile && isset($profile->qualifications))
    @foreach($profile->qualifications as $qua)
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#qualification{{ $qua->id }}">
                <i class="fas fa-caret-down"></i>{{ $qua->name }}
            </div>
            <div id="qualification{{ $qua->id }}" class="collapse show">
                <div class="item-date">{{ (new DateTime($qua->date))->format('Y年m月') }}</div>
            </div>
        </div>
    @endforeach
@endif