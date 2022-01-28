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
function formatDate(str) {
    let date = new Date(str);
    return date.getFullYear() + '年' + (date.getMonth() + 1) + '月';
}
function preview() {
    let id = 0;
    display = $('#nav-work');
    display.empty();
    element = $('div.col-form-input-item', 'div.work-experience');
    for (let list of element) {
        title = $('input[name="experienceTitle[]"]', list).val();
        content = $('textarea[name="experienceComment[]"]', list).val();
        startDate = formatDate($('input[name="experienceStartDate[]"]', list).val());
        endDate = formatDate($('input[name="experienceEndDate[]"]', list).val());
        display.append(`
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#collapse${id}">
                    <i class="fas fa-caret-down"></i>${title}
                </div>
                <div id="collapse${id}" class="collapse show">
                    <div class="item-date">${startDate} ~ ${endDate}</div>
                    <div class="item-body">${content}</div>
                </div>
            </div>
        `);
        id++;
    }

    display = $('#nav-education');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-education');
    for (let list of element) {
        title = $('input[name="schoolName[]"]', list).val();
        content = $('input[name="departmentSubjectName[]"]', list).val();
        startDate = formatDate($('input[name="educationStartDate[]"]', list).val());
        endDate = formatDate($('input[name="educationEndDate[]"]', list).val());
        display.append(`
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#collapse${id}">
                    <i class="fas fa-caret-down"></i>${title}
                </div>
                <div id="collapse${id}" class="collapse show">
                    <div class="item-date">${startDate} ~ ${endDate}</div>
                    <div class="item-body">${content}</div>
                </div>
            </div>
        `);
        id++;
    }

    display = $('#nav-qualification');
    display.empty();
    element = $('div.col-form-input-item', 'div.qualifications');
    for (let list of element) {
        title = $('input[name="qualificationName[]"]', list).val();
        startDate = formatDate($('input[name="qualificationDate[]"]', list).val());
        display.append(`
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#collapse${id}">
                    <i class="fas fa-caret-down"></i>${title}
                </div>
                <div id="collapse${id}" class="collapse show">
                    <div class="item-date">${startDate}</div>
                </div>
            </div>
        `);
        id++;
    }

    display = $('#nav-award');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-award');
    for (let list of element) {
        title = $('input[name="employmentName[]"]', list).val();
        startDate = formatDate($('input[name="employmentDate[]"]', list).val());
        display.append(`
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#collapse${id}">
                    <i class="fas fa-caret-down"></i>${title}
                </div>
                <div id="collapse${id}" class="collapse show">
                    <div class="item-date">${startDate}</div>
                </div>
            </div>
        `);
        id++;
    }

    display = $('#nav-writing');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-writing');
    for (let list of element) {
        title = $('input[name="writingName[]"]', list).val();
        startDate = formatDate($('input[name="writingDate[]"]', list).val());
        display.append(`
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#collapse${id}">
                    <i class="fas fa-caret-down"></i>${title}
                </div>
                <div id="collapse${id}" class="collapse show">
                    <div class="item-date">${startDate}</div>
                </div>
            </div>
        `);
        id++;
    }

    display = $('.portfolio-preview');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-portfolio');
    for (let list of element) {
        title = $('input[name="portfolioName[]"]', list).val();
        startDate = formatDate($('input[name="portfolioDate[]"]', list).val()) + '制作';
        content = $('input[name="portfolioLink[]"]', list).val();
        display.append(`
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#portfolio${id}">
                    <i class="fas fa-caret-down"></i>${title}
                </div>
                <div id="experience-pro" class="collapse show">
                    <div class="item-body">
                        <a href="#">${content}</a>
                    </div>
                    <div class="item-date">${startDate}</div>
                </div>
            </div>
        `);
        id++;
    }

    display = $('#experience-os');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-skill-os');
    for (let list of element) {
        title = $('input[name="skill_os[]"]', list).val();
        startDate = $('input[name="skill_os_year[]"]', list).val();
        display.append(`
            <div class="row">
                <div class="col-md-6">${title}</div>
                <div class="col-md-6">${startDate}</div>
            </div>
        `);
    }

    display = $('#experience-pro');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-skill-pro');
    for (let list of element) {
        title = $('input[name="skill_pro[]"]', list).val();
        startDate = $('input[name="skill_pro_year[]"]', list).val();
        display.append(`
            <div class="row">
                <div class="col-md-6">${title}</div>
                <div class="col-md-6">${startDate}</div>
            </div>
        `);
    }

    display = $('#experience-db');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-skill-db');
    for (let list of element) {
        title = $('input[name="skill_db[]"]', list).val();
        startDate = $('input[name="skill_db_year[]"]', list).val();
        display.append(`
            <div class="row">
                <div class="col-md-6">${title}</div>
                <div class="col-md-6">${startDate}</div>
            </div>
        `);
    }

    display = $('#experience-infra');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-skill-infra');
    for (let list of element) {
        title = $('input[name="skill_infra[]"]', list).val();
        startDate = $('input[name="skill_infra_year[]"]', list).val();
        display.append(`
            <div class="row">
                <div class="col-md-6">${title}</div>
                <div class="col-md-6">${startDate}</div>
            </div>
        `);
    }

    display = $('#experience-frame');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-skill-frame');
    for (let list of element) {
        title = $('input[name="skill_frame[]"]', list).val();
        startDate = $('input[name="skill_frame_year[]"]', list).val();
        display.append(`
            <div class="row">
                <div class="col-md-6">${title}</div>
                <div class="col-md-6">${startDate}</div>
            </div>
        `);
    }

    display = $('#experience-tool');
    display.empty();
    element = $('div.col-form-input-item', 'div.col-skill-tool');
    for (let list of element) {
        title = $('input[name="skill_tool[]"]', list).val();
        startDate = $('input[name="skill_tool_year[]"]', list).val();
        display.append(`
            <div class="row">
                <div class="col-md-6">${title}</div>
                <div class="col-md-6">${startDate}</div>
            </div>
        `);
    }

    $('#profile-job').text($('option:selected', $('select[name="professionalOccupation[]"]:first')).text());
    $('#profile-week').text('週' + $('input[name="availableDaysWeek"]:checked').val() + '日');
    $('#profile-contract').text($('input.contractType:checked:first').siblings('label').text());
    $('.item-body', $('#salary')).text($('input[name="salary"]').val() + '円~');
    $('.item-body', $('#location')).text($('input[name="work_location"]').val());
    $('.item-body', $('#remote')).text($('input[name="remote"]:checked').siblings('label').text());
    $('.item-body', $('#join-date')).text($('input[name="join_date"]').val());
    $('.item-body', $('#dress')).text($('input[name="dress"]:checked').siblings('label').text());
    $('.item-body', $('#other')).text($('textarea[name="other"]').val());
}
function checkAvatarFile(dom) {
    const fileInput = dom;
    if (fileInput.files.length < 1) return false;
    const file = fileInput.files[0];
    const fileType = file["type"];
    return $.inArray(fileType, validImageTypes) !== -1;
}
function validateOthers() {
    let isValid = true;
    if(!$('input.contractType:checked').length){
        $('input[name="contractType[1]"]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
        $('input[name="contractType[1]"]').focus();
        isValid = false;
    }
    return isValid;
}
$(document).ready(function () {
    var form = $('#form');
    stepContent1.find('.btn-next').click(function (e) {
        e.preventDefault();
        if (validateOthers() && form.parsley().validate()) {
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
        $(this).closest('.col-form-input-item').clone(true).appendTo($(this).closest('.col-form-input')).find('input, textarea').val('');
    });
    $('div.form-input-remove').click(function (e) {
        item = $(this).closest('.col-form-input-item').remove();
    });
    $('input.contractType').change(function () {
        if(!$('input.contractType:checked').length){
            $('input[name="contractType[1]"]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
        }
        else $('input[name="contractType[1]"]').parents('.form-group').find('.invalid-feedback strong').text('');
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