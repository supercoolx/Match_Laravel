@extends('layout.app')

@section('content')
<section class="content-section has-sidebar">
    <div class="list-container">
        @include('inc.search_bar.score')
        <div class="content-list content-profile-list">
            <div class="section-tab">
                <div class="section-tab-item active" data-target="#page-graph">グラフ</div>
                <div class="section-tab-item" data-target="#page-badge">称号バッジ</div>
            </div>
            <div class="page-content mx-5" id="page-graph">
                <div class="row">
                    <div class="col-6 my-4">
                        <div id="projects-chart"></div>
                    </div>
                    <div class="col-6 my-4">
                        <div id="projects-view-chart"></div>
                    </div>
                    <div class="col-6 my-4">
                        <div id="projects-end-chart"></div>
                    </div>
                    <div class="col-6 my-4">
                        <div id="follow-chart"></div>
                    </div>
                    <div class="col-6 my-4">
                        <div id="followed-chart"></div>
                    </div>
                    <div class="col-6 my-4">
                        <div id="invite-chart"></div>
                    </div>
                </div>
            </div>
            <div class="page-content row" id="page-badge" style="display: none">
                <div class="col-4">
                    <p class="text-center font-weight-bold text-black my-5">公開案件数</p>
                    @if($review['level']['projects'])
                        <div class="d-flex justify-content-center align-items-center my-2">
                            <img src="{{ static_asset("assets/img/reward/project-".$review['level']['projects'].".png") }}" alt="reward">
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <p class="text-center font-weight-bold text-black my-5">公開案件閲覧数</p>
                    @if($review['level']['projects_view'])
                        <div class="d-flex justify-content-center align-items-center my-2">
                            <img src="{{ static_asset("assets/img/reward/attention-".$review['level']['projects_view'].".png") }}" alt="reward">
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <p class="text-center font-weight-bold text-black my-5">契約成立数</p>
                    @if($review['level']['projects_end'])
                        <div class="d-flex justify-content-center align-items-center my-2">
                            <img src="{{ static_asset("assets/img/reward/contract-".$review['level']['projects_end'].".png") }}" alt="reward">
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <p class="text-center font-weight-bold text-black my-5">フォロー数</p>
                    @if($review['level']['follow_cnt'])
                        <div class="d-flex justify-content-center align-items-center my-2">
                            <img src="{{ static_asset("assets/img/reward/following-".$review['level']['follow_cnt'].".png") }}" alt="reward">
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <p class="text-center font-weight-bold text-black my-5">フォロワー数</p>
                    @if($review['level']['followed_cnt'])
                        <div class="d-flex justify-content-center align-items-center my-2">
                            <img src="{{ static_asset("assets/img/reward/follower-".$review['level']['followed_cnt'].".png") }}" alt="reward">
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <p class="text-center font-weight-bold text-black my-5">友達招待数</p>
                    @if($review['level']['invites'])
                        <div class="d-flex justify-content-center align-items-center my-2">
                            <img src="{{ static_asset("assets/img/reward/friend-".$review['level']['invites'].".png") }}" alt="reward">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('style')
    
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/apexcharts.js') }}"></script>
    <script>
        var review = @json($review);
    </script>
    <script src="{{ static_asset('assets/js/page-score.js') }}"></script>
@endsection