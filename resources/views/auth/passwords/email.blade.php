@extends('layout.app')

@section('content')
    <section class="row">
        <div class="col-md-6" style="background-color: #f7f6f3">
            <div class="d-flex justify-content-center">
                <div class="auth-forget-password-form auth-form">
                    <div class="d-flex justify-content-center">
                        <img src="{{ static_asset('assets/img/logo/logo.png') }}" alt="logo" class="mb-5">
                    </div>
                    <p class="my-5 text-black font-weight-bold">パスワードの再設定手順をお送りいたします。</p>
                    @if (old('success'))
                        <div class="alert alert-success" role="alert">
                            {{ old('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}" class="mt-5">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} my-5" value="{{ old('email') }}" name="email" id="email" placeholder="メ ールアドレスを入力" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-circle-black mb-5">パスワードをリセットする</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 side-image" style="background-image: url(/public/assets/img/login/reset1.png)"></div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
@endsection