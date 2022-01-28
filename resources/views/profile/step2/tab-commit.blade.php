<div class="row">
    <div class="col-md-6">
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#salary">
                <i class="fas fa-caret-down"></i>給与
            </div>
            <div id="salary" class="collapse show">
                <div class="item-body">
                    @isset($profile->salary) {{ $profile->salary }} @endisset
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#location">
                <i class="fas fa-caret-down"></i>勤務地
            </div>
            <div id="location" class="collapse show">
                <div class="item-body">
                    @isset($profile->location) {{ $profile->location }} @endisset
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#remote">
                <i class="fas fa-caret-down"></i>リモートワーク
            </div>
            <div id="remote" class="collapse show">
                <div class="item-body">
                    @isset($profile->remote_work->name) {{ $profile->remote_work->name }} @endisset
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#join-date">
                <i class="fas fa-caret-down"></i>希望入社開始日
            </div>
            <div id="join-date" class="collapse show">
                <div class="item-body">
                    @isset($profile->join_date) {{ $profile->join_date }} @endisset
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item-header" data-toggle="collapse" data-target="#dress">
                <i class="fas fa-caret-down"></i>服装
            </div>
            <div id="dress" class="collapse show">
                <div class="item-body">
                    @isset($profile->dress->name) {{ $profile->dress->name }} @endisset
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="item-header" data-toggle="collapse" data-target="#other">
            <i class="fas fa-caret-down"></i>その他
        </div>
        <div id="other" class="collapse show">
            <div class="item-body">
                @isset($profile->other) {{ $profile->other }} @endisset
            </div>
        </div>
    </div>
</div>
