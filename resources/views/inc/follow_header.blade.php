<div class="row section-header">
    <div class="section-tab">
        <div class="section-tab-item" onclick="setListTypeTab('{{ route('user.followed.list') }}')">フォロー</div>
        <div class="section-tab-item active" onclick="setListTypeTab('{{ route('user.follow.list') }}')">フォロワー</div>
    </div>
    <div class="section-tab">                    
        <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.engineer") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.engineer") }}')">応募者</div>
        <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.agent") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.agent") }}')">エージェント</div>
        <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.company") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.company") }}')">企業</div>
    </div>
    @if(Route::currentRouteName() == 'user.list')
        <div class="section-items-count">該当案件数{{ count($users) }}件中 {{ $count }}件表示</div>
    @elseif(Route::currentRouteName() == 'projects.list')
        <div class="section-items-count">該当案件数{{ count($projects) }}件中 {{ $count }}件表示</div>
    @endif
</div>
