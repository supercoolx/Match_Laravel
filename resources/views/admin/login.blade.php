@extends('layout.app')

@section('content')
    <section class="row">
        <div class="col-md-6" style="background-color: #f7f6f3;">
            <div class="d-flex justify-content-center">
                <div class="auth-login-form auth-form administrative-console">
                    <div class="d-flex justify-content-center">
                        <img src="{{ static_asset('assets/img/logo/logo.png') }}" alt="logo" class="mb-5">
                    </div>
                    <form method="POST" role="form" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" id="email" placeholder="" required  oninvalid="this.setCustomValidity('有効なメールアドレスを入力してください')">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="" required oninvalid="this.setCustomValidity('有効なパスワードを入力して下さい')">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-circle-black mt-4">ログイン</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('password.request') }}" class="text-decoration-none my-4">
                                <div class="btn-square-grey-lg text-center">
                                    パスワードをお忘れの方
                                </div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 side-image" style="background-image: url(/public/assets/img/login/login.png)"></div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
@endsection
