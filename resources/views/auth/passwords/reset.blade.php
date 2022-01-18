@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="auth-reset-password-form auth-form">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value='{{ $email }}'>
                        <div class="form-group">
                            <label for="password">新しいパスワード</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="" autofocus required autocomplete="new-password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">パスワード(確認用)</label>
                            <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-theme btn-large">パスワードを変更する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
