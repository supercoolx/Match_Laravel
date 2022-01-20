<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">
    <link rel="shortcut icon" href="{{ static_asset('favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ static_asset('favicon.png') }}" type="image/x-icon">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>プラットフォーム</title>
    <meta name="description" content="プラットフォーム">
    <meta name="keyword" content="プラットフォーム">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link media="all" type="text/css" rel="stylesheet" href="{{ static_asset('assets/css/bootstrap.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-toggle.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ static_asset('assets/css/daterangepicker.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ static_asset('assets/css/dropzone.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ static_asset('assets/css/basic.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ static_asset('assets/css/public.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ static_asset('assets/lib/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/toastr.min.css') }}">
    @yield('style')
    <script src="{{ static_asset('assets/js/jquery.min.js') }}"></script>
</head>
<body>

<div class="site-wrapper">
    <!-- Header -->
    @include('inc.nav')

    @yield('content')

    @if(Route::currentRouteName() !== 'chat.index' && Route::currentRouteName() !== 'chat.channel')
        @include('inc.footer')
    @endif
</div>


@yield('modals')
<script src="{{ static_asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ static_asset('assets/js/popper.min.js') }}"></script>
<script src="{{ static_asset('assets/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ static_asset('assets/js/moment-with-locales.js') }}"></script>
<script src="{{ static_asset('assets/js/daterangepicker.min.js') }}"></script>
<script src="{{ static_asset('assets/js/toastr.min.js') }}" ></script>
<script src="{{ static_asset('assets/js/imask.min.js') }}" ></script>
<script src="{{ static_asset('assets/js/ofi.min.js') }}" ></script>
<script src="{{ static_asset('assets/js/parsley.min.js') }}" ></script>
<script src="{{ static_asset('assets/js/i18n/ja.js') }}" ></script>
<script src="{{ static_asset('assets/js/i18n/ja.extra.js') }}" ></script>
{{--<script src="{{ static_asset('assets/dist/js/app.js') }}"></script>--}}
<script src="{{ static_asset('assets/js/main.js') }}"></script>

@yield('script')

<script type="text/javascript">
    @foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['level'] === 'danger')
    toastr.error('', '{{ $message['message'] }}');
    @else
    toastr.{{ $message['level'] }}('', '{{ $message['message'] }}');
    @endif
    @endforeach
</script>
</body>
</html>
