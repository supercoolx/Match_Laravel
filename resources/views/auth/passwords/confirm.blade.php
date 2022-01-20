@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="auth-reset-password-form auth-form">
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder=""  required autocomplete="current-password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-theme btn-large">パスワードを認証する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
