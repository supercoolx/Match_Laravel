@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="member-registrant">
                    @include('admin.inc.member_nav')
                    <div class="member-registrant-table">
                        <div class="member-registrant-count">該当件数{{ $cnt }}件</div>
                        <div class="member-registrant-actions">
                            <div class="registrant-actions-left">
                                <label class="checkcontainer" id="check_all">すべて
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkcontainer">契約締結
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="registrant-actions-right">
                                <div class="registrant-remove">削除</div>
                            </div>
                        </div>
                        <div class="registrant-table-body">
                            <form action="{{ route('admin.members.delete') }} " method="POST" id="user_form">
                                @csrf
                                @foreach($members as $member)
                                    <div class="registrant-table-row">
                                        <label class="checkcontainer">{{ $member->name }}
                                            <input type="checkbox" name="user_id[]" value="{{ $member->id }}">
                                            <span class="checkmark"></span>
                                        </label>
                                        <span class="registrant-time" data-member-id="{{ $member->id }}" data-member-url="{{ route('admin.user', ['usertype' => $tab_for, 'id' => $member->id]) }}">{{ $member->created_at }}</span>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="row d-flex justify-content-center mt-3">
                            {{-- {{ $members->links() }} --}}
                            <div class="downloadCSV" style="cursor: pointer">
                                <i class="fas fa-download">ダウンロード</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#check_all').click(function () {
                $('form .checkcontainer input[type=checkbox]').prop('checked', $('input', this).prop('checked'));
            });

            $('div.registrant-remove').click(function () {
                length = $('form .checkcontainer input:checked').length;
                if (length == 0) alert('ユーザーを選択する必要があります。');
                else if( confirm('こちらの情報を削除してもよろしいですか?') ) {
                    $('#user_form').submit();
                }
            });

            $('span.registrant-time').click(function () {
                url = $(this).attr('data-member-url');
                location.href = url;
            });

            $('.downloadCSV').click(function () {
                location.href = "{{ route('admin.exportCSV') }}";
            });

            $('input[name="search"]').keydown(function (e) {
                if(e.keyCode == 13) {
                    $('#search_form').submit();
                }
            });
        });
    </script>
@endsection
