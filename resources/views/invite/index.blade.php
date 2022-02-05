@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="row">
            <div class="col-md-6">
                <div class="content-center">
                    <form action="{{ route('invite.send') }}" method="post" class="d-flex flex-column align-items-center">
                        @csrf
                        <p>招待する友達のメールアドレスを入力してください</p>
                        <input type="email" class="form-control mt-2" name="email" placeholder="メ ールアドレスを入力" style="width: 363px;">
                        <button type="submit" class="btn btn-black-sm mt-5">招待</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 side-image">

            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
@endsection
