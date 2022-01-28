@isset($profile->portfolios)
    @foreach($profile->portfolios as $port)
        <div class="row">
            <div class="col-md-6">
                <div class="item">
                    <div class="item-header" data-toggle="collapse" data-target="#portfolio{{ $port->id }}">
                        <i class="fas fa-caret-down"></i>{{ $port->name }}
                    </div>
                    <div id="portfolio{{ $port->id }}" class="collapse show">
                        <div class="item-body">
                            <a href="{{ convert_url($port->link) }}">{{ $port->link }}</a>
                        </div>
                        <div class="item-date">
                            {{ (new DateTime($port->date))->format('Y年m月制作') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @if($port->image)
                    <img src="{{ upload_asset($port->image) }}" alt="" class="image-upload mb-2">
                @else
                    <img src="{{ static_asset('assets/img/icon-image.png') }}" alt="">
                @endif
            </div>
        </div>
    @endforeach
@endisset