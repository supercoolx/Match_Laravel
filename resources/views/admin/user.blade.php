@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="member-registrant">
                    @include('admin.inc.member_nav')
                    <div class="registrant-person-detail management-console">
                        <div class="member-registrant-actions">
                            <div class="registrant-actions-left">
                                <a href="javascript: history.back();" class="registrant-person-back"></a>
                            </div>
                            <div class="registrant-actions-right">
                                <div class="registrant-remove">削除</div>
                                <form action="{{ route('admin.members.delete') }}" method="POST" id="deleteform">
                                    @csrf
                                    <input type="hidden" name="user_id[]" value="{{ $user->id }}">
                                </form>
                            </div>
                        </div>
                        <div class="text-center w-100 deletion-confirm-message d-none">こちらの情報を削除してもよろしいですか？</div>
                        <div class="d-flex justify-content-center avatar-picker">
                            <img src="{{ $user->avatar ? upload_asset($user->avatar) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
                            <button class="btn btn-before-interview">面談前</button>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>氏名</label>
                            </div>
                            <div class="preview-value">{{ $user->name }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>氏名(カナ)</label>
                            </div>
                            <div class="preview-value">{{ $user->name_kana }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>電話番号</label>
                            </div>
                            <div class="preview-value">{{ $user->phone }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>メールアドレス</label>
                            </div>
                            <div class="preview-value">{{ $user->email }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>パスワード</label>
                            </div>
                            <div class="preview-value">**********</div>
                        </div>
                        <div class="registrant-deletion-buttons text-center d-none">
                            <button class="btn btn-circle-black btn-no">いいえ</button>
                            <button class="btn btn-circle btn-yes">はい</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('div.registrant-remove').click(function () {
                $('div.deletion-confirm-message').removeClass('d-none');
                $('div.registrant-deletion-buttons').removeClass('d-none');
            });
            $('button.btn-no').click(function () {
                $('div.deletion-confirm-message').addClass('d-none');
                $('div.registrant-deletion-buttons').addClass('d-none');
            });
            $('button.btn-yes').click(function () {
                $('#deleteform').submit();
            })
        });
    </script>
@endsection
