@extends('layout.app')

@section('content')
    @if (count($projects) > 0)
        <section class="content-section" style="background-color: white">
            <div class="gray-bar"></div>
            <div class="container">
                <div class="section-header text-center">
                    <p>募集中の案件一覧</p>
                    <div class="section-header-divider"></div>
                    <p>該当案件数{{ count($projects) }}件中 {{ count($projects) }}件を表示</p>
                </div>
                <div class="row justify-content-center">
                    @foreach($projects as $project)
                        <div class="content-case-entry for-company">
                            <div class="img-thumbnail-preview">
                                @if(isset($project))
                                    <img src="{{ $project->image ? upload_asset($project->image) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="">
                                @else
                                    <img src="{{ old('imagePath') ? upload_asset(old('imagePath')) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="">
                                @endif
                            </div>
                            <div class="input-title-preview">
                                <div class="job-type-industry">
                                    <span class="btn job-type">{{ isset($project) ? $project->jobType->name : '職種' }}</span>
                                    <span class="btn job-industry">{{ isset($project) ? $project->industries->name : '業界' }}</span>
                                    <span class="preview-value" data-for="week">週{{ isset($project) ? $project->weeks->name : old('week') }}</span>
                                </div>
                                <h2 data-for="caseName" class="pt-2">{{ isset($project) ? $project->name : old('caseName') }}</h2>
                                <div data-for="unitPrice">¥ {{ isset($project) ? number_comma($project->price_min) : number_comma(old('unitPriceMin')) }} ~ {{ isset($project) ? number_comma($project->price_max) : number_comma(old('unitPriceMax')) }}/ 月</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label></label>
                                </div>
                                <div class="preview-value" data-for="contractType">{{ $project->content }}</div>
                            </div>
                            <div class="publisher">
                                <img src="{{ $project->user->avatar ? upload_asset($project->user->avatar) : static_asset('assets/img/avatar/default.png') }}" class="object-cover-center" alt="">
                                <span>{{ $project->user->name }}</span>
                                <span class="float-right"><a href="{{ route('projects.detail', ['id' => $project->id]) }}" class="btn btn-circle btn-detail">詳細</a></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="content-section" style="background-color: white">
            <div class="gray-bar" style="position: absolute"></div>
            <div class="container">
                <div class="section-header text-center">
                    <p>募集中の案件一覧</p>
                    <div class="section-header-divider"></div>
                    <p>該当件数0件中件表示</p>
                    <p class="not-found-text">現在、管理している求人・案件はございません</p>
                </div>
                <div class="content-no-posted for-corporate-dashboard">
                    <div class="d-flex justify-content-center">
                        <img src="{{ static_asset('assets/img/no_project.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
    {{-- <script src="{{ static_asset('assets/js/page-user-agent.js') }}"></script> --}}
@endsection