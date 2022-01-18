@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="auth-forget-password-form auth-form">
                    <p>パスワードの再設定手順をお送りいたします。</p>
                    @if (old('success'))
                        <div class="alert alert-success" role="alert">
                            {{ old('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" id="email" placeholder="" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-theme btn-large">パスワードをリセットする</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
