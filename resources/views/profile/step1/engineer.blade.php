<form method="POST" role="form" action="{{ route('engineer.profile.update') }}" enctype="multipart/form-data" id="form">
    @csrf
    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
    <div class="form-group">
        <label class="col-form-label">専門職種</label>
        <div class="col-form-input professional-occupation">
            @if(isset($profile->jobs))
                @foreach ($profile->jobs as $job)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <select class="form-control" name="professionalOccupation[]">
                            @foreach ($jobTypes as $jobType)
                                <option value="{{ $jobType->id }}" @if($jobType->id === $job->id) {{'selected'}} @endif>{{ $jobType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            @else
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <select class="form-control" name="professionalOccupation[]">
                        @foreach ($jobTypes as $jobType)
                            <option value="{{ $jobType->id }}" @if($jobType->id === $job->id) {{'selected'}} @endif>{{ $jobType->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">希望稼働日数(週)</label>
        <div class="col-form-input available-days-week">
            @foreach($weeks as $week)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="availableDaysWeek" id="availableDaysWeek{{ $week->id }}" value="{{ $week->id }}" @if($week->id === $profile->week) {{ 'checked' }} @endif>
                    <label class="form-check-label" for="availableDaysWeek{{ $week->id }}">{{ $week->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">希望契約形態</label>
        <div class="col-form-input desired-contract-form">
            @foreach($contractTypes as $contractType)
                <div class="form-check">
                    <input class="form-check-input contractType" type="checkbox" name="contractType[{{ $contractType->id }}]" id="contractType{{ $contractType->id }}" {{ (isset($profile) ? in_array($contractType->id, array_column($profile->contractTypes->toArray(), 'id')) : old("contractType[$contractType->id]")) ? 'checked' : '' }}>
                    <label class="form-check-label" for="contractType{{ $contractType->id }}">{{ $contractType->name }}</label>
                </div>
            @endforeach
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">業務経験</label>
        <div class="col-form-input work-experience">
            @if(isset($profile->experiences))
                @foreach($profile->experiences as $exp)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="experienceTitle[]" placeholder="タイトル" value="{{ $exp->title }}" required>
                        <div class="work-experience-duration date-range-selector">
                            <div>
                                <input type="month" class="form-control w194" name="experienceStartDate[]" value="{{ $exp->start_date }}" required>
                            </div>
                            <span>～</span>
                            <div>
                                <input type="month" class="form-control w194" name="experienceEndDate[]" value="{{ $exp->end_date }}" required>
                            </div>
                        </div>
                        <div class="experience-comment">
                            <textarea class="form-control" name="experienceComment[]" placeholder="タイトル" required>{{ $exp->content }}</textarea>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="experienceTitle[]" placeholder="タイトル" required>
                    <div class="work-experience-duration date-range-selector">
                        <div>
                            <input type="month" class="form-control w194" name="experienceStartDate[]" required>
                        </div>
                        <span>～</span>
                        <div>
                            <input type="month" class="form-control w194" name="experienceEndDate[]" required>
                        </div>
                    </div>
                    <div class="experience-comment">
                        <textarea class="form-control" name="experienceComment[]" placeholder="タイトル" required></textarea>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">スキル(エンジニア)</label>
        @php
            $skill_os = []; $skill_pro = []; $skill_frame = []; $skill_db = []; $skill_infra = []; $skill_tool = []; $skill_other = [];
            if(isset($profile->skills)) {
                foreach($profile->skills as $exp) {
                    switch ($exp->type) {
                        case 'os':
                            $skill_os[] = $exp;
                            break;
                        case 'pro':
                            $skill_pro[] = $exp;
                            break;
                        case 'frame':
                            $skill_frame[] = $exp;
                            break;
                        case 'db':
                            $skill_db[] = $exp;
                            break;
                        case 'infra':
                            $skill_infra[] = $exp;
                            break;
                        case 'tool':
                            $skill_tool[] = $exp;
                            break;
                        default:
                            $skill_other[$exp->type][] = $exp;
                            break;
                    }
                }
            }
        @endphp
        @if($skill_os) 
            <div class="col-form-input col-skill-os">
                @foreach($skill_os as $exp)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="skill_os[]" placeholder="OSを入力" value="{{ $exp->name }}" required>
                        <div class="mt13 w194">
                            <input type="text" class="form-control" name="skill_os_year[]" placeholder="経験年数を入力" value="{{ $exp->year }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-form-input col-skill-os">
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="skill_os[]" placeholder="OSを入力" value="" required>
                    <div class="mt13 w194">
                        <input type="text" class="form-control" name="skill_os_year[]" placeholder="経験年数を入力" value="" required>
                    </div>
                </div>
            </div>
        @endif
        @if($skill_pro) 
            <div class="col-form-input col-skill-pro">
                @foreach($skill_pro as $exp)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="skill_pro[]" placeholder="プログラミング言語を入力" value="{{ $exp->name }}" required>
                        <div class="mt13 w194">
                            <input type="text" class="form-control" name="skill_pro_year[]" placeholder="経験年数を入力" value="{{ $exp->year }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-form-input col-skill-pro">
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="skill_pro[]" placeholder="プログラミング言語を入力" value="" required>
                    <div class="mt13 w194">
                        <input type="text" class="form-control" name="skill_pro_year[]" placeholder="経験年数を入力" value="" required>
                    </div>
                </div>
            </div>
        @endif
        @if($skill_frame) 
            <div class="col-form-input col-skill-frame">
                @foreach($skill_frame as $exp)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="skill_frame[]" placeholder="フレームワークを入力" value="{{ $exp->name }}" required>
                        <div class="mt13 w194">
                            <input type="text" class="form-control" name="skill_frame_year[]" placeholder="経験年数を入力" value="{{ $exp->year }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-form-input col-skill-frame">
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="skill_frame[]" placeholder="フレームワークを入力" value="" required>
                    <div class="mt13 w194">
                        <input type="text" class="form-control" name="skill_frame_year[]" placeholder="経験年数を入力" value="" required>
                    </div>
                </div>
            </div>
        @endif
        @if($skill_db)
            <div class="col-form-input col-skill-db">
                @foreach($skill_db as $exp)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="skill_db[]" placeholder="データベースを入力" value="{{ $exp->name }}" required>
                        <div class="mt13 w194">
                            <input type="text" class="form-control" name="skill_db_year[]" placeholder="経験年数を入力" value="{{ $exp->year }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-form-input col-skill-db">
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="skill_db[]" placeholder="データベースを入力" value="" required>
                    <div class="mt13 w194">
                        <input type="text" class="form-control" name="skill_db_year[]" placeholder="経験年数を入力" value="" required>
                    </div>
                </div>
            </div>
        @endif
        @if($skill_infra)
            <div class="col-form-input col-skill-infra">
                @foreach($skill_infra as $exp)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="skill_infra[]" placeholder="インフラを入力" value="{{ $exp->name }}" required>
                        <div class="mt13 w194">
                            <input type="text" class="form-control" name="skill_infra_year[]" placeholder="経験年数を入力" value="{{ $exp->year }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-form-input col-skill-infra">
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="skill_infra[]" placeholder="インフラを入力" value="" required>
                    <div class="mt13 w194">
                        <input type="text" class="form-control" name="skill_infra_year[]" placeholder="経験年数を入力" value="" required>
                    </div>
                </div>
            </div>
        @endif
        @if($skill_tool)
            <div class="col-form-input col-skill-tool">
                @foreach($skill_tool as $exp)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="skill_tool[]" placeholder="その他ツールを入力" value="{{ $exp->name }}" required>
                        <div class="mt13 w194">
                            <input type="text" class="form-control" name="skill_tool_year[]" placeholder="経験年数を入力" value="{{ $exp->year }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-form-input col-skill-tool">
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="skill_tool[]" placeholder="その他ツールを入力" value="" required>
                    <div class="mt13 w194">
                        <input type="text" class="form-control" name="skill_tool_year[]" placeholder="経験年数を入力" value="" required>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label class="col-form-label">スキル(エンジニア以外)</label>
        @if($skill_other)
            <div class="col-form-input col-skill-other">
                @foreach($skill_other as $type => $skill)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control col-skill-other" placeholder="カテゴリを入力" value="{{ $type }}" required>
                        @foreach($skill as $exp)
                            <div class="col-form-input-item col-skill-other-item">
                                <div class="form-input-add-remove">
                                    <div class="form-input-add"></div>
                                    <div class="form-input-remove"></div>
                                </div>
                                <input type="text" class="form-control skill-other" name="skill_other[]" placeholder="スキルを入力" value="{{ $exp->name }}" required>
                                <div class="mt13 w194">
                                    <input type="text" class="form-control skill-other-year" name="skill_other_year[]" placeholder="経験年数を入力" value="{{ $exp->year }}" required>
                                </div>
                                <input type="hidden" class="skill-other-category" name="skill_other_category[]" value="{{ $exp->type }}">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-form-input col-skill-other">
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control col-skill-other" placeholder="カテゴリを入力" value="" required>
                    <div class="col-form-input-item col-skill-other-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control skill-other" name="skill_other[]" placeholder="スキルを入力" value="" required>
                        <div class="mt13 w194">
                            <input type="text" class="form-control skill-other-year" name="skill_other_year[]" placeholder="経験年数を入力" value="" required>
                        </div>
                        <input type="hidden" class="skill-other-category" name="skill_other_category[]" value="">
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label class="col-form-label">学歴</label>
        <div class="col-form-input col-education">
            @if(isset($profile->educations))
                @foreach($profile->educations as $edu)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="schoolName[]" placeholder="学校名" value="{{ $edu->school_name }}" required>
                        <div class="mt13">
                            <input type="text" class="form-control" name="departmentSubjectName[]" placeholder="学部、学科名" value="{{ $edu->subject_name }}" required>
                        </div>
                        <div class="mt18 date-range-selector">
                            <div>
                                <input type="month" class="form-control w194" name="educationStartDate[]" value="{{ $edu->start_date }}" required>
                            </div>
                            <span>～</span>
                            <div>
                                <input type="month" class="form-control w194" name="educationEndDate[]" value="{{ $edu->end_date }}" required>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="schoolName[]" placeholder="学校名" required>
                    <div class="mt13">
                        <input type="text" class="form-control" name="departmentSubjectName[]" placeholder="学部、学科名" required>
                    </div>
                    <div class="mt18 date-range-selector">
                        <div>
                            <input type="month" class="form-control w194" name="educationStartDate[]" required>
                        </div>
                        <span>～</span>
                        <div>
                            <input type="month" class="form-control w194" name="educationEndDate[]" required>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">資格</label>
        <div class="col-form-input qualifications">
            @if(isset($profile->qualifications))
                @foreach($profile->qualifications as $qua)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <div class="qualification-name">
                            <input type="text" class="form-control" name="qualificationName[]" placeholder="資格名" value="{{ $qua->name }}" required>
                        </div>
                        <div class="qualification-date">
                            <input type="month" class="form-control w194" name="qualificationDate[]" value="{{ $qua->date }}" required>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <div class="qualification-name">
                        <input type="text" class="form-control" name="qualificationName[]" placeholder="資格名" required>
                    </div>
                    <div class="qualification-date">
                        <input type="month" class="form-control w194" name="qualificationDate[]" required>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">受賞歴</label>
        <div class="col-form-input col-award">
            @if(isset($profile->employees))
                @foreach($profile->employees as $employee)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="employmentName[]" placeholder="タイトル" value="{{ $employee->employee_name }}" required>
                        <div class="mt18">
                            <input type="month" class="form-control w194" name="employmentDate[]" value="{{ $employee->employee_date }}" required>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="employmentName[]" placeholder="タイトル" required>
                    <div class="mt18">
                        <input type="month" class="form-control w194" name="employmentDate[]" required>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">執筆歴</label>
        <div class="col-form-input col-writing">
            @if(isset($profile->writings))
                @foreach($profile->writings as $writing)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="writingName[]" placeholder="タイトル" value="{{ $writing->name }}" required>
                        <div class="mt18">
                            <input type="month" class="form-control w194" name="writingDate[]" value="{{ $writing->date }}" required>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="writingName[]" placeholder="タイトル" required>
                    <div class="mt18">
                        <input type="month" class="form-control w194" name="writingDate[]" required>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">ポートフォリオ</label>
        <div class="col-form-input col-portfolio">
            @if(isset($profile->portfolios))
                @foreach($profile->portfolios as $port)
                    <div class="col-form-input-item">
                        <div class="form-input-add-remove">
                            <div class="form-input-add"></div>
                            <div class="form-input-remove"></div>
                        </div>
                        <input type="text" class="form-control" name="portfolioName[]" placeholder="タイトル" value="{{ $port->name }}" required>
                        <div class="mt13">
                            <input type="text" class="form-control" name="portfolioLink[]" placeholder="タイトル" value="{{ $port->link }}" required>
                        </div>
                        <div class="mt18">
                            <input type="month" class="form-control w194" name="portfolioDate[]" value="{{ $port->date }}" required>
                        </div>
                        <input type="hidden" name="portfolioImageUrl[]" value="{{ $port->image }}">
                        <div class="mt18 row image-picker">
                            @if($port->image)
                                <img src="{{ upload_asset($port->image) }}" alt="" class="image-upload">
                            @else
                                <img src="{{ static_asset('assets/img/icon-image.png') }}" alt="">
                            @endif
                            <input type="file" name="image[]" class="image" accept="image/*">
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="portfolioName[]" placeholder="タイトル" required>
                    <div class="mt13">
                        <input type="text" class="form-control" name="portfolioLink[]" placeholder="タイトル" required>
                    </div>
                    <div class="mt18">
                        <input type="month" class="form-control w194" name="portfolioDate[]" required>
                    </div>
                    <input type="hidden" name="portfolioImageUrl[]" value="">
                    <div class="mt18 row image-picker">
                        <img src="{{ static_asset('assets/img/icon-image.png') }}" alt="">
                        <input type="file" name="image[]" class="image" accept="image/*">
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">給与</label>
        <div class="col-form-input col-salary">
            <div class="col-form-input-item d-flex">
                <div>
                    <input type="number" class="form-control w194" name="salary" value="{{ isset($profile) ? $profile->salary : '' }}" required>
                </div>
                <span>円~</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">勤務地</label>
        <div class="col-form-input col-location">
            <div class="col-form-input-item">
                <div class="mt18">
                    <input type="text" class="form-control w194" name="work_location" value="{{ isset($profile) ? $profile->location : '' }}" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">リモートワーク</label>
        <div class="col-form-input remote-work">
            @foreach($remote_works as $remote)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="remote" id="remote{{ $remote->id }}" value="{{ $remote->id }}" @if($remote->id === $profile->remote_work_id) {{ 'checked' }} @endif>
                    <label class="form-check-label" for="remote{{ $remote->id }}">{{ $remote->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">希望入社開始日</label>
        <div class="col-form-input col-join-date">
            <div class="col-form-input-item">
                <div class="mt18">
                    <input type="date" class="form-control w194" name="join_date" value="{{ isset($profile) ? $profile->join_date : '' }}" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">服装</label>
        <div class="col-form-input col-dress">
            @foreach($dresses as $dress)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="dress" id="dress{{ $dress->id }}" value="{{ $dress->id }}" @if($dress->id === $profile->dress_id) {{ 'checked' }} @endif>
                    <label class="form-check-label" for="dress{{ $dress->id }}">{{ $dress->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">その他</label>
        <div class="col-form-input col-other">
            <div class="col-form-input-item">
                <textarea name="other" class="form-control">{{ isset($profile) ? $profile->other : '' }}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">氏名</label>
        <div class="col-form-input">
            <input type="checkbox" name="fullName" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios" @if($profile) {{ $profile->full_name ? 'checked' : '' }} @endif>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">電話番号</label>
        <div class="col-form-input">
            <input type="checkbox" name="phone" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios" @if($profile) {{ $profile->phone ? 'checked' : '' }} @endif>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">求職中</label>
        <div class="col-form-input">
            <input type="checkbox" name="openJob" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios" @if($profile) {{ $profile->open_job ? 'checked' : '' }} @endif>
        </div>
    </div>
    <div class="applicant-profile-input-btn text-center">
        <button type="submit" class="btn btn-black-sm btn-next">確認</button>
    </div>
</form>