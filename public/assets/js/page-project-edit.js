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
        if(!$('input[name=interviews]:checked').val()){
            $('input[name=interviews]').parents('.form-group').find('.invalid-feedback strong').text('この値は必須です。');
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
            $('[data-for="unitPrice"]').text($('#unitPriceMin').val() + ' ～ ' + $('#unitPriceMax').val() + ' / 月');
            $('[data-for="startEndTime"]').text($('#startTime').val() + '時  ～  ' + $('#endTime').val() + '時');
            $('[data-for="averageUptimeStartEnd"]').text($('#averageUptimeStart').val() + 'h  ～  ' + $('#averageUptimeEnd').val() + 'h');
            $('[data-for="openStartDate"]').text($('#openStartDate').val());
            $('[data-for="week"]').text('週' + weeks[$('input[name=week]:checked').val()]);
            $('[data-for="onlineInterview"]').text(onlineInterviews[$('input[name=onlineInterview]:checked').val()]);
            $('[data-for="remoteWork"]').text(remoteWorks[$('input[name=remoteWork]:checked').val()]);
            $('[data-for="contractType"]').text(contractTypes[$('input[name=contractType]:checked').val()]);
            $('[data-for="unitPrice"]').text('¥ ' + $('input[name=unitPrice]:checked').val() + '/ 月');
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
        $('.img-thumbnail-preview img').attr('src', img_thumbnail_preview);
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