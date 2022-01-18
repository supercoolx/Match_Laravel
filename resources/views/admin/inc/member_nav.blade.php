<div class="member-registrant-search d-flex justify-content-center">
    <form method="get" id="search_form">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="icon-search"></span>
                </div>
            </div>
            <input type="text" class="form-control" name="search" placeholder="検索">
        </div>
    </form>
</div>
<div class="member-registrant-tab">
    <div class="member-registrant-tab-item{{ $tab_for == 'engineer' ? ' active' : '' }}" data-tab="engineer"><a href="{{ route('admin.members', ['tab_for' => 'engineer']) }}"><span>応募者</span></a></div>
    <div class="member-registrant-tab-item{{ $tab_for == 'agent' ? ' active' : '' }}" data-tab="agent"><a href="{{ route('admin.members', ['tab_for' => 'agent']) }}"><span>エージェント</span></a></div>
    <div class="member-registrant-tab-item{{ $tab_for == 'company' ? ' active' : '' }}" data-tab="company"><a href="{{ route('admin.members', ['tab_for' => 'company']) }}"><span>企業</span></a></div>
</div>
