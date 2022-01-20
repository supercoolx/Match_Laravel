<form method="POST" role="form" action="{{ isset($project) ? route('agent.project.update') : route('agent.project.post') }}" enctype="multipart/form-data" id="form">
    @csrf
    @isset($project)
        <input type="hidden" name="id" id="id" value="{{ $project->id }}">
    @endisset
    <div class="form-group row">
        <label for="caseName" class="col-sm-4 col-form-label">案件名</label>
        <div class="col-sm-6">
            <input type="text" class="form-control{{ $errors->has('caseName') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->name : old('caseName') }}" id="caseName" name="caseName" placeholder="募集タイトルを入力" required >
        </div>
    </div>
    <div class="form-group row">
        <label for="unitPriceMin" class="col-sm-4 col-form-label">単価</label>
        <div class="col-sm-6 unite-price-range">
            <div>
                <input type="text" class="form-control{{ $errors->has('unitPriceMin') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->price_min : old('unitPriceMin') }}" id="unitPriceMin" name="unitPriceMin" min="0" placeholder="単価を入力" required data-parsley-type="number">
            </div>
            <span>～</span>
            <div>
                <input type="text" class="form-control{{ $errors->has('unitPriceMax') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->price_max : old('unitPriceMax') }}" id="unitPriceMax" name="unitPriceMax" min="0" placeholder="単価を入力" required data-parsley-type="number">
            </div>
            <span class="unit">円</span>
        </div>
    </div>
    <div class="form-group row">
        <label for="jobType" class="col-sm-4 col-form-label">職種</label>
        <div class="col-sm-7">
            <select class="form-control{{ $errors->has('jobType') ? ' is-invalid' : '' }}" id="jobType" name="jobType" required>
                <option disabled selected>職種を選択</option>
                @foreach($jobTypes as $jobType)
                    <option value="{{ $jobType->id }}"{{ $jobType->id == (isset($project) ? $project->job_type : old('jobType')) ? ' selected' : '' }}>{{ $jobType->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="industry" class="col-sm-4 col-form-label">業界</label>
        <div class="col-sm-7">
            <select class="form-control{{ $errors->has('industry') ? ' is-invalid' : '' }}" id="industry" name="industry" required>
                <option disabled selected>業界を選択</option>
                @foreach($industries as $industry)
                    <option value="{{ $industry->id }}"{{ $industry->id == (isset($project) ? $project->industry : old('industry')) ? ' selected' : '' }}>{{ $industry->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="jobContent" class="col-sm-4 col-form-label">職務内容</label>
        <div class="col-sm-8">
            <textarea class="form-control{{ $errors->has('jobContent') ? ' is-invalid' : '' }}" id="jobContent" name="jobContent" rows="8" placeholder="職務内容を入力" required>{{ isset($project) ? $project->content : old('jobContent') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="requiredSkills" class="col-sm-4 col-form-label">必須スキル</label>
        <div class="col-sm-8">
            <textarea class="form-control{{ $errors->has('requiredSkills') ? ' is-invalid' : '' }}" id="requiredSkills" name="requiredSkills" rows="8" placeholder="必須スキルを入力" required>{{ isset($project) ? $project->required_skills : old('requiredSkills') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="applicableSkills" class="col-sm-4 col-form-label">尚可スキル</label>
        <div class="col-sm-8">
            <textarea class="form-control{{ $errors->has('applicableSkills') ? ' is-invalid' : '' }}" id="applicableSkills" name="applicableSkills" rows="8" placeholder="尚可スキルを入力" required>{{ isset($project) ? $project->applicable_skills : old('applicableSkills') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="requiredPerson" class="col-sm-4 col-form-label">求める人物像</label>
        <div class="col-sm-8">
            <textarea class="form-control{{ $errors->has('requiredPerson') ? ' is-invalid' : '' }}" id="requiredPerson" name="requiredPerson" rows="8" placeholder="求める人物像を入力" required>{{ isset($project) ? $project->required_person : old('requiredPerson') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="teamStructure" class="col-sm-4 col-form-label">チーム体制</label>
        <div class="col-sm-8">
            <textarea class="form-control{{ $errors->has('teamStructure') ? ' is-invalid' : '' }}" id="teamStructure" name="teamStructure" rows="8" placeholder="チーム体制を入力" required>{{ isset($project) ? $project->team_structure : old('teamStructure') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="gainedSkills" class="col-sm-4 col-form-label">得られるスキル</label>
        <div class="col-sm-8">
            <textarea class="form-control{{ $errors->has('gainedSkills') ? ' is-invalid' : '' }}" id="gainedSkills" name="gainedSkills" rows="8" placeholder="得られるスキルを入力" required>{{ isset($project) ? $project->gained_skills : old('gainedSkills') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="workLocation" class="col-sm-4 col-form-label">勤務地</label>
        <div class="col-sm-7">
            <select class="form-control{{ $errors->has('workLocation') ? ' is-invalid' : '' }}" id="workLocation" name="workLocation" required>
                <option disabled selected>勤務地を選択</option>
                @if(isset($project))
                    @foreach($addresses as $address)
                        <option value="{{ $address->id }}" {{ $address->id == $project->work_location ? 'selected' : '' }}>{{ $address->name }}</option>
                    @endforeach
                @else
                    @foreach($addresses as $address)
                        <option value="{{ $address->id }}">{{ $address->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="interviews" class="col-sm-4 col-form-label">面談回数</label>
        <div class="col-sm-7">
            <div class="d-flex">
                <select class="form-control{{ $errors->has('interviews') ? ' is-invalid' : '' }}" id="interviews" name="interviews" required>
                    <option disabled selected>面談回数</option>
                    @if(isset($project))
                        @foreach(range(1,3) as $interview)
                            <option value="{{ $interview }}"{{ $interview == $project->interviews ? ' selected' : '' }}>{{ $interview }}</option>
                        @endforeach
                    @else
                        @foreach(range(1,3) as $interview)
                            <option value="{{ $interview }}"{{ $interview === old('interviews') ? ' selected' : '' }}>{{ $interview }}回</option>
                        @endforeach
                    @endif
                </select>
                <span class="interviews-unit">回</span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="openStartDate" class="col-sm-4 col-form-label">作業開始日</label>
        <div class="col-sm-7">
            <input type="text" class="form-control{{ $errors->has('startDate') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->start_date : old('startDate') }}" id="openStartDate" name="startDate" placeholder="作業開始日を入力" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="startTime" class="col-sm-4 col-form-label">始業/終業時間</label>
        <div class="col-sm-7 ">
            <div class="start-end-time">
                <div>
                    <input type="text" class="time-mask form-control{{ $errors->has('startTime') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->start_time : old('startTime') }}" id="startTime" name="startTime" placeholder="始業時間を入力" required>
                </div>
                <span>～</span>
                <div>
                    <input type="text" class="time-mask form-control{{ $errors->has('endTime') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->end_time : old('endTime') }}" id="endTime" name="endTime" placeholder="終業時間を入力" required>
                </div>
            </div>
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label for="averageUptimeStart" class="col-sm-4 col-form-label">平均稼働時間</label>
        <div class="col-sm-7">
            <div class="start-end-time">
                <div>
                    <input type="number" class="form-control{{ $errors->has('averageUptimeStart') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->uptime_min : old('averageUptimeStart') }}" id="averageUptimeStart" name="averageUptimeStart" placeholder="下限時間を入力" required>
                </div>
                <span>～</span>
                <div>
                    <input type="number" class="form-control{{ $errors->has('averageUptimeEnd') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->uptime_max : old('averageUptimeEnd') }}" id="averageUptimeEnd" name="averageUptimeEnd" placeholder="上限時間を入力" required>
                </div>
            </div>
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">週</label>
        <div class="col-sm-7">
            <div>
                @foreach($weeks as $week)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="week" {{ $week->id == (isset($project) ? $project->week : old('week')) ? 'checked' : '' }} value="{{ $week->id }}">
                        <label class="form-check-label">{{ $week->name }}</label>
                    </div>
                @endforeach
            </div>
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">契約形態</label>
        <div class="col-sm-7">
            <div>
                @foreach($contractTypes as $contractType)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="contractType" {{ $contractType->id == (isset($project) ? $project->contract_type : old('contractType')) ? 'checked' : '' }} value="{{ $contractType->id }}">
                        <label class="form-check-label">{{ $contractType->name }}</label>
                    </div>
                @endforeach
            </div>
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">オンライン面談</label>
        <div class="col-sm-7">
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" {{ 1 === (isset($project) ? $project->online_interview : old('onlineInterview')) ? 'checked' : '' }} name="onlineInterview" value="1">
                    <label class="form-check-label">可</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" {{ 0 === (isset($project) ? $project->online_interview : old('onlineInterview')) ? 'checked' : '' }} name="onlineInterview" value="0">
                    <label class="form-check-label">不可</label>
                </div>
            </div>
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">リモートワーク</label>
        <div class="col-sm-7">
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" {{ 1 === (isset($project) ? $project->remote_work : old('remoteWork')) ? 'checked' : '' }} name="remoteWork" value="1">
                    <label class="form-check-label">可</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" {{ 0 === (isset($project) ? $project->remote_work : old('remoteWork')) ? 'checked' : '' }} name="remoteWork" value="0">
                    <label class="form-check-label">不可</label>
                </div>
            </div>
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label for="comment" class="col-sm-4 col-form-label">コメント</label>
        <div class="col-sm-8">
            <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" name="comment" rows="8" placeholder="コメントを入力" required>{{ isset($project) ? $project->comment : old('comment') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="icon" class="col-sm-4 col-form-label">アイコン</label>
        <div class="col-sm-8">
            <input type="checkbox" id="icon" {{ 1 === (old('icon')) ? 'checked' : '' }}  name="icon" value="1" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios">
        </div>
    </div>
    <div class="form-group row">
        <label for="fullName" class="col-sm-4 col-form-label">氏名</label>
        <div class="col-sm-8">
            <input type="checkbox" id="fullName" {{ 1 === (old('fullName')) ? 'checked' : '' }} name="fullName" value="1" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios">
        </div>
    </div>
    <div class="case-entry-btn text-center">
        <button type="submit" class="btn btn-theme btn-medium btn-next">確認画面へ</button>
    </div>
</form>