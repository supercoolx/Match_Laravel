<div class="input-title-preview">
    <h2 class="text-center" data-for="caseName">{{ isset($project) ? $project->name : old('caseName') }}</h2>
    <div class="d-flex justify-content-center job-type-industry">
        <button class="btn job-type">{{ isset($project) ? $project->jobType->name : '職種' }}</button>
        <button class="btn job-industry">{{ isset($project) ? $project->industries->name : '業界' }}</button>
    </div>
</div>
<div class="image-upload-preview d-flex align-items-center">
    <img src="{{ $company->avatar ? upload_asset($company->avatar) : static_asset('assets/img/account.png') }}" class="object-cover-center" alt="{{ $company->name }}">
    <span>{{ $company->name }}</span>
</div>
<div class="img-thumbnail-preview">
    @if(isset($project))
        <img src="{{ $project->image ? upload_asset($project->image) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="">
    @else
        <img src="{{ old('imagePath') ? upload_asset(old('imagePath')) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="">
    @endif
</div>
<div class="website-url-preview">
    <a href="{{ $company->website }}">{{ $company->website }}</a>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>契約形態</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="contractType">{{ isset($project) ? $project->contractType->name : '' }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>週</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="week">{{ isset($project) ? $project->weeks->name : old('week') }}日</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>職務内容</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="jobContent">{{ isset($project) ? $project->content : old('jobContent') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>必須スキル</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="requiredSkills">{{ isset($project) ? $project->required_skills : old('requiredSkills') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>尚可スキル</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="applicableSkills">{{ isset($project) ? $project->applicable_skills : old('applicableSkills') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>求める人物像</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="requiredPerson">{{ isset($project) ? $project->required_person : old('requiredPerson') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>チーム体制</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="teamStructure">{{ isset($project) ? $project->team_structure : old('teamStructure') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>得られるスキル</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="gainedSkills">{{ isset($project) ? $project->gained_skills : old('gainedSkills') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>勤務地</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="workLocation">{{ isset($project) ? $project->address->name : old('workLocation') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>面談回数</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="interviews">{{ isset($project) ? $project->interviews : '1 回' }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>作業開始日</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="openStartDate">{{ isset($project) ? $project->start_date : old('startDate') }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>始業/終業時間</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="startEndTime">{{ isset($project) ? $project->start_time : old('startTime') }}時  ～  {{ isset($project) ? $project->end_time : old('endTime') }}時</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>平均稼働時間</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="averageUptimeStartEnd">{{ isset($project) ? $project->uptime_min : old('averageUptimeStart') }}h  ～  {{ isset($project) ? $project->uptime_max : old('averageUptimeEnd') }}h</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>オンライン面談</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="onlineInterview">{{ (isset($project) ? $project->online_interview : old('onlineInterview')) == 1 ? '可' : '不可' }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>リモートワーク</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="remoteWork">{{ (isset($project) ? $project->remote_work : old('remoteWork')) == 1 ? '可' : '不可' }}</div>
</div>
<div class="input-preview row">
    <div class="col-sm-5 preview-label">
        <label>コメント</label>
    </div>
    <div class="col-sm-7 preview-value" data-for="comment">{{ isset($project) ? $project->comment : old('comment') }}</div>
</div>
<div class="input-preview-btn-group text-center">
    <button class="btn btn-dark btn-medium btn-prev">修正する</button>
    <button class="btn btn-theme btn-medium btn-next">確認画面へ</button>
</div>