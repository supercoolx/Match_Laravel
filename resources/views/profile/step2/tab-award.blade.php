@if($profile && isset($profile->employees))
    @foreach($profile->employees as $em)
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#employee{{ $em->id }}">
                <i class="fas fa-caret-down"></i>{{ $em->employee_name }}
            </div>
            <div id="employee{{ $em->id }}" class="collapse show">
                <div class="item-date">{{ (new DateTime($em->employee_date))->format('Y年m月') }}</div>
            </div>
        </div>
    @endforeach
@endif