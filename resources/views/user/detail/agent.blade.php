@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="applicant-profile-input">
            @include('profile.step2.agent')
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
    <script src="{{ static_asset('assets/lib/anychart/anychart-core.min.js') }}"></script>
    <script src="{{ static_asset('assets/lib/anychart/anychart-radar.min.js') }}"></script>
    <script src="{{ static_asset('assets/lib/apexcharts.js') }}"></script>
    <script>
        var review = @json($review);
    </script>
    <script src="{{ static_asset('assets/js/page-user-agent.js') }}"></script>
@endsection