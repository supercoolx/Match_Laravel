@extends('layout.app')

@section('content')
    <section class="row">
        <div class="col-md-6" style="background-color: #f7f6f3">
            <div class="d-flex justify-content-center">
                <div class="auth-reset-password-form auth-form">
                    <div class="d-flex justify-content-center">
                        <img src="{{ static_asset('assets/img/logo/logo.png') }}" alt="logo" class="mb-5">
                    </div>
                    <form method="POST" action="{{ route('password.update') }}" class="my-5">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}" required>
                        <input type="hidden" name="email" value='{{ $email }}' required>
                        <div class="form-group">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="新しいパスワードを入力"  required autocomplete="new-password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="新しいパスワード(確認)を入力" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-circle-black my-5">パスワードを変更する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 side-image" style="background-image: url(/public/assets/img/login/reset2.png)"></div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('button[type=submit]').click(function (e) {
                if($('#password').val() != $('#confirmPassword').val()) {
                    toastr.error('パスワードが一致しません。');
                    e.preventDefault();
                }
            });
        })
    </script>
@endsection
