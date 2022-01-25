@extends('layout.app')

@section('content')
    <section class="content-section">
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
            {{-- <div class="step-content{{ $step == 1 ? ' active': '' }}" data-step="1">
                @include('profile.step1.agent')
            </div> --}}
            <div class="step-content active" data-step="2">
                @include('profile.step2.agent')
            </div>
            {{-- <div class="step-content{{ $step == 3 ? ' active': '' }}" data-step="3">
                <div class="completion-icon">
                    登録完了しました
                </div>
                <div class="applicant-profile-completion-buttons d-flex justify-content-center">
                    <button class="btn btn-theme btn-large" onclick="javascript: location.href = '{{ route('engineer.dashboard') }}'">ダッシュボードへ</a>
                    <button class="btn btn-theme btn-large" onclick="javascript: location.href = '{{ route('projects.list') }}'">掲載プロフィール一覧へ</a>
                </div>
            </div> --}}
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
                $(this).closest('.col-form-input-item').clone(true).appendTo($(this).closest('.col-form-input')).find('input').val('');
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
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-radar.min.js"></script>
    <script>
        anychart.onDocumentReady(function () {
            // our data from bulbapedia
            var data = [
                {x: "公開案件数", value: 3},
                {x: "公開案件閲覧数", value: 5},
                {x: "契約成立数", value: 4},
                {x: "フォロー数", value: 6},
                {x: "フォロワー数", value: 5},
                {x: "友達招待数", value: 6},
            ];
        
            var chart = anychart.radar();
            
            chart.height('250px');
            chart.yScale().minimum(0);
            chart.yScale().maximum(6);
            chart.yScale().ticks().interval(1);
            chart.background().fill('#f7f6f3');
            chart.yGrid().palette(["white"]);
            chart.area(data).markers(true);

            var tooltip = chart.tooltip();
            tooltip.titleFormat('{%x}: {%value}');
            tooltip.format('');
            tooltip.separator(false);
        
            // create first series
            chart.line(data);
        
            // set container id for the chart
            chart.container('user-chart');
            // initiate chart drawing
            chart.draw();
            $('.anychart-credits').remove();
        });
    </script>
    <script>
        // '公開案件数', '公開案件閲覧数', '契約成立数','フォロー数','フォロワー数','友達招待数'
    </script>
@endsection