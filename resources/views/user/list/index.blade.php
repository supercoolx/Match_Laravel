@extends('layout.app')

@section('content')
<section class="content-section has-sidebar">
    <div class="list-container">
        @if($search['for'] == config("constants.tab_for.agent"))
            @include('inc.search_bar.profile')
        @else
            @include('inc.search_bar.project')
        @endif
        <div class="content-list content-profile-list">
            @include('inc.list_header')
            <div class="justify-content-center">
                @if($search['for'] == config("constants.tab_for.engineer"))
                    @foreach ($users as $user)
                        @include('user.list.item.engineer')
                    @endforeach
                @elseif($search['for'] == config("constants.tab_for.agent"))
                    @foreach ($users as $user)
                        @include('user.list.item.agent')
                    @endforeach
                @elseif($search['for'] == config("constants.tab_for.company"))
                    @foreach ($users as $user)
                        @include('user.list.item.company')
                    @endforeach
                @endif
            </div>
            <div class="justify-content-center">
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('modals')

@endsection

@section('script')
    <script>
        function setListTypeTab(url) {
            window.location.href = url;
        }
        function setUserTypeTab(userType) {
            window.location.href = '{{ route('users.list') }}?for=' + userType;
        }
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
    </script>
@endsection