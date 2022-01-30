@extends('layout.app')

@section('content')
    <section class="content-section">
        @include('inc.step')
        <div class="edit-content">
            <div class="user-contact">
                <div class="image-upload-preview d-flex flex-column align-items-center">
                    <img src="{{ Auth::user()->avatar ? upload_asset(Auth::user()->avatar) : static_asset('assets/img/account.png') }}" class="object-cover-center" alt="{{ Auth::user()->name }}">
                    <span>{{ Auth::user()->name }}</span>
                    <a href="#" class="btn btn-theme btn-chat d-flex justify-content-center align-items-center">チャットで話を聞く</a>
                    <a href="#" class="btn btn-theme btn-call d-flex justify-content-center align-items-center">電話で話を聞く</a>
                    <a href="#" class="btn btn-theme btn-fix d-flex justify-content-center align-items-center">気になるリストに追加</a>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="content-case-entry for-company step{{ session('step') }}">
                            <div class="step-content{{ (session('step') && session('step') === 1) || !session('step') ? ' active': '' }}" data-step="1">
                                @if(isCompany())
                                    @include('project.edit.step1.company')
                                @elseif(isAgent())
                                    @include('project.edit.step1.agent')
                                @endif
                            </div>
                            <div class="step-content{{ session('step') && session('step') === 2 ? ' active': '' }}" data-step="2">
                                @if(isCompany())
                                    @include('project.edit.step2.company')
                                @elseif(isAgent())
                                    @include('project.edit.step2.agent')
                                @endif
                            </div>
                            <div class="step-content{{ session('step') && session('step') === 3 ? ' active': '' }}" data-step="3">
                                @include('project.edit.step3.default')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/lib/jquery.timepicker/jquery.timepicker.css') }}">
@endsection

@section('script')
    <script type="text/javascript">
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

        const jobTypes = {
            @foreach($jobTypes as $jobType)
            "{{ $jobType->id }}": "{{ $jobType->name }}",
            @endforeach
        };
        const industries = {
            @foreach($industries as $industry)
            "{{ $industry->id }}": "{{ $industry->name }}",
            @endforeach
        };
        const addresses = {
            @foreach($addresses as $address)
            "{{ $address->id }}": "{{ $address->name }}",
            @endforeach
        }
        const weeks = {
            @foreach($weeks as $week)
            "{{ $week->id }}": "{{ $week->name }}",
            @endforeach
        };
        const contractTypes = {
            @foreach($contractTypes as $contractType)
            "{{ $contractType->id }}": "{{ $contractType->name }}",
            @endforeach
        };
        const onlineInterviews = {
            '0': "不可",
            '1': "可"
        }
        const remoteWorks = {
            '0': "不可",
            '1': "可"
        }
        const img_thumbnail_preview = '{{ static_asset('assets/img/icon-image.png') }}';
    </script>
    <script src="{{ static_asset('assets/lib/jquery.timepicker/jquery.timepicker.js') }}"></script>
    <script src="{{ static_asset('assets/js/page-project-edit.js') }}"></script>
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
@endsection
