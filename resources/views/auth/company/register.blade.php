@extends('layout.app')

@section('content')
    <div id="focus"></div>
    <section class="content-section">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 d-flex justify-content-center">
                            <div class="content-member-input for-companies">
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
                                        <input type="hidden" name="userType" value="{{ config("constants.user_type.company") }}">
                                        <input type="hidden" name="avatarPath" id="avatarPath" value="{{ old('avatarPath') }}">
                                        <div class="d-flex justify-content-center avatar-picker">
                                            <img src="{{ old('avatarPath') ? upload_asset(old('avatarPath')) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
                                            <input type="file" id="avatar" name="avatar" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">会社名</label>
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" name="name" placeholder="Scope株式会社" required maxlength="255">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nameKana" class="col-form-label">会社名(カナ)</label>
                                            <input type="text" class="form-control{{ $errors->has('nameKana') ? ' is-invalid' : '' }}" value="{{ old('nameKana') }}" id="nameKana" name="nameKana" placeholder="スコープカブシキガイシャ" required maxlength="255">
                                            @if ($errors->has('nameKana'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nameKana') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label">電話番号</label>
                                            <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" id="phone" name="phone" placeholder="03-6680-8680" required>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">メールアドレス</label>
                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" name="email" placeholder="info@scopecorp.co.jp" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmEmail" class="col-form-label">メールアドレス(確認)</label>
                                            <input type="email" class="form-control{{ $errors->has('email_confirmation') ? ' is-invalid' : '' }}" value="{{ old('email_confirmation') }}" id="confirmEmail" name="email_confirmation" placeholder="上記同様のメールアドレスをご入力ください" required data-parsley-equalto="#email">
                                            @if ($errors->has('email_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">パスワード</label>
                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="password" required minlength="6" maxlength="20" data-parsley-error-message="半角英数字記号6文字以上20文字以内で入力してください" data-parsley-pattern="/^[a-zA-Z0-9!@#$%^&*]{6,20}$/">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-form-label">パスワード(確認)</label>
                                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password-confirm" name="password_confirmation" placeholder="上記同様のパスワードをご入力ください" required data-parsley-equalto="#password" minlength="6" data-parsley-required-message="半角英数字記号6文字以上20文字以内で入力してください" data-parsley-pattern-message="半角英数字記号6文字以上20文字以内で入力してください" data-parsley-pattern="/^[a-zA-Z0-9!@#$%^&*]{6,20}$/">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="website" class="col-form-label">会社URL</label>
                                            <input type="url" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" id="website" value="{{ old('website') }}" name="website" placeholder="会社URL" required>
                                            @if ($errors->has('website'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('website') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="member-input-btn text-center">
                                            <button type="submit" class="btn btn-black btn-next">確認画面</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="step-content{{ session('step') && session('step') === 2 ? ' active': '' }}" data-step="2">
                                    <div class="d-flex justify-content-center avatar-picker">
                                        <img src="{{ old('avatarPath') ? upload_asset(old('avatarPath')) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>会社名</label>
                                        </div>
                                        <div class="col-sm-7 preview-value" data-for="name">{{ old('name') }}</div>
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>会社名(カナ)</label>
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
                                        <div class="col-sm-7 preview-value">password</div>
                                    </div>
                                    <div class="input-preview row">
                                        <div class="col-sm-5 preview-label">
                                            <label>会社URL</label>
                                        </div>
                                        <div class="col-sm-7 preview-value" data-for="website">{{ old('website') }}</div>
                                    </div>
                                    <div class="terms-policy-text">
                                        <p><a href="{{ route('policy') }}">「<span>個人情報の取扱いについて</span>」</a>と<a href="{{ route('terms') }}">「<span>利用規約</span>」</a>をご確認の上、「同意して登録する」を押してください。</p>
                                    </div>
                                    <div class="member-input-btn text-center">
                                        <button class="btn btn-black btn-prev">修正する</button>
                                        <button class="btn btn-black btn-next">同意して登録する</button>
                                    </div>
                                </div>
                                <div class="step-content{{ session('step') && session('step') === 3 ? ' active': '' }}" data-step="3">
                                    <div class="completion-icon">
                                        登録完了しました
                                    </div>
                                    <div class="member-input-btn d-flex justify-content-center">
                                        <a href="{{ route('company.dashboard') }}" class="btn btn-theme btn-medium d-flex justify-content-center align-items-center">ダッシュボードへ</a>
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
<style>
#focus{
  border:3px solid #fef6fb;
  box-shadow:0 0 10px 0 #e8e7e4;
  position:absolute;
  transition:
    width .2s ease, 
    height .2s ease, 
    left .2s ease, 
    top .2s ease, 
    border-radius .2s ease;
  z-index:5;
  display:none;
  box-sizing:border-box;
}
.form-control:focus{
    box-shadow: none;
}
div.side-image{
    background-image: url("{{static_asset('assets/img/register/step1.png')}}");
    background-size: contain;
    background-repeat: no-repeat;
    background-color: white;
}
</style>
@endsection

@section('script')
    <script type="text/javascript">
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

        const elProgressBar = $('.progress-bar');
        const stepDot1 = $('.step-item[data-step="1"]');
        const stepDot2 = $('.step-item[data-step="2"]');
        const stepDot3 = $('.step-item[data-step="3"]');

        const stepContent1 = $('.step-content[data-step="1"]');
        const stepContent2 = $('.step-content[data-step="2"]');
        const stepContent3 = $('.step-content[data-step="3"]');

        const inputAvatar = $('input#avatar');
        function setStep(step) {
            elProgressBar.css('width', ((step - 1) * 50) + '%');
            elProgressBar.attr('aria-valuenow', ((step - 1) * 50) + '%');
            $('.step-content').removeClass('active');

            switch (step) {
                case 1:
                    stepDot2.removeClass('active');
                    stepDot3.removeClass('active');
                    stepContent1.addClass('active');
                    $('div.side-image').css('background-image', 'url("{{static_asset('assets/img/register/step1.png')}}")');
                    break;
                case 2:
                    stepDot2.addClass('active');
                    stepDot3.removeClass('active');
                    stepContent2.addClass('active');
                    $('div.side-image').css('background-image', 'url("{{static_asset('assets/img/register/step2.png')}}")');
                    break;
                case 3:
                    stepDot3.addClass('active');
                    stepContent3.addClass('active');
                    $('div.side-image').css('background-image', 'url("{{static_asset('assets/img/register/step3.png')}}")');
                    break;
            }
        }
        function checkAvatarFile(domId) {
            const fileInput = document.getElementById(domId);
            if (fileInput.files.length < 1) return false;
            const file = fileInput.files[0];
            const fileType = file["type"];
            return $.inArray(fileType, validImageTypes) !== -1;
        }
        function checkAvatarPath() {
            const avatarPath = $('#avatarPath').val();
            return avatarPath && avatarPath.length > 0;
        }
        $(document).ready(function () {
            var form = $('#form');
            var elPhone = document.getElementById('phone');
            var maskPhone = IMask(elPhone, {
                mask: '00-0000-0000'
            });
            var parsleyInstance = form.parsley();
            stepContent1.find('.btn-next').click(function (e) {
                e.preventDefault();
                if (parsleyInstance.validate()) {
                    setStep(2);
                    // if (checkAvatarFile(inputAvatar.attr('id')) || checkAvatarPath()) {
                    // } else {
                    //     toastr.error('', '画像を選択してください');
                    // }
                }
            });
            stepContent2.find('.btn-next').click(function (e) {
                e.preventDefault();
                form.submit();
                // setStep(3);
            });
            stepContent2.find('.btn-prev').click(function (e) {
                e.preventDefault();
                setStep(1);
            });
            // $('.step-wizard').on('click', '.step-item.active', function (e) {
            //     console.log($(this).data('step'));
            //     setStep($(this).data('step'));
            // });
            form.on('input', 'input.form-control', function (e) {
                $(this).parents('.form-group').find('.invalid-feedback').remove();
                const domID = $(this).attr('id');
                const inputVal = $(this).val();
                $('.preview-value[data-for="' + domID +'"]').text(inputVal);
            });
            stepContent1.find('.avatar-picker img').click(function (e) {
                $('.avatar-picker img').attr('src', '{{ static_asset('assets/img/avatar/default.png') }}');
                inputAvatar.click();
            });
            inputAvatar.on('change', function (e) {
                const file = this.files[0];
                if (checkAvatarFile(inputAvatar.attr('id'))) {
                    if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                        return false;
                    }
                    const fileReader = new FileReader();
                    fileReader.onload = function () {
                        $('.avatar-picker img').attr('src', fileReader.result);
                    };
                    fileReader.readAsDataURL(file);
                } else {
                    inputAvatar.val('');
                    toastr.error('', '画像を選択してください');
                }
            });
        });
        
        const FOCUS = $("#focus"); // focus element

        // function for positioning the div
        function position(e) {
        // get position
            var props = {
                top: e.offset().top,
                left: e.offset().left,
                width: e.outerWidth(),
                height: e.outerHeight(),
                radius: parseInt(e.css("border-radius"))
            };
            
            // set position
            FOCUS.css({
                top: props.top,
                left: props.left,
                width: props.width,
                height: props.height,
                "border-radius": props.radius
            });
            
            FOCUS.fadeIn(200);
        }

        $('input').each(function(i) {
            $(this).focus(function() {
                el = $(this);
                position(el);
            });
        });

        $('input').on("focusout", function(e) {
            setTimeout(function() {
                if (!(document.activeElement instanceof HTMLInputElement)) {
                    FOCUS.fadeOut(200);
                }
            }, 0);
        });
    </script>
@endsection
