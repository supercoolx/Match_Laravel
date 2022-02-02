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