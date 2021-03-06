@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="row">
            <div class="col-md-6">
                <div class="content-center">
                    <form action="{{ route('invite.send') }}" method="post" class="d-flex flex-column align-items-center py-xl-5">
                        @csrf
                        <p>招待する友達のメールアドレスを入力してください</p>
                        <input type="email" class="form-control mt-2" name="email" placeholder="メ ールアドレスを入力" value="{{ old('email') }}" style="width: 363px;" required oninvalid="this.setCustomValidity('有効なメールアドレスを入力してください')">
                        <button type="submit" class="btn btn-black-sm mt-5">招待</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 side-image" style="background-image: url(/public/assets/img/invite/step1.png)">

            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
    <script>
        @if($errors->has('email'))
            toastr.error("{{ $errors->first('email') }}");
        @endif
    </script>
@endsection
