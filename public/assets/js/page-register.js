const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

const elProgressBar = $('.progress-bar');
const stepDot1 = $('.step-item[data-step="1"]');
const stepDot2 = $('.step-item[data-step="2"]');
const stepDot3 = $('.step-item[data-step="3"]');

const stepContent1 = $('.step-content[data-step="1"]');
const stepContent2 = $('.step-content[data-step="2"]');
const stepContent3 = $('.step-content[data-step="3"]');

const inputAvatar = $('input#avatar');
function setStep(step) {
    elProgressBar.css('width', ((step - 1) * 50) + '%');
    elProgressBar.attr('aria-valuenow', ((step - 1) * 50) + '%');
    $('.step-content').removeClass('active');

    switch (step) {
        case 1:
            stepDot2.removeClass('active');
            stepDot3.removeClass('active');
            stepContent1.addClass('active');
            $('div.side-image').css('background-image', 'url("/public/assets/img/register/step1.png")');
            break;
        case 2:
            stepDot2.addClass('active');
            stepDot3.removeClass('active');
            stepContent2.addClass('active');
            $('div.side-image').css('background-image', 'url("/public/assets/img/register/step2.png")');
            break;
        case 3:
            stepDot3.addClass('active');
            stepContent3.addClass('active');
            $('div.side-image').css('background-image', 'url("/public/assets/img/register/step3.png")');
            break;
    }
}
function checkAvatarFile(domId) {
    const fileInput = document.getElementById(domId);
    if (fileInput.files.length < 1) return false;
    const file = fileInput.files[0];
    const fileType = file["type"];
    return $.inArray(fileType, validImageTypes) !== -1;
}
function checkAvatarPath() {
    const avatarPath = $('#avatarPath').val();
    return avatarPath && avatarPath.length > 0;
}
$(document).ready(function () {
    let step = $('div.step-content.active').attr('data-step');
    $('div.side-image').css('background-image', 'url("/public/assets/img/register/step' + step + '.png")');
    var form = $('#form');
    var elPhone = document.getElementById('phone');
    var maskPhone = IMask(elPhone, {
        mask: '000-0000-0000'
    });
    var parsleyInstance = form.parsley();
    stepContent1.find('.btn-next').click(function (e) {
        e.preventDefault();
        if (parsleyInstance.validate()) {
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
    form.on('input', 'input.form-control', function (e) {
        $(this).parents('.form-group').find('.invalid-feedback').remove();
        const domID = $(this).attr('id');
        const inputVal = $(this).val();
        $('.preview-value[data-for="' + domID +'"]').text(inputVal);
    });
    stepContent1.find('.avatar-picker img').click(function (e) {
        $('.avatar-picker img').attr('src', '/public/assets/img/avatar/default.png');
        inputAvatar.click();
    });
    inputAvatar.on('change', function (e) {
        const file = this.files[0];
        if (checkAvatarFile(inputAvatar.attr('id'))) {
            if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                return false;
            }
            const fileReader = new FileReader();
            fileReader.onload = function () {
                $('.avatar-picker img').attr('src', fileReader.result);
            };
            fileReader.readAsDataURL(file);
        } else {
            inputAvatar.val('');
            toastr.error('', '画像を選択してください');
        }
    });
});