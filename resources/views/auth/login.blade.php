@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="auth-login-form auth-form">
                    <form method="POST" role="form" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" id="email" placeholder="" required autofocus oninvalid="this.setCustomValidity('有効なメールアドレスを入力してください')">
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
            <div class="d-flex justify-content-center">
                <div>
                    <a href="{{ route('company.register') }}" class="register-link for-companies">無料会員登録する(採用企業の方)</a>
                    <a href="{{ route('agent.register') }}" class="register-link for-agent">無料会員登録する(エージェントの方)</a>
                    <a href="{{ route('engineer.register') }}" class="register-link for-applicants">無料会員登録する(応募者の方)</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('input[type="email"]').val(localStorage.getItem('email'));
            $('input[type="password"]').val(localStorage.getItem('password'));
            $('input[type="email"]').keyup(function () {
                localStorage.setItem('email', $(this).val());
            });
            $('input[type="password"]').keyup(function () {
                localStorage.setItem('password', $(this).val());
            });
        });
    </script>
@endsection
