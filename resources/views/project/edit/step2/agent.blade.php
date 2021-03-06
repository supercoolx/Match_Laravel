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
        <label>契約形態</label>
    </div>
    <div class="preview-value" data-for="contractType">
    </div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>職務内容</label>
    </div>
    <div class="preview-value" data-for="jobContent">{{ isset($project) ? $project->content : old('jobContent') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>必須スキル</label>
    </div>
    <div class="preview-value" data-for="requiredSkills">{{ isset($project) ? $project->required_skills : old('requiredSkills') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>尚可スキル</label>
    </div>
    <div class="preview-value" data-for="applicableSkills">{{ isset($project) ? $project->applicable_skills : old('applicableSkills') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>求める人物像</label>
    </div>
    <div class="preview-value" data-for="requiredPerson">{{ isset($project) ? $project->required_person : old('requiredPerson') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>チーム体制</label>
    </div>
    <div class="preview-value" data-for="teamStructure">{{ isset($project) ? $project->team_structure : old('teamStructure') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>得られるスキル</label>
    </div>
    <div class="preview-value" data-for="gainedSkills">{{ isset($project) ? $project->gained_skills : old('gainedSkills') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>勤務地</label>
    </div>
    <div class="preview-value" data-for="workLocation">{{ isset($project) ? $project->address->name : old('workLocation') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>面談回数</label>
    </div>
    <div class="preview-value" data-for="interviews">{{ isset($project) ? $project->interviews : '1' }} 回</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>作業開始日</label>
    </div>
    <div class="preview-value" data-for="openStartDate">{{ isset($project) ? $project->start_date : old('startDate') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>始業/終業時間</label>
    </div>
    <div class="preview-value" data-for="startEndTime">{{ isset($project) ? $project->start_time : old('startTime') }}  ～  {{ isset($project) ? $project->end_time : old('endTime') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>平均稼働時間</label>
    </div>
    <div class="preview-value" data-for="averageUptimeStartEnd">{{ isset($project) ? $project->uptime_min : old('averageUptimeStart') }}  ～  {{ isset($project) ? $project->uptime_max : old('averageUptimeEnd') }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>オンライン面談</label>
    </div>
    <div class="preview-value" data-for="onlineInterview">{{ (isset($project) ? $project->online_interview : old('onlineInterview')) == 1 ? '可' : '不可' }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>リモートワーク</label>
    </div>
    <div class="preview-value" data-for="remoteWork">{{ (isset($project) ? $project->remote_work : old('remoteWork')) == 1 ? '可' : '不可' }}</div>
</div>
<div class="input-preview">
    <div class="preview-label">
        <label>コメント</label>
    </div>
    <div class="preview-value" data-for="comment">{{ isset($project) ? $project->comment : old('comment') }}</div>
</div>
<div class="input-preview-btn-group text-center">
    <button class="btn btn-black-sm btn-prev">修正</button>
    <button class="btn btn-black-sm btn-next">掲載</button>
</div>