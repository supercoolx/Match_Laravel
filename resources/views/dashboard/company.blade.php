@extends('layout.app')

@section('content')
    @if (count($projects) > 0)
        <section class="content-section">
            <div class="container">
                <div class="row section-header">
                    <div class="col-md-12 text-center">
                        <h1>管理している求人・案件一覧</h1>
                        <div class="section-header-divider"></div>
                        <p>該当案件数{{ count($projects) }}件中 {{ count($projects) }}件を表示</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach($projects as $project)
                        <div class="col-md-12 project-item">
                            <img src="{{ $project->image ? upload_asset($project->image) : static_asset('assets/img/project-thumb.jpg') }}" alt="" class="project-thumb object-cover-center">
                            <div class="job-type-industry">
                                <span class="btn job-type">{{ $project->jobType->name }}</span>
                                <span class="btn job-industry">{{ $project->industries->name }}</span>
                                <span class="job-day">週 {{ $project->weeks->name }}</span>
                            </div>
                            <h2>{{ $project->name }}</h2>
                            <h3>{{ $project->price_min }} ~ {{ $project->price_max }} / 月</h3>
                            <div class="divider"></div>
                            <p>{{ $project->content }}</p>
                            <div class="publisher">
                                <img src="{{ $project->user->avatar ? upload_asset($project->user->avatar) : static_asset('assets/img/avatar/default.png') }}" class="object-cover-center" alt="">
                                <span>{{ $project->user->name }}</span>
                            </div>
                            <div class="d-flex justify-content-center content-actions">
                                <a href="{{ route('company.project.detail', ['id' => $project->id]) }}" class="btn btn-theme btn-small btn-blue-light d-flex align-items-center justify-content-center">詳細</a>
                                <a href="{{ route('company.project.edit', ['id' => $project->id]) }}" class="btn btn-theme btn-small btn-blue d-flex align-items-center justify-content-center">編集</a>
                                <button class="btn btn-theme btn-small btn-dark" onclick="openDeleteProjectModal({{ $project->id }}, '{{ $project->name }}')">削除</button>
                                <input type="checkbox" @if($project->status) {{ 'checked' }} @endif value="{{ $project->id }}" class="status" data-toggle="toggle" data-on="募集中" data-off="募集中" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    {{ $projects->links() }}
                </div>
            </div>
        </section>
    @else
        <section class="content-section">
            <div class="container">
                <div class="content-no-posted for-corporate-dashboard">
                    <p>現在、管理している求人・案件はございません</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('company.project.create') }}" class="btn btn-theme btn-medium d-flex align-items-center justify-content-center">案件を掲載する</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection


@section('modals')
    <!-- Delete Project Modal -->
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-project-title">人材紹介サイトのプラットフォーム制作</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>こちらの案件を削除してもよろしいですか？</p>
                    <form method="POST" role="form" action="{{ route('company.project.delete') }}" enctype="multipart/form-data" id="deleteProjectForm">
                        @csrf
                        <input type="hidden" name="id" id="delete-project-id">
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-theme btn-small btn-dark" onclick="deleteProject()">はい</button>
                    <button type="button" class="btn btn-theme btn-small btn-blue" onclick="closeDeleteProjectModal()">いいえ</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openDeleteProjectModal(id, title) {
            $('#delete-project-title').text(title);
            $('#delete-project-id').val(id);
            $('#deleteProjectModal').modal('show');
        }
        function closeDeleteProjectModal() {
            $('#delete-project-title').text('');
            $('#delete-project-id').val('');
            $('#deleteProjectModal').modal('hide');
        }
        function deleteProject() {
            $('#deleteProjectForm').submit();
            closeDeleteProjectModal();
        }
        $(document).ready(function () {
            $('div.toggle').click(function () {
                $.ajax({
                    url: '{{ route("company.project.status") }}',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    type: 'post',
                    data: {
                        id: $('input.status', this).val(),
                        status: $(this).hasClass('off')
                    }
                });
            });
        });
    </script>
@endsection

