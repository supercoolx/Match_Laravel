@extends('layout.app')

@section('content')
<section class="content-section has-sidebar">
    <div class="container">
        <div class="content-sidebar">
            <form method="get" action="{{ route('users.list') }}" id="filter-form">
                <input type="hidden" name="for" value="{{ $search['for'] }}">
                <div class="sidebar-wrapper shadow">
                    <div class="sidebar-item">
                        <div class="sidebar-item-header">
                            フリーワード
                        </div>
                        <div class="sidebar-item-content">
                            <div class="sidebar-search">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="icon-search"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="s" value="" placeholder="検索">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-header">
                            スコア
                        </div>
                        <div class="sidebar-list-label" data-toggle="collapse" data-target="#project">公開案件数</div>
                        <div class="sidebar-radio-list collapse show" id="project">
                            @foreach(range(1, 5) as $level)
                                <div class="sidebar-radio-list-item">
                                    <label class="checkcontainer">Lv.{{ $level }}～
                                        <input type="radio" name="minPrice" value="{{ $level }}">
                                        <span class="radiobtn"></span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="sidebar-radio-list-item">
                                <label class="checkcontainer">Lv.MAX
                                    <input type="radio" name="minPrice" value="0">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar-list-label" data-toggle="collapse" data-target="#project_viewed">公開案件閲覧数</div>
                        <div class="sidebar-radio-list collapse show" id="project_viewed">
                            @foreach(range(1, 5) as $level)
                                <div class="sidebar-radio-list-item">
                                    <label class="checkcontainer">Lv.{{ $level }}～
                                        <input type="radio" name="minPrice" value="{{ $level }}">
                                        <span class="radiobtn"></span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="sidebar-radio-list-item">
                                <label class="checkcontainer">Lv.MAX
                                    <input type="radio" name="minPrice" value="0">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar-list-label" data-toggle="collapse" data-target="#contract">契約成立数</div>
                        <div class="sidebar-radio-list collapse show" id="contract">
                            @foreach(range(1, 5) as $level)
                                <div class="sidebar-radio-list-item">
                                    <label class="checkcontainer">Lv.{{ $level }}～
                                        <input type="radio" name="minPrice" value="{{ $level }}">
                                        <span class="radiobtn"></span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="sidebar-radio-list-item">
                                <label class="checkcontainer">Lv.MAX
                                    <input type="radio" name="minPrice" value="0">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar-list-label" data-toggle="collapse" data-target="#follow">フォロー数</div>
                        <div class="sidebar-radio-list collapse show" id="follow">
                            @foreach(range(1, 5) as $level)
                                <div class="sidebar-radio-list-item">
                                    <label class="checkcontainer">Lv.{{ $level }}～
                                        <input type="radio" name="minPrice" value="{{ $level }}">
                                        <span class="radiobtn"></span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="sidebar-radio-list-item">
                                <label class="checkcontainer">Lv.MAX
                                    <input type="radio" name="minPrice" value="0">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar-list-label" data-toggle="collapse" data-target="#follower">フォロワー数</div>
                        <div class="sidebar-radio-list collapse show" id="follower">
                            @foreach(range(1, 5) as $level)
                                <div class="sidebar-radio-list-item">
                                    <label class="checkcontainer">Lv.{{ $level }}～
                                        <input type="radio" name="minPrice" value="{{ $level }}">
                                        <span class="radiobtn"></span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="sidebar-radio-list-item">
                                <label class="checkcontainer">Lv.MAX
                                    <input type="radio" name="minPrice" value="0">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar-list-label" data-toggle="collapse" data-target="#referral">友達紹介数</div>
                        <div class="sidebar-radio-list collapse show" id="referral">
                            @foreach(range(1, 5) as $level)
                                <div class="sidebar-radio-list-item">
                                    <label class="checkcontainer">Lv.{{ $level }}～
                                        <input type="radio" name="minPrice" value="{{ $level }}">
                                        <span class="radiobtn"></span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="sidebar-radio-list-item">
                                <label class="checkcontainer">Lv.MAX
                                    <input type="radio" name="minPrice" value="0">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-apply-filter d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark btn-medium">検索する</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="content-list content-profile-list">
            <div class="row section-header">
                <div class="section-tab">
                    <div class="section-tab-item" onclick="setListTypeTab('{{ route('projects.list') }}')">求人・案件一覧</div>
                    <div class="section-tab-item active" onclick="setListTypeTab('{{ route('users.list') }}')">掲載プロフィール一覧</div>
                </div>
                <div class="section-tab">                    
                    <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.engineer") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.engineer") }}')">応募者</div>
                    <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.agent") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.agent") }}')">エージェント</div>
                    <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.company") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.company") }}')">企業</div>
                </div>
                <div class="section-items-count">該当案件数{{ count($users) }}件中 5件表示</div>
            </div>
            <div class="row justify-content-center">
                
            </div>
            <div class="row justify-content-center">
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('modals')

@endsection

@section('script')
    <script>
        function setListTypeTab(url) {
            window.location.href = url;
        }
        function setUserTypeTab(userType) {
            window.location.href = '{{ route('users.list') }}?for=' + userType;
        }
    </script>
@endsection