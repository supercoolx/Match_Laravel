@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="auth-login-form auth-form administrative-console">
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
                            <button type="submit" class="btn btn-theme btn-medium">ログイン</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('password.request') }}" class="forget-password-link text-center">パスワードをお忘れの方</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
