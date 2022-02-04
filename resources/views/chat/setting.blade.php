@extends('layout.app')

@section('content')
    <section class="content-section" style="background-color: white">
        <div class="gray-bar" style="position: absolute"></div>
        <div class="container">
            <div class="section-header text-center">
                <p>チャットのメール通知設定</p>
                <div class="section-header-divider black"></div>
                <p class="mt-5">チャットに受信があった場合、メールを</p>
                <form action="{{ route('chat.setting') }}" method="POST">
                    @csrf
                    <input type="radio" name="email" id="email_on" value="1" {{ Auth::user()->chat_mail ? 'checked' : '' }}>
                    <label for="email_on">受け取る</label>
                    <input type="radio" name="email" id="email_off" value="0" {{ Auth::user()->chat_mail ? '' : 'checked' }}>
                    <label for="email_off">受け取らない</label>
                </form>
            </div>
            <div class="content-no-posted for-corporate-dashboard">
                <button class="btn btn-circle-black btn-submit" style="width: 194px">変更する</button>
                <div class="d-flex justify-content-end">
                    <img src="{{ static_asset('assets/img/chat-setting.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.btn-submit').click(function () {
            $('form').submit();
        })
    </script>
@endsection