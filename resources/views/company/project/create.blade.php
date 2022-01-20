@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="content-case-entry for-company step{{ session('step') }}">
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
                            <form method="POST" role="form" action="{{ route('company.project.post') }}" enctype="multipart/form-data" id="form">
                                @csrf
                                <input type="hidden" name="imagePath" id="imagePath" value="{{ old('imagePath') }}">
                                <input type="file" name="image" id="image" class="d-none">
                                <div class="form-group row">
                                    <label for="caseName" class="col-sm-4 col-form-label">募集タイトル</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control{{ $errors->has('caseName') ? ' is-invalid' : '' }}" value="{{ old('caseName') }}" id="caseName" name="caseName" placeholder="募集タイトルを入力" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jobType" class="col-sm-4 col-form-label">職種</label>
                                    <div class="col-sm-7">
                                        <select class="form-control{{ $errors->has('jobType') ? ' is-invalid' : '' }}" id="jobType" name="jobType" required>
                                            <option disabled selected>職種を選択</option>
                                            @foreach($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}"{{ $jobType->id === old('jobType') ? ' selected' : '' }}>{{ $jobType->name }}</option>
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
                                                <option value="{{ $industry->id }}"{{ $industry->id === old('industry') ? ' selected' : '' }}>{{ $industry->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">契約形態</label>
                                    <div class="col-sm-7">
                                        <div>
                                            @foreach($contractTypes as $contractType)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="contractType" {{ $contractType->id === old('contractType') ? 'checked' : '' }} value="{{ $contractType->id }}">
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
                                    <label class="col-sm-4 col-form-label">週</label>
                                    <div class="col-sm-7">
                                        <div>
                                            @foreach($weeks as $week)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="week" {{ $week->id === old('week') ? 'checked' : '' }} value="{{ $week->id }}">
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
                                    <label for="unitPriceMin" class="col-sm-4 col-form-label">単価</label>
                                    <div class="col-sm-6 unite-price-range">
                                        <div>
                                            <input type="text" class="form-control{{ $errors->has('unitPriceMin') ? ' is-invalid' : '' }}" value="{{ old('unitPriceMin') }}" id="unitPriceMin" name="unitPriceMin" min="0" placeholder="単価を入力" required data-parsley-type="number">
                                        </div>
                                        <span>～</span>
                                        <div>
                                            <input type="text" class="form-control{{ $errors->has('unitPriceMax') ? ' is-invalid' : '' }}" value="{{ old('unitPriceMax') }}" id="unitPriceMax" name="unitPriceMax" min="0" placeholder="単価を入力" required data-parsley-type="number">
                                        </div>
                                        <span class="unit">円</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jobContent" class="col-sm-4 col-form-label">職務内容</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('jobContent') ? ' is-invalid' : '' }}" id="jobContent" name="jobContent" rows="8" placeholder="職務内容を入力" required>{{ old('jobContent') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requiredSkills" class="col-sm-4 col-form-label">必須スキル</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('requiredSkills') ? ' is-invalid' : '' }}" id="requiredSkills" name="requiredSkills" rows="8" placeholder="必須スキルを入力" required>{{ old('requiredSkills') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="applicableSkills" class="col-sm-4 col-form-label">尚可スキル</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('applicableSkills') ? ' is-invalid' : '' }}" id="applicableSkills" name="applicableSkills" rows="8" placeholder="尚可スキルを入力" required>{{ old('applicableSkills') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requiredPerson" class="col-sm-4 col-form-label">求める人物像</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('requiredPerson') ? ' is-invalid' : '' }}" id="requiredPerson" name="requiredPerson" rows="8" placeholder="求める人物像を入力" required>{{ old('requiredPerson') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teamStructure" class="col-sm-4 col-form-label">チーム体制</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('teamStructure') ? ' is-invalid' : '' }}" id="teamStructure" name="teamStructure" rows="8" placeholder="チーム体制を入力" required>{{ old('teamStructure') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gainedSkills" class="col-sm-4 col-form-label">得られるスキル</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('gainedSkills') ? ' is-invalid' : '' }}" id="gainedSkills" name="gainedSkills" rows="8" placeholder="得られるスキルを入力" required>{{ old('gainedSkills') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="workLocation" class="col-sm-4 col-form-label">勤務地</label>
                                    <div class="col-sm-7">
                                        <select class="form-control{{ $errors->has('workLocation') ? ' is-invalid' : '' }}" id="workLocation" name="workLocation" required>
                                            <option disabled selected>勤務地を選択</option>
                                            @foreach($addresses as $address)
                                                <option value="{{ $address->id }}">{{ $address->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="interviews" class="col-sm-4 col-form-label">面談回数</label>
                                    <div class="col-sm-7">
                                        <div class="d-flex">
                                            <select class="form-control{{ $errors->has('interviews') ? ' is-invalid' : '' }}" id="interviews" name="interviews" required>
                                                <option disabled selected>面談回数</option>
                                                @foreach(range(1,3) as $interview)
                                                    <option value="{{ $interview }}"{{ $interview === old('interviews') ? ' selected' : '' }}>{{ $interview }}回</option>
                                                @endforeach
                                            </select>
                                            <span class="interviews-unit">回</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="openStartDate" class="col-sm-4 col-form-label">作業開始日</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control{{ $errors->has('startDate') ? ' is-invalid' : '' }}" value="{{ old('startDate') }}" id="openStartDate" name="startDate" placeholder="作業開始日を入力" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="startTime" class="col-sm-4 col-form-label">始業/終業時間</label>
                                    <div class="col-sm-7 ">
                                        <div class="start-end-time">
                                            <div>
                                                <input type="text" class="time-mask form-control{{ $errors->has('startTime') ? ' is-invalid' : '' }}" value="{{ old('startTime') }}" id="startTime" name="startTime" placeholder="始業時間を入力" required>
                                            </div>
                                            <span>～</span>
                                            <div>
                                                <input type="text" class="time-mask form-control{{ $errors->has('endTime') ? ' is-invalid' : '' }}" value="{{ old('endTime') }}" id="endTime" name="endTime" placeholder="終業時間を入力" required>
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
                                                <input type="number" class="form-control{{ $errors->has('averageUptimeStart') ? ' is-invalid' : '' }}" value="{{ old('averageUptimeStart') }}" id="averageUptimeStart" name="averageUptimeStart" placeholder="下限時間を入力" required>
                                            </div>
                                            <span>～</span>
                                            <div>
                                                <input type="number" class="form-control{{ $errors->has('averageUptimeEnd') ? ' is-invalid' : '' }}" value="{{ old('averageUptimeEnd') }}" id="averageUptimeEnd" name="averageUptimeEnd" placeholder="上限時間を入力" required>
                                            </div>
                                        </div>
                                        <span class="invalid-feedback" role="alert">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">オンライン商談</label>
                                    <div class="col-sm-7">
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" {{ 1 === old('onlineInterview') ? 'checked' : '' }} name="onlineInterview" value="1">
                                                <label class="form-check-label">可</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" {{ 0 === old('onlineInterview') ? 'checked' : '' }} name="onlineInterview" value="0">
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
                                                <input class="form-check-input" type="radio" {{ 1 === old('remoteWork') ? 'checked' : '' }} name="remoteWork" value="1">
                                                <label class="form-check-label">可</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" {{ 0 === old('remoteWork') ? 'checked' : '' }} name="remoteWork" value="0">
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
                                        <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" name="comment" rows="8" placeholder="コメントを入力" required>{{ old('comment') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">画像のアップロード</label>
                                    <div class="col-sm-8">
                                        <img src="{{ static_asset('assets/img/icon-image.png') }}" alt="" class="image-upload object-cover-center">
                                    </div>
                                </div>
                                <div class="case-entry-btn text-center">
                                    <button type="submit" class="btn btn-theme btn-medium btn-next">確認画面へ</button>
                                </div>
                            </form>
                        </div>
                        <div class="step-content{{ session('step') && session('step') === 2 ? ' active': '' }}" data-step="2">
                            <div class="input-title-preview">
                                <h2 class="text-center" data-for="caseName">{{ old('caseName') }}</h2>
                                <div class="d-flex justify-content-center job-type-industry">
                                    <button class="btn job-type">職種</button>
                                    <button class="btn job-industry">業界</button>
                                </div>
                            </div>
                            <div class="image-upload-preview d-flex align-items-center">
                                <img src="{{ $company->avatar ? upload_asset($company->avatar) : static_asset('assets/img/account.png') }}" class="object-cover-center" alt="{{ $company->name }}">
                                <span>{{ $company->name }}</span>
                            </div>
                            <div class="img-thumbnail-preview">
                                <img src="{{ old('imagePath') ? upload_asset(old('imagePath')) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="">
                            </div>
                            <div class="website-url-preview">
                                <a href="{{ $company->website }}">{{ $company->website }}</a>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>契約形態</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="contractType"></div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>週</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="week">{{ old('week') }}日</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>職務内容</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="jobContent">{{ old('jobContent') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>必須スキル</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="requiredSkills">{{ old('requiredSkills') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>尚可スキル</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="applicableSkills">{{ old('applicableSkills') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>求める人物像</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="requiredPerson">{{ old('requiredPerson') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>チーム体制</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="teamStructure">{{ old('teamStructure') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>得られるスキル</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="gainedSkills">{{ old('gainedSkills') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>勤務地</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="workLocation">{{ old('workLocation') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>面談回数</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="interviews">1 回</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>作業開始日</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="openStartDate">{{ old('startDate') }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>始業/終業時間</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="startEndTime">{{ old('startTime') }}時  ～  {{ old('endTime') }}時</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>平均稼働時間</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="averageUptimeStartEnd">{{ old('averageUptimeStart') }}h  ～  {{ old('averageUptimeEnd') }}h</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>オンライン面談</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="onlineInterview">{{ old('onlineInterview') == 1 ? '可' : '不可' }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>リモートワーク</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="remoteWork">{{ old('remoteWork') == 1 ? '可' : '不可' }}</div>
                            </div>
                            <div class="input-preview row">
                                <div class="col-sm-5 preview-label">
                                    <label>コメント</label>
                                </div>
                                <div class="col-sm-7 preview-value" data-for="comment">{{ old('comment') }}</div>
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
                                <a href="{{ route('company.project.create') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">他の案件も掲載する</a>
                                <a href="{{ route('company.dashboard') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">ダッシュボードへ</a>
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
        const addresses = {
            @foreach($addresses as $address)
            "{{ $address->id }}": "{{ $address->name }}",
            @endforeach
        }
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

        const inputImage = $('input#image');
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

        function checkImageFile(domId) {
            const fileInput = document.getElementById(domId);
            if (fileInput.files.length < 1) return false;
            const file = fileInput.files[0];
            const fileType = file["type"];
            return $.inArray(fileType, validImageTypes) !== -1;
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
                    $('[data-for="unitePrice"]').text($('#unitPriceMin').val() + ' ～ ' + $('#unitPriceMax').val() + ' / 月');
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
                    $('[data-for="workLocation"]').text(addresses[$('#workLocation').val()]);
                    setStep(2);
                    // if(checkImageFile(inputImage.attr('id'))) {
                    // } else {
                    //     toastr.error('', '画像を選択してください');
                    // }
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
            stepContent1.find('img.image-upload').click(function (e) {
                $('.img-thumbnail-preview img').attr('src', '{{ static_asset('assets/img/icon-image.png') }}');
                inputImage.click();
            });
            inputImage.on('change', function (e) {
                const file = this.files[0];
                if (checkImageFile(inputImage.attr('id'))) {
                    if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                        return false;
                    }
                    const fileReader = new FileReader();
                    fileReader.onload = function () {
                        $('img.image-upload').attr('src', fileReader.result);
                        $('.img-thumbnail-preview img').attr('src', fileReader.result);
                    };
                    fileReader.readAsDataURL(file);
                } else {
                    inputImage.val('');
                    toastr.error('', '画像を選択してください');
                }
            });
        });
    </script>
@endsection
