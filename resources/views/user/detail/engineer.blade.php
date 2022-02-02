@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="applicant-profile-input">
            @include('profile.step2.engineer')
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ static_asset('assets/js/page-user-engineer.js') }}"></script>
@endsection