@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="content-no-posted">
                <form action="{{ route('admin.password.change') }}" method="post">
                    @csrf

                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach 
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">現在のパスワード</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">新しいパスワード</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">パスワードを認証する</label>

                        <div class="col-md-6">
                            <input id="new_confirm_password" type="password" class="form-control" name="confirm_password" autocomplete="current-password">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-theme btn-medium">
                                パスワードの更新
                            </button>
                        </div>
                    </div>                 
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection