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
    let date = str.split('-');
    return date[0] + '年' + date[1] + '月';
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
}
function validate() {
    var form = $('#form');
    $('input, textarea', $('#form')).css('border', 'unset');
    isValid = true;
    $('input, textarea', $('#form')).each(function (el) {
        if(!$(this).val()) {
            isValid = false;
            $(this).css('border', 'solid 1px red');
            $(this).focus();
            return;
        }
    });
    return form.parsley().validate() && isValid;
}
$(document).ready(function () {
    var form = $('#form');
    stepContent1.find('.btn-next').click(function (e) {
        e.preventDefault();
        if (validate()) {
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
        el = $(this).closest('.col-form-input-item').clone(true);
        el.insertAfter($(this).closest('.col-form-input-item')).find('input:not([type=hidden]), textarea').val('');
        el.find('ul').remove();
    });
    $('div.form-input-remove').click(function (e) {
        if($(this).closest('.col-form-input-item').parent().find('> .col-form-input-item').length > 1)
            item = $(this).closest('.col-form-input-item').remove();
    });
});

anychart.onDocumentReady(function () {
    // our data from bulbapedia
    var data = [
        {x: "公開案件数", value: review.level.projects},
        {x: "公開案件閲覧数", value: review.level.projects_view},
        {x: "契約成立数", value: review.level.projects_end},
        {x: "フォロー数", value: review.level.follow_cnt},
        {x: "フォロワー数", value: review.level.followed_cnt},
        {x: "友達招待数", value: review.level.invites},
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
    tooltip.titleFormat('Lv.{%value}');
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

var days = [];
var today = new Date();

var data = {};
data.projects = []; data.projects_view = []; data.projects_end = []; data.follow_cnt = []; data.followed_cnt = []; data.invites = [];

for(i = 0; i < 10; i++) {
    days.unshift(today.getMonth() + 1 + '/' + today.getDate());
    data.projects.unshift((review.history.projects.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data.projects_view.unshift((review.history.projects_view.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data.projects_end.unshift((review.history.projects_end.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data.follow_cnt.unshift((review.history.follow_cnt.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data.followed_cnt.unshift((review.history.followed_cnt.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data.invites.unshift((review.history.invites.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    today.setDate(today.getDate() - 1);
}

var options = {
    series: [{
        name: "Activity",
        data: data.projects
    }],
    chart: {
        height: 350,
        type: 'line',
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        categories: days,
    },
    markers: {
        size: [5]
    }
};

var chart = new ApexCharts(document.querySelector("#score-chart"), options);
chart.render();

$(document).on('click', '.review-list:not(.active)', function () {
    $('.review-list').removeClass('active');
    let el = $(this);
    el.addClass('active');
    let historys = data[el.attr('data-for')];
    chart.updateSeries([{ data: historys }]);
});