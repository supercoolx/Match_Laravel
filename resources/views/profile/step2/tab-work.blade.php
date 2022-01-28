@if($profile && isset($profile->experiences))
    @foreach($profile->experiences as $exp)
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#experience{{ $exp->id }}">
                <i class="fas fa-caret-down"></i>{{ $exp->title }}
            </div>
            <div id="experience{{ $exp->id }}" class="collapse show">
                <div class="item-date">{{ (new DateTime($exp->start_date))->format('Y年m月') }} ~ {{ (new DateTime($exp->end_date))->format('Y年m月') }}</div>
                <div class="item-body">
                    {{ $exp->content }}
                </div>
            </div>
        </div>
    @endforeach
@endif