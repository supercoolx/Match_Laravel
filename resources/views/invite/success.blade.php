@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="row">
            <div class="col-md-6">
                <div class="content-center text-center">
                    <p class="font-weight-bold my-xl-5 text-dark">招待しました!</p>
                    <a href="{{ route('home') }}" class="btn btn-circle-black my-xl-5 w-25">ダッシュボード</a>
                </div>
            </div>
            <div class="col-md-6 side-image" style="background-image: url(/public/assets/img/invite/step2.png)">

            </div>
        </div>
    </section>
@endsection
