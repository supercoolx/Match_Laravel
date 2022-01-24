@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="applicant-profile-input">
                        <div class="step-wizard d-flex justify-content-center">
                            <div class="content-step-wizard d-flex justify-content-between">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $step ? ($step - 1) * 50 : 0 }}%;" aria-valuenow="{{ $step ? ($step - 1) * 50 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="step-item{{ $step > 0 ? ' active': '' }}" data-step="1">入力</div>
                                <div class="step-item{{ $step > 1 ? ' active': '' }}" data-step="2">確認</div>
                                <div class="step-item{{ $step > 2 ? ' active': '' }}" data-step="3">掲載</div>
                            </div>
                        </div>
                        <div class="step-content{{ $step == 1 ? ' active': '' }}" data-step="1">
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
                                                <div class="form-input-add-remove col-4">
                                                    <div class="form-input-add"></div>
                                                    <div class="form-input-remove"></div>
                                                </div>
                                                <input type="text" class="form-control" name="employmentName[]" placeholder="タイトル" value="{{ $employee->employee_name }}" required>
                                                </div>
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
                                                <div class="form-input-add-remove col-4">
                                                    <div class="form-input-add"></div>
                                                    <div class="form-input-remove"></div>
                                                </div>
                                                <input type="text" class="form-control col-8" name="writingName[]" placeholder="タイトル" value="{{ $writing->name }}" required>
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
                                    <button type="submit" class="btn btn-theme btn-medium btn-next">確認画面へ</button>
                                </div>
                            </form>
                        </div>
                        <div class="step-content{{ $step == 2 ? ' active': '' }}" data-step="2">
                            <div class="applicant-profile-preview">
                                <div class="d-flex flex-column align-items-center avatar-picker">
                                    <img src="{{ $agent->avatar ? upload_asset($agent->avatar) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
                                    <span class="registrant-name">{{ $agent->name }}</span>
                                    <span class="registrant-name-kana">{{ $agent->name_kana }}</span>
                                </div>
                                <div class="input-preview">
                                    <div class="preview-label">
                                        <label>専門職種</label>
                                    </div>
                                    <div class="preview-value" id="p-occupation">
                                        @foreach($jobs as $job)
                                            <p>{{ $job->type->name ?? '' }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="input-preview">
                                    <div class="preview-label">
                                        <label>対応可能日数 / 週</label>
                                    </div>
                                    <div class="preview-value" id="p-week">{{ $profile->week }}日</div>
                                </div>
                                <div class="input-preview">
                                    <div class="preview-label">
                                        <label>希望契約形態</label>
                                    </div>
                                    <div class="preview-value" id="p-contact">{{ $profile->contractType->name ?? '' }}</div>
                                </div>
                                <div class="input-preview">
                                    <div class="preview-label">
                                        <label>業務経験</label>
                                    </div>
                                    <div class="preview-value" id="p-experience">
                                        @foreach($experiences as $exp)
                                            <div class="experience-title-preview"><span>{{ $exp->title }}</span></div>
                                            <div class="experience-comment-preview">{{ $exp->content }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="input-preview">
                                    <div class="preview-label">
                                        <label>資格</label>
                                    </div>
                                    <div class="preview-value" id="p-qualification">
                                        @foreach($qualifications as $qua)
                                            <div class="qualifications-preiew">
                                                <p>{{ $qua->name }}</p>
                                                <p>{{ $qua->date }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="input-preview">
                                    <div class="preview-label">
                                        <label>ポートフォリオ</label>
                                    </div>
                                    <div class="preview-value" id="p-portfolio">
                                        @foreach($portfolios as $portfolio)
                                            <div class="portfolio-preview">
                                                <p class="portfolio-title-preview">{{ $portfolio->name }}</p>
                                                <p class="portfolio-link-preview"><a href="{{ $portfolio->link }}">{{ $portfolio->link }}</a></p>
                                                <img src="{{ upload_asset($portfolio->image) }}" alt="" class="portfolio-img-preview">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="applicant-profile-preview-buttons d-flex justify-content-center">
                                    <button class="btn btn-dark btn-large btn-prev">修正する</button>
                                    <button class="btn btn-theme btn-large btn-next">掲載する</button>
                                </div>
                            </div>
                        </div>
                        <div class="step-content{{ $step == 3 ? ' active': '' }}" data-step="3">
                            <div class="completion-icon">
                                登録完了しました
                            </div>
                            <div class="applicant-profile-completion-buttons d-flex justify-content-center">
                                <button class="btn btn-theme btn-large" onclick="javascript: location.href = '{{ route('engineer.dashboard') }}'">ダッシュボードへ</a>
                                <button class="btn btn-theme btn-large" onclick="javascript: location.href = '{{ route('projects.list') }}'">掲載プロフィール一覧へ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ static_asset('assets/lib/custom-focus-input/style.css') }}">
@endsection

@section('script')
    <script type="text/javascript">
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

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
        function preview() {

            display = $('#p-occupation');
            display.empty();
            element = $('select option:selected');
            for (let list of element) {
                display.append('<p>' + $(list).text() + '</p>');
            }
            
            element = $('input[name="availableDaysWeek"]:checked');
            element = $('label[for="' + element.attr('id') + '"]');
            $('#p-week').text(element.text());

            element = $('input[name="desiredContractForm"]:checked');
            element = $('label[for="' + element.attr('id') + '"]');
            $('#p-contact').text(element.text());

            display = $('#p-experience');
            display.empty();
            element = $('div.col-form-input-item', 'div.work-experience');
            for (let list of element) {
                title = $('input[name="experienceTitle[]"]', list).val();
                content = $('textarea[name="experienceComment[]"]', list).val();
                display.append(`
                    <div class="experience-title-preview">
                        <span>${title}</span>
                    </div>
                    <div class="experience-comment-preview">
                        <span>${content}</span>
                    </div>
                `);
            }

            display = $('#p-qualification');
            display.empty();
            element = $('div.col-form-input-item', 'div.qualifications');
            for (let list of element) {
                title = $('input[name="qualificationName[]"]', list).val();
                content = $('input[name="qualificationDate[]"]', list).val();
                display.append(`
                    <div class="qualifications-preiew">
                        <p>${title}</p>
                        <p>${content}</p>
                    </div>
                `);
            }

            display = $('#p-portfolio');
            display.empty();
            element = $('div.col-form-input-item', 'div.portfolio');
            for (let list of element) {
                title = $('input[name="portfolioName[]"]', list).val();
                content = $('input[name="portfolioLink[]"]', list).val();
                img_src = $('img.image-upload', list).attr('src');
                display.append(`
                    <div class="portfolio-preview">
                        <p class="portfolio-title-preview">${title}</p>
                        <p class="portfolio-link-preview">
                            <a href="${content}">${content}</a>
                        </p>
                        <img src="${img_src}" alt="" class="portfolio-img-preview">
                    </div>
                `);
            }
        }
        function checkAvatarFile(dom) {
            const fileInput = dom;
            if (fileInput.files.length < 1) return false;
            const file = fileInput.files[0];
            const fileType = file["type"];
            return $.inArray(fileType, validImageTypes) !== -1;
        }
        $(document).ready(function () {
            var form = $('#form');
            var parsleyInstance = form.parsley();
            stepContent1.find('.btn-next').click(function (e) {
                e.preventDefault();
                if (parsleyInstance.validate()) {
                    preview();
                    setStep(2);
                    // if (checkAvatarFile(inputAvatar.attr('id')) || checkAvatarPath()) {
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
            $('div.form-input-add').click(function (e) {
                item = $(this).closest('.col-form-input-item').clone(true);
                $(this).closest('.col-form-input').append(item);
            });
            $('div.form-input-remove').click(function (e) {
                item = $(this).closest('.col-form-input-item').remove();
            });
            stepContent1.find('.image-picker img').click(function (e) {
                // $(this).attr('src', '{{ static_asset('assets/img/avatar/default.png') }}');
                $('input.image', $(this).parent()).click();
            });
            $('input.image').on('change', function (e) {
                const file = this.files[0];
                parent = $(this).parent();
                if (checkAvatarFile(this)) {
                    if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                        return false;
                    }
                    const fileReader = new FileReader();
                    fileReader.onload = function () {
                        $('img', parent).attr('src', fileReader.result);
                        $('img', parent).addClass('image-upload');
                    };
                    fileReader.readAsDataURL(file);
                } else {
                    $(this).val('');
                    // toastr.error('', '画像を選択してください');
                }
            });
        });
    </script>
    <script src="{{ static_asset('assets/lib/custom-focus-input/script.js') }}"></script>
@endsection