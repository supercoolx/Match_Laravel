$(document).ready(function() {
    $(document).on('click', '.follow', function () {
        button = $(this);
        button.attr('disabled','disabled');
        id = button.attr('data-id');
        $.ajax({
            url: '/user/follow/' + id,
            type: 'post',
            success: function (res) {
                if(res.success) {
                    button.removeClass('btn-circle-o follow');
                    button.addClass('btn-circle unfollow');
                    button.text('フォロー中');
                }
                else {
                    toastr.error(res.message);
                }
            },
            error: function () {
                toastr.error('予期しないエラーが発生しました。');
            }
        });
        button.removeAttr('disabled');
    });
    $(document).on('click', '.unfollow', function () {
        button = $(this);
        button.attr('disabled','disabled');
        id = button.attr('data-id');
        $.ajax({
            url: '/user/unfollow/' + id,
            type: 'post',
            success: function (res) {
                if(res.success) {
                    button.removeClass('btn-circle unfollow');
                    button.addClass('btn-circle-o follow');
                    button.text('フォロー');
                }
                else {
                    toastr.error(res.message);
                }
            },
            error: function () {
                toastr.error('予期しないエラーが発生しました。');
            }
        });
        button.removeAttr('disabled');
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