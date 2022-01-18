@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="member-registrant registrant-detail-deletion">
                        <div class="completion-icon">
                            削除しました
                        </div>
                        <div class="member-input-btn text-center">
                            <button class="btn btn-theme btn-medium btn-dashboard">ダッシュボードへ</button>
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
            $('button.btn-dashboard').click(function () {
                location.href = "{{ route('admin.dashboard') }}";
            });
        });
    </script>
@endsection