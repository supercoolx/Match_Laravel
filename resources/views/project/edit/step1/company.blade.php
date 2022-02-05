<form method="POST" role="form" action="{{ isset($project) ? route('company.project.update') : route('company.project.post') }}" enctype="multipart/form-data" id="form">
    @csrf
    <input type="hidden" name="imagePath" id="imagePath" value="{{ isset($project) ? $project->image : old('imagePath') }}">
    <input type="file" name="image" id="image" class="d-none">
    @isset($project)
        <input type="hidden" name="id" id="id" value="{{ $project->id }}">
    @endisset
    <div class="form-group">
        <label for="caseName" class="col-form-label">募集タイトル</label>
        <input type="text" class="form-control{{ $errors->has('caseName') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->name : old('caseName') }}" id="caseName" name="caseName" placeholder="応募タイトルを入力" required >
    </div>
    <div class="form-group">
        <label for="jobType" class="col-form-label">職種</label>
        <select class="form-control{{ $errors->has('jobType') ? ' is-invalid' : '' }}" id="jobType" name="jobType" required>
            <option disabled selected>職種を選択</option>
            @foreach($jobTypes as $jobType)
                <option value="{{ $jobType->id }}"{{ $jobType->id == (isset($project) ? $project->job_type : old('jobType')) ? ' selected' : '' }}>{{ $jobType->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="industry" class="col-form-label">業界</label>
        <select class="form-control{{ $errors->has('industry') ? ' is-invalid' : '' }}" id="industry" name="industry" required>
            <option disabled selected>業界を選択</option>
            @foreach($industries as $industry)
                <option value="{{ $industry->id }}"{{ $industry->id == (isset($project) ? $project->industry : old('industry')) ? ' selected' : '' }}>{{ $industry->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="col-form-label">契約形態</label>
        <div>
            @foreach($contractTypes as $contractType)
                <div class="form-check">
                    <input class="form-check-input contractType" type="checkbox" name="contractType[{{ $contractType->id }}]" id="contractType{{ $contractType->id }}" {{ (isset($project) ? in_array($contractType->id, array_column($project->contractTypes->toArray(), 'id')) : old("contractType[$contractType->id]")) ? 'checked' : '' }}>
                    <label class="form-check-label" for="contractType{{ $contractType->id }}">{{ $contractType->name }}</label>
                </div>
            @endforeach
        </div>
        <span class="invalid-feedback" role="alert">
            <strong></strong>
        </span>
    </div>
    <div class="form-group">
        <label class="col-form-label">週</label>
        <div>
            @foreach($weeks as $week)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="week" id="week{{ $week->id }}" {{ $week->id == (isset($project) ? $project->week : old('week')) ? 'checked' : '' }} value="{{ $week->id }}">
                    <label class="form-check-label" for="week{{ $week->id }}">{{ $week->name }}</label>
                </div>
            @endforeach
        </div>
        <span class="invalid-feedback" role="alert">
            <strong></strong>
        </span>
    </div>
    <div class="form-group">
        <label for="unitPrice" class="col-form-label">単価/月</label>
        <div class="unite-price-range">
            <div>
                <input type="text" class="form-control{{ $errors->has('unitPriceMin') ? ' is-invalid' : '' }} price" value="{{ isset($project) ? number_comma($project->price_min) : number_comma(old('unitPriceMin')) }}" id="unitPriceMin" name="unitPriceMin" placeholder="単価を入力" required>
            </div>
            <span>円&nbsp;&nbsp;&nbsp;～&nbsp;</span>
            <div>
                <input type="text" class="form-control{{ $errors->has('unitPriceMax') ? ' is-invalid' : '' }} price" value="{{ isset($project) ? number_comma($project->price_max) : number_comma(old('unitPriceMax')) }}" id="unitPriceMax" name="unitPriceMax" placeholder="単価を入力" required>
            </div>
            <span>円</span>
        </div>
    </div>
    <div class="form-group">
        <label for="jobContent" class="col-form-label">職務内容</label>
        <textarea class="form-control{{ $errors->has('jobContent') ? ' is-invalid' : '' }}" id="jobContent" name="jobContent" rows="8" placeholder="職務内容を入力" required>{{ isset($project) ? $project->content : old('jobContent') }}</textarea>
    </div>
    <div class="form-group">
        <label for="requiredSkills" class="col-form-label">必須スキル</label>
        <textarea class="form-control{{ $errors->has('requiredSkills') ? ' is-invalid' : '' }}" id="requiredSkills" name="requiredSkills" rows="8" placeholder="必須スキルを入力" required>{{ isset($project) ? $project->required_skills : old('requiredSkills') }}</textarea>
    </div>
    <div class="form-group">
        <label for="applicableSkills" class="col-form-label">尚可スキル</label>
        <textarea class="form-control{{ $errors->has('applicableSkills') ? ' is-invalid' : '' }}" id="applicableSkills" name="applicableSkills" rows="8" placeholder="尚可スキルを入力" required>{{ isset($project) ? $project->applicable_skills : old('applicableSkills') }}</textarea>
    </div>
    <div class="form-group">
        <label for="requiredPerson" class="col-form-label">求める人物像</label>
        <textarea class="form-control{{ $errors->has('requiredPerson') ? ' is-invalid' : '' }}" id="requiredPerson" name="requiredPerson" rows="8" placeholder="求める人物像を入力" required>{{ isset($project) ? $project->required_person : old('requiredPerson') }}</textarea>
    </div>
    <div class="form-group">
        <label for="teamStructure" class="col-form-label">チーム体制</label>
        <textarea class="form-control{{ $errors->has('teamStructure') ? ' is-invalid' : '' }}" id="teamStructure" name="teamStructure" rows="8" placeholder="チーム体制を入力" required>{{ isset($project) ? $project->team_structure : old('teamStructure') }}</textarea>
    </div>
    <div class="form-group">
        <label for="gainedSkills" class="col-form-label">得られるスキル</label>
        <textarea class="form-control{{ $errors->has('gainedSkills') ? ' is-invalid' : '' }}" id="gainedSkills" name="gainedSkills" rows="8" placeholder="取られるスキルを入力" required>{{ isset($project) ? $project->gained_skills : old('gainedSkills') }}</textarea>
    </div>
    <div class="form-group">
        <label for="workLocation" class="col-form-label">勤務地</label>
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
    <div class="form-group">
        <label for="interviews" class="col-form-label">面談回数</label>
        <div>
            @if(isset($project))
                @foreach(range(1,3) as $interview)
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="interviews" id="interviews{{ $interview }}" value="{{ $interview }}"{{ $interview == $project->interviews ? ' checked' : '' }}>
                        <label class="form-check-label" for="interviews{{ $interview }}">{{ $interview }}回</label>
                    </div>
                @endforeach
            @else
                @foreach(range(1,3) as $interview)
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="interviews" id="interviews{{ $interview }}" value="{{ $interview }}"{{ $interview === old('interviews') ? ' checked' : '' }}>
                        <label class="form-check-label" for="interviews{{ $interview }}">{{ $interview }}回</label>
                    </div>
                @endforeach
            @endif
        </div>
        <span class="invalid-feedback" role="alert">
            <strong></strong>
        </span>
    </div>
    <div class="form-group">
        <label for="openStartDate" class="col-form-label">作業開始日</label>
        <input type="text" class="form-control{{ $errors->has('startDate') ? ' is-invalid' : '' }} datepicker" value="{{ isset($project) ? $project->start_date : old('startDate') }}" id="openStartDate" name="startDate" placeholder="作業開始日を入力" required>
        <span class="icon-calendar"><img src="{{ static_asset('assets/img/calendar.png') }}" alt=""></span>
    </div>
    <div class="form-group">
        <label for="startTime" class="col-form-label">始業/終業時間</label>
        <div class="start-end-time">
            <div>
                <input type="text" class="form-control{{ $errors->has('startTime') ? ' is-invalid' : '' }} timepicker" value="{{ isset($project) ? $project->start_time : old('startTime') }}" id="startTime" name="startTime" placeholder="始業時間を入力" required>
            </div>
            <span>&nbsp;～&nbsp;</span>
            <div>
                <input type="text" class="form-control{{ $errors->has('endTime') ? ' is-invalid' : '' }} timepicker" value="{{ isset($project) ? $project->end_time : old('endTime') }}" id="endTime" name="endTime" placeholder="終業時間を入力" required>
            </div>
        </div>
        <span class="invalid-feedback" role="alert">
            <strong></strong>
        </span>
    </div>
    <div class="form-group">
        <label for="averageUptimeStart" class="col-form-label">平均稼働時間</label>
        <div class="start-end-time">
            <div>
                <input type="number" class="form-control{{ $errors->has('averageUptimeStart') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->uptime_min : old('averageUptimeStart') }}" id="averageUptimeStart" name="averageUptimeStart" placeholder="下限時間を入力" required>
            </div>
            <span>h&nbsp;~&nbsp;</span>
            <div>
                <input type="number" class="form-control{{ $errors->has('averageUptimeEnd') ? ' is-invalid' : '' }}" value="{{ isset($project) ? $project->uptime_max : old('averageUptimeEnd') }}" id="averageUptimeEnd" name="averageUptimeEnd" placeholder="上限時間を入力" required>
            </div>
            <span>&nbsp;h</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">オンライン商談</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" {{ 1 === (isset($project) ? $project->online_interview : old('onlineInterview')) ? 'checked' : '' }} name="onlineInterview" id="onlineInterview1" value="1">
                <label class="form-check-label" for="onlineInterview1">可</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" {{ 0 === (isset($project) ? $project->online_interview : old('onlineInterview')) ? 'checked' : '' }} name="onlineInterview" id="onlineInterview0" value="0">
                <label class="form-check-label" for="onlineInterview0">不可</label>
            </div>
        </div>
        <span class="invalid-feedback" role="alert">
            <strong></strong>
        </span>
    </div>
    <div class="form-group">
        <label class="col-form-label">リモートワーク</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" {{ 1 === (isset($project) ? $project->remote_work : old('remoteWork')) ? 'checked' : '' }} name="remoteWork" id="remoteWork1" value="1">
                <label class="form-check-label" for="remoteWork1">可</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" {{ 0 === (isset($project) ? $project->remote_work : old('remoteWork')) ? 'checked' : '' }} name="remoteWork" id="remoteWork0" value="0">
                <label class="form-check-label" for="remoteWork0">不可</label>
            </div>
        </div>
        <span class="invalid-feedback" role="alert">
            <strong></strong>
        </span>
    </div>
    <div class="form-group">
        <label for="comment" class="col-form-label">コメント</label>
        <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" name="comment" rows="8" placeholder="コメントを入力" required>{{ isset($project) ? $project->comment : old('comment') }}</textarea>
    </div>
    <div class="form-group">
        <label class="col-form-label">画像のアップロード</label>
    </div>
    <div class="form-group">        
        @if(isset($project))
            <img src="{{ $project->image ? upload_asset($project->image) : static_asset('assets/img/icon-image.png') }}" alt="" class="image-upload object-cover-center">
        @else
            <img src="{{ static_asset('assets/img/icon-image.png') }}" alt="" class="image-upload object-cover-center">
        @endif
    </div>
    <div class="case-entry-btn text-center">
        <button type="submit" class="btn btn-black-sm btn-next">確認</button>
    </div>
</form>