@if($profile && isset($profile->educations))
    @foreach($profile->educations as $edu)
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#education{{ $edu->id }}">
                <i class="fas fa-caret-down"></i>{{ $edu->school_name }}
            </div>
            <div id="education{{ $edu->id }}" class="collapse show">
                <div class="item-date">{{ (new DateTime($edu->start_date))->format('Y年m月') }} ~ {{ (new DateTime($edu->end_date))->format('Y年m月') }}</div>
                <div class="item-body">
                    {{ $edu->subject_name }}
                </div>
            </div>
        </div>
    @endforeach
@endif