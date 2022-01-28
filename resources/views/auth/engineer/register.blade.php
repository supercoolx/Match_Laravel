@extends('layout.app')

@section('content')
    <div id="focus"></div>
    <section class="content-section">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('home') }}">
                                <img src="{{ static_asset('assets/img/logo/logo.png') }}" alt="logo" class="pt-4">
                            </a>
                        </div>
                        <div class="col-md-8 d-flex justify-content-center">
                            <div class="content-member-input">
                                <div class="step-wizard d-flex justify-content-center">
                                    <div class="content-step-wizard d-flex justify-content-between">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{ session('step') ? (session('step') - 1) * 50 : 0 }}%;" aria-valuenow="{{ session('step') ? (session('step') - 1) * 50 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="step-item{{ (session('step') && session('step') > 0) || !session('step') ? ' active': '' }}" data-step="1">入力</div>
                                        <div class="step-item{{ session('step') && session('step') > 1 ? ' active': '' }}" data-step="2">確認</div>
                                        <div class="step-item{{ session('step') && session('step') > 2 ? ' active': '' }}" data-step="3">登録</div>
                                    </div>
                                </div>
                                <div class="step-content{{ (session('step') && session('step') === 1) || !session('step') ? ' active': '' }}" data-step="1">
                                    <form method="POST" role="form" action="{{ route('register') }}" enctype="multipart/form-data" id="form">
                                        @csrf
                                        <input type="hidden" name="userType" value="{{ config("constants.user_type.engineer") }}">
                                        <input type="hidden" name="avatarPath" id="avatarPath" value="{{ old('avatarPath') }}">
                                        <div class="d-flex justify-content-center avatar-picker">
                                            <img src="{{ old('avatarPath') ? upload_asset(old('avatarPath')) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
                                            <input type="file" id="avatar" name="avatar" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">氏名</label>
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" name="name" placeholder="氏名を入力" required maxlength="255">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nameKana" class="col-form-label">氏名(カナ)</label>
                                            <input type="text" class="form-control{{ $errors->has('nameKana') ? ' is-invalid' : '' }}" value="{{ old('nameKana') }}" id="nameKana" name="nameKana" placeholder="氏名(カナ)を入力" required maxlength="255">
                                            @if ($errors->has('nameKana'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nameKana') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label">電話番号</label>
                                            <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" id="phone" name="phone" placeholder="電話番号を入力" required>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">メールアドレス</label>
                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" name="email" placeholder="メールアドレスを入力" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmEmail" class="col-form-label">メールアドレス(確認)</label>
                                            <input type="email" class="form-control{{ $errors->has('email_confirmation') ? ' is-invalid' : '' }}" value="{{ old('email_confirmation') }}" id="confirmEmail" name="email_confirmation" placeholder="上記同様のメールアドレスを入力" required data-parsley-equalto="#email">
                                            @if ($errors->has('email_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">パスワード</label>
                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="パスワードを入力" required minlength="6" maxlength="20" data-parsley-error-message="半角英数字記号6文字以上20文字以内で入力してください" data-parsley-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*\W)[A-Za-z\d\W]{6,20}$/">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-form-label">パスワード(確認)</label>
                                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password-confirm" name="password_confirmation" placeholder="上記同様のパスワードを入力" required data-parsley-equalto="#password" minlength="6" data-parsley-required-message="半角英数字記号6文字以上20文字以内で入力してください" data-parsley-pattern-message="半角英数字記号6文字以上20文字以内で入力してください" data-parsley-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*\W)[A-Za-z\d\W]{6,20}$/">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="member-input-btn text-center">
                                            <button type="submit" class="btn btn-black btn-next">確認</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="step-content{{ session('step') && session('step') === 2 ? ' active': '' }}" data-step="2">
                                    <div class="d-flex justify-content-center avatar-picker">
                                        <img src="{{ old('avatarPath') ? upload_asset(old('avatarPath')) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>氏名</label>
                                        </div>
                                        <div class="col-sm-7 preview-value" data-for="name">{{ old('name') }}</div>
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>氏名(カナ)</label>
                                        </div>
                                        <div class="col-sm-7 preview-value" data-for="nameKana">{{ old('nameKana') }}</div>
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>電話番号</label>
                                        </div>
                                        <div class="col-sm-7 preview-value" data-for="phone">{{ old('phone') }}</div>
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>メールアドレス</label>
                                        </div>
                                        <div class="col-sm-7 preview-value" data-for="email">{{ old('email') }}</div>
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>パスワード</label>
                                        </div>
                                        <div class="col-sm-7 preview-value" data-for="password">**********</div>
                                    </div>
                                    <div class="terms-policy-text">
                                        <p>「<a href="{{ route('policy') }}" target="_blank"><span>個人情報の取扱いについて</span></a>」と「<a href="{{ route('terms') }}" target="_blank"><span>利用規約</span></a>」への同意が必要です</p>
                                    </div>
                                    <div class="member-input-btn text-center">
                                        <p><button class="btn btn-black btn-next">同意して登録</button></p>
                                        <p><button class="btn btn-black btn-prev">修正</button></p>
                                    </div>
                                </div>
                                <div class="step-content{{ session('step') && session('step') === 3 ? ' active': '' }}" data-step="3">
                                    <div class="completion-icon">
                                        登録完了しました
                                    </div>
                                    <div class="member-input-btn text-center">
                                        <p><a href="#" class="btn btn-black justify-content-center align-items-center">チュートリアル</a></p>
                                        <p><a href="{{ route('engineer.dashboard') }}" class="btn btn-black justify-content-center align-items-center">ダッシュボードへ</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 side-image"></div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script src="{{ static_asset('assets/js/page-register.js') }}"></script>
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
@endsection
