@extends('layout.app')

@section('content')
    @if($isWelcome)
        <div id="particles-js">
            <div class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                <h1 class="mb-5">おめでとうございます!</h1>
                <img src="{{ static_asset("assets/img/reward/friend-6.png") }}" alt="reward">
                <h3 class="mt-3">ゴゴレルマスター</h3>
                <button class="btn btn-circle btn-large rounded-pill mt-5">ダッシュボード</button>
            </div>
        </div>
    @endif
    @if (count($projects) > 0)
        <section class="content-section">
            <div class="gray-bar"></div>
            <div class="dashboard" style="background-color: #ffffff">
                <div class="container">
                    <div class="section-header">
                        <div class="text-center">
                            <h1>管理している求人・案件一覧</h1>
                            <div class="section-header-divider black"></div>
                            <p>該当案件数{{ count($projects) }}件中 {{ count($projects) }}件を表示</p>
                        </div>
                    </div>
                    <div class="justify-content-center">
                        @foreach($projects as $project)
                            <div class="project-item">
                                <div class="job-type-industry">
                                    <span class="btn job-type">{{ $project->jobType->name }}</span>
                                    <span class="btn job-industry">{{ $project->industries->name }}</span>
                                    <span class="job-day">週{{ $project->weeks->name }}</span>
                                </div>
                                <h2 class="mt-4">{{ $project->name }}</h2>
                                <h3>{{ number_comma($project->price_min) }} ~ {{ number_comma($project->price_max) }} / 月</h3>
                                <div class="divider"></div>
                                <p>{{ $project->content }}</p>
                                <div class="publisher">
                                    <img src="{{ $project->user->avatar ? upload_asset($project->user->avatar) : static_asset('assets/img/avatar/default.png') }}" class="object-cover-center" alt="">
                                    <span>{{ $project->user->name }}</span>
                                    <a href="{{ route('agent.project.detail', ['id' => $project->id]) }}" class="btn btn-circle btn-blue-light float-right">詳細</a>
                                </div>
                                <div class="d-flex justify-content-center content-actions">
                                    <a href="{{ route('agent.project.edit', ['id' => $project->id]) }}" class="btn btn-circle d-flex justify-content-center align-items-center">編集</a>
                                    <button class="btn btn-circle-black" onclick="openDeleteProjectModal({{ $project->id }}, '{{ $project->name }}')">削除</button>
                                    <input type="checkbox" @if($project->status) {{ 'checked' }} @endif value="{{ $project->id }}" class="status" data-toggle="toggle" data-on="募集中" data-off="募集中" data-width="119" data-height="41" data-onstyle="theme" data-offstyle="theme" data-style="ios">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="row justify-content-center">
                        {{ $projects->links() }}
                    </div> --}}
                </div> 
            </div>
        </section>
    @else
        <section class="content-section" style="background-color: white">
            <div class="gray-bar" style="position: absolute"></div>
            <div class="container">
                <div class="section-header text-center">
                    <h5>募集中の案件一覧</h5>
                    <div class="section-header-divider black"></div>
                    <p>該当件数0件中 0件表示</p>
                    <p class="not-found-text">現在、管理している求人・案件はございません</p>
                </div>
                <div class="content-no-posted for-corporate-dashboard">
                    <a href="{{ route('agent.project.create') }}" class="btn btn-circle-black" style="width: 248px;">求人•案件を公開する</a>
                    <div class="d-flex justify-content-end">
                        <img src="{{ static_asset('assets/img/no_project.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('modals')
    <!-- Delete Project Modal -->
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModal" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 20px">
                <div class="modal-body">
                    <h5 class="my-5 text-center">削除してもよろしいですか?</h5>
                    <form method="POST" role="form" action="{{ route('agent.project.delete') }}" enctype="multipart/form-data" id="deleteProjectForm">
                        @csrf
                        <input type="hidden" name="id" id="delete-project-id">
                    </form>
                    <button class="btn btn-outline-danger w-100 text-center" onclick="deleteProject()">登録する</a>
                    <button class="btn btn-outline-dark w-100 mt-3 text-center" onclick="closeDeleteProjectModal()">キャンセル</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusProjectModal" tabindex="-1" role="dialog" aria-labelledby="statusProjectModal" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 20px">
                <div class="modal-body">
                    <h5 class="mt-5 text-center">募集終了でよろしいですか?</h5>
                    <p class="text-center">※こちらの案件は公開されなくなります</p>
                    <button class="btn btn-outline-primary w-100 text-center project-close" data-dismiss="modal">契約成立</a>
                    <button class="btn btn-outline-dark w-100 mt-3 text-center project-open" data-dismiss="modal">契約不成立</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/particles.min.js') }}"></script>
    <script>
        var projectId;
        var toggleEl;
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
        function changeStatusProject(id) {
            $.ajax({
                url: '{{ route("agent.project.status") }}',
                type: 'post',
                data: {
                    id: $('input.status', this).val(),
                    status: $(this).hasClass('off')
                }
            });
        }
        $(document).ready(function () {
            $('div.toggle').click(function () {
                $('#statusProjectModal').modal('show');
                toggleEl = $('input.status', this);
                projectId = toggleEl.val();
            });
            $('.project-open').click(function () {
                $.ajax({
                    url: '{{ route("agent.project.status") }}',
                    type: 'post',
                    data: {
                        id: projectId,
                        status: 1
                    },
                    success: function() {
                        toggleEl.prop('checked', true).change();
                    }
                });
            });
            $('.project-close').click(function () {
                $.ajax({
                    url: '{{ route("agent.project.status") }}',
                    type: 'post',
                    data: {
                        id: projectId,
                        status: 0
                    },
                    success: function () {
                        toggleEl.prop('checked', false).change();
                    }
                });
            });

            $('#particles-js button').click(function () {
                $('#particles-js').remove();
            });
        });

        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 125,
                    "density": {
                        "enable": false,
                        "value_area": 400
                    }
                },
                "color": {
                    "value": ["#EA5532", "#F6AD3C", "#FFF33F", "#00A95F", "#00ADA9", "#00AFEC","#4D4398", "#E85298"]
                },
                "shape": {
                    "type": "polygon",
                    "stroke": {
                        "width": 0,
                    },
                    "polygon": {
                        "nb_sides": 5
                    }
                },
                "opacity": {
                    "value": 1,
                    "random": false,
                    "anim": {
                        "enable": true,
                        "speed": 20,
                        "opacity_min": 0,
                        "sync": false
                    }
                },
                "size": {
                    "value": 5.305992965476349,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1.345709068776642,
                        "size_min": 0.8,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": false,
                },
                "move": {
                    "enable": true,
                    "speed": 10,
                    "direction": "bottom",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": false,
                    },
                    "onclick": {
                        "enable": false,
                    },
                    "resize": true
                },
            },
            "retina_detect": true
        });
    </script>
@endsection

