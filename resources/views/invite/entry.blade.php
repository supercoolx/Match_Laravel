@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="row">
            <div class="col-md-6">
                <div class="content-center">
                    <form action="#" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $invite->token }}" required>
                        <input type="hidden" name="email" value="{{ $invite->email }}" required>
                        <p class="text-center pb-xl-5">
                            <img src="{{ static_asset('assets/img/logo/logo.png') }}" class="img-fluid mb-xl-5" alt="">
                        </p>
                        <p class="text-center pt-5">
                            <button type="submit" class="btn-square-grey" href="{{ route('engineer.register') }}">お仕事を探している方</button>
                        </p>
                        <p class="text-center">
                            <button type="submit" class="btn-square-grey" href="{{ route('company.register') }}">お仕事を紹介したい方</button>
                        </p>
                        <p class="text-center">
                            <button type="submit" class="btn-square-grey" href="{{ route('agent.register') }}">採用担当者の方</button>
                        </p>
                    </form>
                </div>
            </div>
            <div class="col-md-6 side-image" style="background-image: url(/public/assets/img/invite/step2.png)">

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.btn-square-grey').click(function (e) {
            e.preventDefault();
            $('form').attr('action', $(this).attr('href'));
            $('form').submit();
        })
    </script>
@endsection