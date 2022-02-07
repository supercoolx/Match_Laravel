@extends('layout.app')

@section('content')
    @if(count($projects))
        <section class="content-section">
            <div class="gray-bar"></div>
            <div class="dashboard" style="background-color: #ffffff">
                <div class="container">
                    <div class="row section-header">
                        <div class="section-tab">
                            <div class="section-tab-item {{ $isFavour ? '' : 'active' }}" onclick="setFavouriteTab(false)">求人・案件一覧</div>
                            <div class="section-tab-item {{ $isFavour ? 'active' : '' }}" onclick="setFavouriteTab(true)">掲載プロフィール一覧</div>
                        </div>
                        <div class="section-tab">
                            <div class="section-tab-item {{ $tabs_for == config("constants.tab_for.agent") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.agent") }}')"><span>エージェント</span></div>
                            <div class="section-tab-item {{ $tabs_for == config("constants.tab_for.company") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.company") }}')"><span>企業</span></div>
                        </div>
                        <div class="section-items-count">該当案件数{{ count($projects) }}件中 {{ $cnt }}件表示</div>
                    </div>
                    <div class="content-list">
                        <div class="justify-content-center">
                            {{ $projects->links() }}
                        </div>
                        <div class="justify-content-center">
                            @if($tabs_for == config("constants.tab_for.agent"))
                                @foreach($projects as $project)
                                    <div class="project-item">
                                        <div class="job-type-industry">
                                            <span class="btn job-type">{{ $project->jobType->name }}</span>
                                            <span class="btn job-industry">{{ $project->industries->name }}</span>
                                            <span class="job-day">週 {{ $project->weeks->name }}</span>
                                        </div>
                                        <h2 class="mt-4">{{ $project->name }}</h2>
                                        <h3>{{ number_comma($project->price_min) }} ~ {{ number_comma($project->price_max) }} / 月</h3>
                                        <div class="divider"></div>
                                        <p>{{ $project->content }}</p>
                                        <div class="publisher">
                                            <img src="{{ upload_asset($project->user->avatar) ?? static_asset('assets/img/avatar/default.png') }}" class="object-cover-center" alt="">
                                            <span>{{ $project->user->name }}</span>
                                            <a href="{{ route('projects.detail', ['id' => $project->id]) }}" class="btn btn-circle btn-blue-light float-right">詳細</a>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($tabs_for == config("constants.tab_for.company"))
                                @foreach($projects as $project)
                                    <div class="project-item">
                                        <img src="{{ $project->image ? upload_asset($project->image) : static_asset('assets/img/project-thumb.jpg') }}" alt="" class="project-thumb object-cover-center">
                                        <div class="job-type-industry">
                                            <span class="btn job-type">{{ $project->jobType->name }}</span>
                                            <span class="btn job-industry">{{ $project->industries->name }}</span>
                                            <span class="job-day">週 {{ $project->weeks->name }}</span>
                                        </div>
                                        <h2 class="mt-4">{{ $project->name }}</h2>
                                        <h3>{{ number_comma($project->price_min) }} ~ {{ number_comma($project->price_max) }} / 月</h3>
                                        <div class="divider"></div>
                                        <p>{{ $project->content }}</p>
                                        <div class="publisher">
                                            <img src="{{ $project->user->avatar ? upload_asset($project->user->avatar) : static_asset('assets/img/avatar/default.png') }}" class="object-cover-center" alt="">
                                            <span>{{ $project->user->name }}</span>
                                            <a href="{{ route('projects.detail', ['id' => $project->id]) }}" class="btn btn-circle btn-blue-light float-right">詳細</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="justify-content-center">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="content-section" style="background-color: white">
            <div class="gray-bar" style="position: absolute"></div>
            <div class="container">
                <div class="section-header text-center">
                    <h5>募集中の案件一覧</h5>
                    <div class="section-header-divider black"></div>
                    <p>該当件数0件中 0件表示</p>
                    <p class="not-found-text">現在、管理している求人・案件はございません</p>
                </div>
                <div class="content-no-posted for-corporate-dashboard">
                    <a href="{{ route('projects.list') }}" class="btn btn-circle-black" style="width: 248px;">求人•案件を公開する</a>
                    <div class="d-flex justify-content-center">
                        <img src="{{ static_asset('assets/img/no_project.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
<script>
    function setUserTypeTab(userType) {
        window.location.href = '{{ route('engineer.dashboard') }}?for=' + userType <?= $isFavour ? "+ '&favourite'" : '' ?>;
    }
    function setFavouriteTab(isFavour) {
        window.location.href = '{{ route('engineer.dashboard') }}' + (isFavour ? '?favourite' : '');
    }
</script>
@endsection
