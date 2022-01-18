@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="content-case-entry step{{ session('step') }}">
                        <div class="step-wizard d-flex justify-content-center">
                            <div class="content-step-wizard d-flex justify-content-between">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ session('step') ? (session('step') - 1) * 50 : 0 }}%;" aria-valuenow="{{ session('step') ? (session('step') - 1) * 50 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="step-item{{ (session('step') && session('step') > 0) || !session('step') ? ' active': '' }}" data-step="1">入力</div>
                                <div class="step-item{{ session('step') && session('step') > 1 ? ' active': '' }}" data-step="2">確認</div>
                                <div class="step-item{{ session('step') && session('step') > 2 ? ' active': '' }}" data-step="3">掲載</div>
                            </div>
                        </div>
                        <div class="step-content{{ (session('step') && session('step') === 1) || !session('step') ? ' active': '' }}" data-step="1">
                            <form method="POST" role="form" action="{{ route('agent.project.update') }}" enctype="multipart/form-data" id="form">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $project->id }}">
                                <div class="form-group row">
                                    <label for="caseName" class="col-sm-4 col-form-label">案件名</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control{{ $errors->has('caseName') ? ' is-invalid' : '' }}" value="{{ $project->name }}" id="caseName" name="caseName" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unitPriceMin" class="col-sm-4 col-form-label">単価</label>
                                    <div class="col-sm-6 unite-price-range">
                                        <div>
                                            <input type="text" class="form-control{{ $errors->has('unitPriceMin') ? ' is-invalid' : '' }}" value="{{ $project->price_min }}" id="unitPriceMin" name="unitPriceMin" min="0" required data-parsley-type="number">
                                        </div>
                                        <span>～</span>
                                        <div>
                                            <input type="text" class="form-control{{ $errors->has('unitPriceMax') ? ' is-invalid' : '' }}" value="{{ $project->price_max }}" id="unitPriceMax" name="unitPriceMax" min="0" required data-parsley-type="number">
                                        </div>
                                        <span class="unit">円</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jobType" class="col-sm-4 col-form-label">職種</label>
                                    <div class="col-sm-7">
                                        <select class="form-control{{ $errors->has('jobType') ? ' is-invalid' : '' }}" id="jobType" name="jobType" required>
                                            <option></option>
                                            @foreach($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}"{{ $jobType->id == $project->job_type ? ' selected' : '' }}>{{ $jobType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="industry" class="col-sm-4 col-form-label">業界</label>
                                    <div class="col-sm-7">
                                        <select class="form-control{{ $errors->has('industry') ? ' is-invalid' : '' }}" id="industry" name="industry" required>
                                            <option></option>
                                            @foreach($industries as $industry)
                                                <option value="{{ $industry->id }}"{{ $industry->id == $project->industry ? ' selected' : '' }}>{{ $industry->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jobContent" class="col-sm-4 col-form-label">職務内容</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('jobContent') ? ' is-invalid' : '' }}" id="jobContent" name="jobContent" rows="8" required>{{ $project->content }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requiredSkills" class="col-sm-4 col-form-label">必須スキル</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('requiredSkills') ? ' is-invalid' : '' }}" id="requiredSkills" name="requiredSkills" rows="8" required>{{ $project->required_skills }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="applicableSkills" class="col-sm-4 col-form-label">尚可スキル</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('applicableSkills') ? ' is-invalid' : '' }}" id="applicableSkills" name="applicableSkills" rows="8" required>{{ $project->applicable_skills }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requiredPerson" class="col-sm-4 col-form-label">求める人物像</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('requiredPerson') ? ' is-invalid' : '' }}" id="requiredPerson" name="requiredPerson" rows="8" required>{{ $project->required_person }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teamStructure" class="col-sm-4 col-form-label">チーム体制</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('teamStructure') ? ' is-invalid' : '' }}" id="teamStructure" name="teamStructure" rows="8" required>{{ $project->team_structure }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gainedSkills" class="col-sm-4 col-form-label">得られるスキル</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('gainedSkills') ? ' is-invalid' : '' }}" id="gainedSkills" name="gainedSkills" rows="8" required>{{ $project->gained_skills }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="workLocation" class="col-sm-4 col-form-label">勤務地</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control{{ $errors->has('workLocation') ? ' is-invalid' : '' }}" value="{{ $project->work_location }}" id="workLocation" name="workLocation" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="interviews" class="col-sm-4 col-form-label">面談回数</label>
                                    <div class="col-sm-7">
                                        <div class="d-flex">
                                            <div>
                                                <select class="form-control{{ $errors->has('interviews') ? ' is-invalid' : '' }}" id="interviews" name="interviews" required>
                                                    <option></option>
                                                    @foreach(range(1,3) as $interview)
                                                        <option value="{{ $interview }}"{{ $interview == $project->interviews ? ' selected' : '' }}>{{ $interview }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="interviews-unit">回</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="openStartDate" class="col-sm-4 col-form-label">作業開始日</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control{{ $errors->has('startDate') ? ' is-invalid' : '' }}" value="{{ $project->start_date }}" id="openStartDate" name="startDate" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="startTime" class="col-sm-4 col-form-label">始業/終業時間</label>
                                    <div class="col-sm-7 ">
                                        <div class="start-end-time">
                                            <div>
                                                <input type="text" class="time-mask form-control{{ $errors->has('startTime') ? ' is-invalid' : '' }}" value="{{ $project->start_time }}" id="startTime" name="startTime" required>
                                            </div>
                                            <span>～</span>
                                            <div>
                                                <input type="text" class="time-mask form-control{{ $errors->has('endTime') ? ' is-invalid' : '' }}" value="{{ $project->end_time }}" id="endTime" name="endTime" required>
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
                                                <input type="number" class="form-control{{ $errors->has('averageUptimeStart') ? ' is-invalid' : '' }}" value="{{ $project->uptime_min }}" id="averageUptimeStart" name="averageUptimeStart">
                                            </div>
                                            <span>～</span>
                                            <div>
                                                <input type="number" class="form-control{{ $errors->has('averageUptimeEnd') ? ' is-invalid' : '' }}" value="{{ $project->uptime_max }}" id="averageUptimeEnd" name="averageUptimeEnd">
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
                                                    <input class="form-check-input" type="radio" name="week" {{ $week->id == $project->week ? 'checked' : '' }} value="{{ $week->id }}">
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
                                                    <input class="form-check-input" type="radio" name="contractType" {{ $contractType->id == $project->contract_type ? 'checked' : '' }} value="{{ $contractType->id }}">
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
                                                <input class="form-check-input" type="radio" {{ 1 == $project->online_interview ? 'checked' : '' }} name="onlineInterview" value="1">
                                                <label class="form-check-label">可</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" {{ 0 == $project->online_interview ? 'checked' : '' }} name="onlineInterview" value="0">
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
                                                <input class="form-check-input" type="radio" {{ 1 == $project->remote_work ? 'checked' : '' }} name="remoteWork" value="1">
                                                <label class="form-check-label">可</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" {{ 0 == $project->remote_work ? 'checked' : '' }} name="remoteWork" value="0">
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
                                        <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" name="comment" rows="8" required>{{ $project->comment }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="icon" class="col-sm-4 col-form-label">アイコン</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="icon" {{ 1 == $project->avatar ? 'checked' : '' }}  name="icon" value="1" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fullName" class="col-sm-4 col-form-label">氏名</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="fullName" {{ 1 == $project->client ? 'checked' : '' }} name="fullName" value="1" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios">
                                    </div>
                                </div>
                                <div class="case-entry-btn text-center">
                                    <button type="submit" class="btn btn-theme btn-medium btn-next">確認画面へ</button>
                                </div>
                            </form>
                        </div>
                        <div class="step-content{{ session('step') && session('step') === 2 ? ' active': '' }}" data-step="2">
                            <div class="input-title-preview">
                                <h2 class="text-center" data-for="caseName">{{ $project->name }}</h2>
                                <div class="d-flex justify-content-center job-type-industry">
                                    <button class="btn job-type">{{ $project->jobType->name }}</button>
                                    <button class="btn job-industry">{{ $project->industries->name }}</button>
                                </div>
                                <h3 class="text-center" data-for="unitePrice">{{ $project->price_min }}　～　{{ $project->price_max }} / 月</h3>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>契約形態</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="contractType">{{ $project->contractType->name }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>週</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="week">{{ $project->weeks->name }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>職務内容</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="jobContent">{{ $project->content }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>必須スキル</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="requiredSkills">{{ $project->required_skills }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>尚可スキル</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="applicableSkills">{{ $project->applicable_skills }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>求める人物像</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="requiredPerson">{{ $project->required_person }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>チーム体制</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="teamStructure">{{ $project->team_structure }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>得られるスキル</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="gainedSkills">{{ $project->gained_skills }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>勤務地</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="workLocation">{{ $project->work_location }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>面談回数</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="interviews">{{ $project->interviews }} 回</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>作業開始日</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="openStartDate">{{ $project->start_date }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>始業/終業時間</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="startEndTime">{{ $project->start_time }}時  ～  {{ $project->end_time }}時</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>平均稼働時間</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="averageUptimeStartEnd">{{ $project->uptime_min }}h  ～  {{ $project->uptime_max }}h</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>オンライン面談</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="onlineInterview">{{ $project->online_interview == 1 ? '可' : '不可' }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>リモートワーク</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="remoteWork">{{ $project->remote_work == 1 ? '可' : '不可' }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>コメント</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="comment">{{ $project->comment }}</div>
                            </div>
                            <div class="image-upload-preview d-flex flex-column align-items-center">
                                <img src="{{ $agent->avatar ? upload_asset($agent->avatar) : static_asset('assets/img/account.png') }}" class="avatar-preview" alt="">
                                <span>{{ $agent->name }}</span>
                            </div>
                            <div class="input-preview-btn-group text-center">
                                <button class="btn btn-dark btn-medium btn-prev">修正する</button>
                                <button class="btn btn-theme btn-medium btn-next">確認画面へ</button>
                            </div>
                        </div>
                        <div class="step-content{{ session('step') && session('step') === 3 ? ' active': '' }}" data-step="3">
                            <div class="completion-icon icon-medium">
                                掲載しました
                            </div>
                            <div class="input-preview-btn-group">
                                <a href="{{ route('agent.project.create') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">他の案件も掲載する</a>
                                <a href="{{ route('agent.dashboard') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">ダッシュボードへ</a>
                                <a href="{{ route('projects.list') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">求人・案件一覧へ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

        const jobTypes = {
            @foreach($jobTypes as $jobType)
            "{{ $jobType->id }}": "{{ $jobType->name }}",
            @endforeach
        };
        const industries = {
            @foreach($industries as $industry)
            "{{ $industry->id }}": "{{ $industry->name }}",
            @endforeach
        };
        const weeks = {
            @foreach($weeks as $week)
            "{{ $week->id }}": "{{ $week->name }}",
            @endforeach
        };
        const contractTypes = {
            @foreach($contractTypes as $contractType)
            "{{ $contractType->id }}": "{{ $contractType->name }}",
            @endforeach
        };
        const onlineInterviews = {
            '0': "不可",
            '1': "可"
        }
        const remoteWorks = {
            '0': "不可",
            '1': "可"
        }

        const elContentCaseEntry = $('.content-case-entry');
        const elProgressBar = $('.progress-bar');
        const stepDot1 = $('.step-item[data-step="1"]');
        const stepDot2 = $('.step-item[data-step="2"]');
        const stepDot3 = $('.step-item[data-step="3"]');

        const stepContent1 = $('.step-content[data-step="1"]');
        const stepContent2 = $('.step-content[data-step="2"]');
        const stepContent3 = $('.step-content[data-step="3"]');

        function setStep(step) {
            elProgressBar.css('width', ((step - 1) * 50) + '%');
            elProgressBar.attr('aria-valuenow', ((step - 1) * 50) + '%');
            elContentCaseEntry.removeClass('step1');
            elContentCaseEntry.removeClass('step2');
            elContentCaseEntry.removeClass('step3');
            elContentCaseEntry.addClass('step' + step);
            $('.step-content').removeClass('active');

            switch (step) {
                case 1:
                    stepDot2.removeClass('active');
                    stepDot3.removeClass('active');
                    stepContent1.addClass('active');
                    break;
                case 2:
                    stepDot2.addClass('active');
                    stepDot3.removeClass('active');
                    stepContent2.addClass('active');
                    break;
                case 3:
                    stepDot3.addClass('active');
                    stepContent3.addClass('active');
                    break;
            }
        }
        $(document).ready(function () {
            var form = $('#form');
            var parsleyInstance = form.parsley();
            $('#openStartDate').daterangepicker({
                singleDatePicker: true
            }, function(start, end, label) {
            });
            const timeFormat = 'HH';
            let elTimeMasks = document.getElementsByClassName('time-mask');
            let timeMasks = [];
            for(let i = 0; i < elTimeMasks.length; i++) {
                let timeMask = IMask(elTimeMasks[i], {
                    mask: Date,
                    lazy: false,
                    pattern: timeFormat,
                    format: function (date) {
                        return moment(date).format(timeFormat);
                    },
                    parse: function (str) {
                        return moment(str, timeFormat);
                    },
                    blocks: {
                        HH: {
                            mask: IMask.MaskedRange,
                            from: 0,
                            to: 23
                        },
                    }
                });
                timeMasks.push({
                    timeMask: timeMask,
                    elTimeMask: elTimeMasks[i]
                });
            }
            let elUnitPriceMin = document.getElementById('unitPriceMin');
            let elUnitPriceMax = document.getElementById('unitPriceMax');
            IMask(elUnitPriceMin, {
                mask: Number,
                min: 0,
                max: 99999999999
            });
            IMask(elUnitPriceMax, {
                mask: Number,
                min: 0,
                max: 99999999999
            });
            function validateOthers() {
                let isValid = true;
                for (let i = 0; i < timeMasks.length; i++) {
                    if (timeMasks[i].timeMask.unmaskedValue === '') {
                        $(timeMasks[i].elTimeMask).parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
                        isValid = false;
                    }
                }
                if($('#averageUptimeStart').val() === '' || $('#averageUptimeEnd').val() === '') {
                    $('#averageUptimeStart').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
                    isValid = false;
                }
                if(!$('input[name=week]:checked').val()){
                    $('input[name=week]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
                    isValid = false;
                }
                if(!$('input[name=onlineInterview]:checked').val()){
                    $('input[name=onlineInterview]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
                    isValid = false;
                }
                if(!$('input[name=remoteWork]:checked').val()){
                    $('input[name=remoteWork]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
                    isValid = false;
                }
                if(!$('input[name=contractType]:checked').val()){
                    $('input[name=contractType]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
                    isValid = false;
                }
                // if($('input[name="contractType"]:checked').serialize() === ''){
                //     $('input[name=contractType]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
                //     isValid = false;
                // }
                return isValid;
            }

            stepContent1.find('.btn-next').click(function (e) {
                e.preventDefault();
                const validOthers = validateOthers();
                if (parsleyInstance.validate() && validOthers) {
                    $('[data-for="unitePrice"]').text($('#unitPriceMin').val() + '　～　' + $('#unitPriceMax').val() + ' / 月');
                    $('[data-for="startEndTime"]').text($('#startTime').val() + '時  ～  ' + $('#endTime').val() + '時');
                    $('[data-for="averageUptimeStartEnd"]').text($('#averageUptimeStart').val() + 'h  ～  ' + $('#averageUptimeEnd').val() + 'h');
                    $('[data-for="openStartDate"]').text($('#openStartDate').val());
                    $('[data-for="week"]').text(weeks[$('input[name=week]:checked').val()]);
                    $('[data-for="onlineInterview"]').text(onlineInterviews[$('input[name=onlineInterview]:checked').val()]);
                    $('[data-for="remoteWork"]').text(remoteWorks[$('input[name=remoteWork]:checked').val()]);
                    $('[data-for="contractType"]').text(contractTypes[$('input[name=contractType]:checked').val()]);
                    $('[data-for="interviews"]').text($('#interviews').val() + ' 回');
                    $('button.job-type').text(jobTypes[$('#jobType').val()]);
                    $('button.job-industry').text(industries[$('#industry').val()]);
                    setStep(2);
                }
            });
            stepContent2.find('.btn-next').click(function (e) {
                e.preventDefault();
                form.submit();
                // setStep(3);
            });
            stepContent2.find('.btn-prev').click(function (e) {
                e.preventDefault();
                setStep(1);
            });
            // $('.step-wizard').on('click', '.step-item.active', function (e) {
            //     console.log($(this).data('step'));
            //     setStep($(this).data('step'));
            // });
            form.on('input', 'input.form-control, select.form-control, textarea.form-control', function (e) {
                $(this).parents('.form-group').find('.invalid-feedback strong').text('');
                const domID = $(this).attr('id');
                const inputVal = $(this).val();
                $('[data-for="' + domID +'"]').text(inputVal);
            });
            $('input[name=week]').change(function () {
                $(this).parents('.form-group').find('.invalid-feedback strong').text('');
                $('.preview-value[data-for="week"]').text(weeks[$(this).val()]);
            });
            $('input[name=onlineInterview]').change(function () {
                $(this).parents('.form-group').find('.invalid-feedback strong').text('');
                $('.preview-value[data-for="onlineInterview"]').text(onlineInterviews[$(this).val()]);
            });
            $('input[name=remoteWork]').change(function () {
                $(this).parents('.form-group').find('.invalid-feedback strong').text('');
                $('.preview-value[data-for="remoteWork"]').text(remoteWorks[$(this).val()]);
            });
            $('input[name=contractType]').change(function () {
                $(this).parents('.form-group').find('.invalid-feedback strong').text('');
                $('.preview-value[data-for="contractType"]').text(contractTypes[$(this).val()]);
            });
        });
    </script>
@endsection
