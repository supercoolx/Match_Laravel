@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            @if(!count($projects))
                <div class="content-no-posted for-corporate-dashboard">
                    <p>現在、応募している求人・案件はございません</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('projects.list') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">求人・案件一覧ページへ</a>
                    </div>
                </div>
            @else
                <div class="row section-header">
                    <div class="col-md-12 text-center">
                        <h1>管理している求人・案件一覧</h1>
                        <div class="section-header-divider"></div>
                        <p>該当案件数{{ count($projects) }}件中 {{ $cnt }}件表示</p>
                    </div>
                </div>
                <div class="content-list">
                    <div class="project-dashboard-tab">
                        <div class="project-dashboard-tab-item {{ $tabs_for == config("constants.tab_for.agent") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.agent") }}')"><span>エージェント</span></div>
                        <div class="project-dashboard-tab-item {{ $tabs_for == config("constants.tab_for.company") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.company") }}')"><span>企業</span></div>
                    </div>
                    <div class="row justify-content-center">
                        {{ $projects->links() }}
                        @foreach($projects as $project)
                            @if($tabs_for == config("constants.tab_for.agent"))
                                @include('project.template.agent')
                            @elseif($tabs_for == config("constants.tab_for.company"))
                                @include('project.template.company')
                            @endif
                        @endforeach
                    </div>
                    <div class="row justify-content-center">
                        {{ $projects->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
<script>
    function setUserTypeTab(userType) {
        window.location.href = '{{ route('engineer.dashboard') }}?for=' + userType;
    }
</script>
@endsection
