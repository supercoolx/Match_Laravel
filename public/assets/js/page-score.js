$('.section-tab-item').click(function () {
    $('.section-tab-item').removeClass('active');
    $('.page-content').hide();
    el = $(this);
    el.addClass('active');
    $(el.attr('data-target')).show();
});

var days = [];
var today = new Date();

var data_projects = [], data_projects_view = [], data_projects_end = [], data_follow_cnt = [], data_followed_cnt = [], data_invites = [];

for(i = 0; i < 10; i++) {
    days.unshift(today.getMonth() + 1 + '/' + today.getDate());
    data_projects.unshift((review.history.projects.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data_projects_view.unshift((review.history.projects_view.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data_projects_end.unshift((review.history.projects_end.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data_follow_cnt.unshift((review.history.follow_cnt.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data_followed_cnt.unshift((review.history.followed_cnt.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    data_invites.unshift((review.history.invites.find(el => el.date == (today.toISOString().slice(0, 10))) ?? {count: 0} ).count);
    today.setDate(today.getDate() - 1);
}

var projects_chart = new ApexCharts(document.querySelector("#projects-chart"), {
    series: [{
        name: "公開案件数",
        data: data_projects
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
    title: {
        text: ['公開案件数', '', 'スコア' + review.score.projects, 'ランキング' + review.rank.projects + '位'],
        align: 'center'
    },
    xaxis: {
        categories: days,
    },
    markers: {
        size: [5]
    }
});

var projects_view_chart = new ApexCharts(document.querySelector("#projects-view-chart"), {
    series: [{
        name: "公開案件閲覧数",
        data: data_projects_view
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
    title: {
        text: ['公開案件閲覧数', '', 'スコア' + review.score.projects_view, 'ランキング' + review.rank.projects_view + '位'],
        align: 'center'
    },
    xaxis: {
        categories: days,
    },
    markers: {
        size: [5]
    }
});

var projects_end_chart = new ApexCharts(document.querySelector("#projects-end-chart"), {
    series: [{
        name: "契約成立数",
        data: data_projects_end
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
    title: {
        text: ['契約成立数', '', 'スコア' + review.score.projects_end, 'ランキング' + review.rank.projects_end + '位'],
        align: 'center'
    },
    xaxis: {
        categories: days,
    },
    markers: {
        size: [5]
    }
});

var follow_chart = new ApexCharts(document.querySelector("#follow-chart"), {
    series: [{
        name: "フォロー数",
        data: data_follow_cnt
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
    title: {
        text: ['フォロー数', '', 'スコア' + review.score.follow_cnt, 'ランキング' + review.rank.follow_cnt + '位'],
        align: 'center'
    },
    xaxis: {
        categories: days,
    },
    markers: {
        size: [5]
    }
});

var followed_chart = new ApexCharts(document.querySelector("#followed-chart"), {
    series: [{
        name: "フォロワー数",
        data: data_followed_cnt
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
    title: {
        text: ['フォロワー数', '', 'スコア' + review.score.followed_cnt, 'ランキング' + review.rank.followed_cnt + '位'],
        align: 'center'
    },
    xaxis: {
        categories: days,
    },
    markers: {
        size: [5]
    }
});

var invite_chart = new ApexCharts(document.querySelector("#invite-chart"), {
    series: [{
        name: "友達招待数",
        data: data_invites
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
    title: {
        text: ['友達招待数', '', 'スコア' + review.score.invites, 'ランキング' + review.rank.invites + '位'],
        align: 'center'
    },
    xaxis: {
        categories: days,
    },
    markers: {
        size: [5]
    }
});

projects_chart.render();
projects_view_chart.render();
projects_end_chart.render();
follow_chart.render();
followed_chart.render();
invite_chart.render();