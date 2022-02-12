@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="applicant-profile-input">
            <div class="step-wizard d-flex justify-content-center">
                <div class="content-step-wizard d-flex justify-content-between">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $step ? ($step - 1) * 50 : 0 }}%;" aria-valuenow="{{ $step ? ($step - 1) * 50 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="step-item{{ $step > 0 ? ' active': '' }}" data-step="1">入力</div>
                    <div class="step-item{{ $step > 1 ? ' active': '' }}" data-step="2">確認</div>
                    <div class="step-item{{ $step > 2 ? ' active': '' }}" data-step="3">掲載</div>
                </div>
            </div>
            <div class="step-content{{ $step == 1 ? ' active': '' }}" data-step="1">
                @include('profile.step1.agent')
            </div>
            <div class="step-content{{ $step == 2 ? ' active': '' }}" data-step="2">
                @include('profile.step2.agent')
            </div>
            <div class="step-content{{ $step == 3 ? ' active': '' }}" data-step="3">
                <div class="completion-icon">
                    登録完了しました
                </div>
                <div class="applicant-profile-completion-buttons d-flex justify-content-center">
                    <button class="btn btn-black" onclick="javascript: location.href = '{{ route('agent.dashboard') }}'">ダッシュボード</a>
                    <button class="btn btn-black" onclick="javascript: location.href = '{{ route('projects.list') }}'">掲載プロフィール一覧</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
    <script src="{{ static_asset('assets/lib/anychart/anychart-core.min.js') }}"></script>
    <script src="{{ static_asset('assets/lib/anychart/anychart-radar.min.js') }}"></script>
    <script src="{{ static_asset('assets/lib/apexcharts.js') }}"></script>
    <script>
        var review = @json($review);
    </script>
    <script src="{{ static_asset('assets/js/page-profile-agent.js') }}"></script>
@endsection