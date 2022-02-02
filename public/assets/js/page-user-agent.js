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

var options = {
    series: [{
        name: "Activity",
        data: [5, 8, 2, 9, 6, 5, 8, 3, 2, 6]
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
        categories: ['10/10', '10/11', '10/12', '10/13', '10/14', '10/15', '10/16', '10/17', '10/18', '10/19'],
    },
    yaxis: {
        min: 0,
        max: 10,
    },
    markers: {
        size: [5]
    }
};

var chart = new ApexCharts(document.querySelector("#score-chart"), options);
chart.render();