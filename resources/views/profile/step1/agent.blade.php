<form method="POST" role="form" action="{{ route('engineer.profile.update') }}" enctype="multipart/form-data" id="form">
    @csrf
    <input type="hidden" name="id" value="{{ $agent->id }}">
    <div class="form-group">
        <label class="col-form-label">業務経験</label>
        <div class="col-form-input work-experience">
            @foreach($experiences as $exp)
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="experienceTitle[]" placeholder="タイトル" value="{{ $exp->title }}" required>
                    <div class="work-experience-duration date-range-selector">
                        <input type="date" class="form-control w194" name="experienceStartDate[]" value="{{ $exp->start_date }}" required>
                        <span>～</span>
                        <input type="date" class="form-control w194" name="experienceEndDate[]" value="{{ $exp->end_date }}" required>
                    </div>
                    <div class="experience-comment">
                        <textarea class="form-control" name="experienceComment[]" placeholder="タイトル" required>{{ $exp->content }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">学歴</label>
        <div class="col-form-input">
            @foreach($educations as $edu)
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
                            <input type="date" class="form-control w194" name="educationStartDate[]" value="{{ $edu->start_date }}" required>
                        </div>
                        <span>～</span>
                        <div>
                            <input type="date" class="form-control w194" name="educationEndDate[]" value="{{ $edu->end_date }}" required>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">資格</label>
        <div class="col-form-input qualifications">
            @foreach($qualifications as $qua)
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <div class="qualification-name">
                        <input type="text" class="form-control" name="qualificationName[]" placeholder="資格名" value="{{ $qua->name }}" required>
                    </div>
                    <div class="qualification-date">
                        <input type="date" class="form-control w194" name="qualificationDate[]" value="{{ $qua->date }}" required>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">受賞歴</label>
        <div class="col-form-input">
            @foreach($employees as $employee)
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="employmentName[]" placeholder="タイトル" value="{{ $employee->employee_name }}" required>
                    <div class="mt18">
                        <input type="date" class="form-control w194" name="employmentDate[]" value="{{ $employee->employee_date }}" required>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">執筆歴</label>
        <div class="col-form-input">
            @foreach($writings as $writing)
                <div class="col-form-input-item">
                    <div class="form-input-add-remove">
                        <div class="form-input-add"></div>
                        <div class="form-input-remove"></div>
                    </div>
                    <input type="text" class="form-control" name="writingName[]" placeholder="タイトル" value="{{ $writing->name }}" required>
                    <div class="mt18">
                        <input type="date" class="form-control w194" name="writingDate[]" value="{{ $writing->date }}" required>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">アイコン</label>
        <div class="col-form-input">
            <input type="checkbox" id="icon" name="icon" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios" @if($profile->icon) {{ 'checked' }} @endif>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">氏名</label>
        <div class="col-form-input">
            <input type="checkbox" name="fullName" data-toggle="toggle" data-on="公開" data-off="非公開" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios" @if($profile->full_name) {{ 'checked' }} @endif>
        </div>
    </div>
    <div class="applicant-profile-input-btn text-center">
        <button type="submit" class="btn btn-black-sm btn-next">確認</button>
    </div>
</form>