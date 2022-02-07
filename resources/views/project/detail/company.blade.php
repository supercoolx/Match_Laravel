@extends('layout.app')

@section('content')
    <section class="content-section" style="background-color: white">
        <div class="edit-content">
            <div class="gray-bar"></div>
            <div class="user-contact" style="display: block; margin-top: 210px;">
                <div class="image-upload-preview d-flex flex-column align-items-center">
                    <img src="{{ $project->user->avatar ? upload_asset($project->user->avatar) : static_asset('assets/img/account.png') }}" class="object-cover-center" alt="{{ $project->user->name }}">
                    <span>{{ $project->user->name }}</span>
                    <a href="{{ getChatLink($project) }}" class="btn btn-theme btn-chat d-flex justify-content-center align-items-center">チャットで話を聞</a>
                    <a href="tel:{{ $project->user->phone }}" class="btn btn-theme btn-call d-flex justify-content-center align-items-center">電話で話を聞</a>
                    @if($isFavour)
                        <a href="javascript: void(0)" class="btn btn-theme btn-fixed d-flex justify-content-center align-items-center">気になるリストから削除</a>
                    @else
                        <a href="javascript: void(0)" class="btn btn-theme btn-fix d-flex justify-content-center align-items-center">気になるリストに追加</a>
                    @endif
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="content-case-entry item-detail for-company">
                            <div class="img-thumbnail-preview">
                                @if(isset($project))
                                    <img src="{{ $project->image ? upload_asset($project->image) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="">
                                @else
                                    <img src="{{ old('imagePath') ? upload_asset(old('imagePath')) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="">
                                @endif
                            </div>
                            <div class="input-title-preview">
                                <div class="job-type-industry">
                                    <span class="btn job-type">{{ isset($project) ? $project->jobType->name : '職種' }}</span>
                                    <span class="btn job-industry">{{ isset($project) ? $project->industries->name : '業界' }}</span>
                                    <span class="preview-value" data-for="week">週{{ isset($project) ? $project->weeks->name : old('week') }}</span>
                                </div>
                                <h2 data-for="caseName" class="pt-2">{{ isset($project) ? $project->name : old('caseName') }}</h2>
                            </div>
                            <div class="input-preview mt-1">
                                <div class="preview-label">
                                    <label>
                                        <div data-for="unitPrice">¥ {{ isset($project) ? number_comma($project->price_min) : number_comma(old('unitPriceMin')) }} ~ {{ isset($project) ? number_comma($project->price_max) : number_comma(old('unitPriceMax')) }}/ 月</div>
                                    </label>
                                </div>
                                <div class="preview-value" data-for="contractType">
                                    @foreach ($project->contractTypes as $item)
                                        <p>{{ $item->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>職務内容</label>
                                </div>
                                <div class="preview-value" data-for="jobContent">{{ isset($project) ? $project->content : old('jobContent') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>必須スキル</label>
                                </div>
                                <div class="preview-value" data-for="requiredSkills">{{ isset($project) ? $project->required_skills : old('requiredSkills') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>尚可スキル</label>
                                </div>
                                <div class="preview-value" data-for="applicableSkills">{{ isset($project) ? $project->applicable_skills : old('applicableSkills') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>求める人物像</label>
                                </div>
                                <div class="preview-value" data-for="requiredPerson">{{ isset($project) ? $project->required_person : old('requiredPerson') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>チーム体制</label>
                                </div>
                                <div class="preview-value" data-for="teamStructure">{{ isset($project) ? $project->team_structure : old('teamStructure') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>得られるスキル</label>
                                </div>
                                <div class="preview-value" data-for="gainedSkills">{{ isset($project) ? $project->gained_skills : old('gainedSkills') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>勤務地</label>
                                </div>
                                <div class="preview-value" data-for="workLocation">{{ isset($project) ? $project->address->name : old('workLocation') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>面談回数</label>
                                </div>
                                <div class="preview-value" data-for="interviews">{{ isset($project) ? $project->interviews : '1' }} 回</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>作業開始日</label>
                                </div>
                                <div class="preview-value" data-for="openStartDate">{{ isset($project) ? $project->start_date : old('startDate') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>始業/終業時間</label>
                                </div>
                                <div class="preview-value" data-for="startEndTime">{{ isset($project) ? $project->start_time : old('startTime') }}  ～  {{ isset($project) ? $project->end_time : old('endTime') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>平均稼働時間</label>
                                </div>
                                <div class="preview-value" data-for="averageUptimeStartEnd">{{ isset($project) ? $project->uptime_min : old('averageUptimeStart') }}  ～  {{ isset($project) ? $project->uptime_max : old('averageUptimeEnd') }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>オンライン面談</label>
                                </div>
                                <div class="preview-value" data-for="onlineInterview">{{ (isset($project) ? $project->online_interview : old('onlineInterview')) == 1 ? '可' : '不可' }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>リモートワーク</label>
                                </div>
                                <div class="preview-value" data-for="remoteWork">{{ (isset($project) ? $project->remote_work : old('remoteWork')) == 1 ? '可' : '不可' }}</div>
                            </div>
                            <div class="input-preview">
                                <div class="preview-label">
                                    <label>コメント</label>
                                </div>
                                <div class="preview-value" data-for="comment">{{ isset($project) ? $project->comment : old('comment') }}</div>
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
        $(document).on('click', '.btn-fix', function () {
            let btn = $(this);
            $.ajax({
                url: "{{ route('project.favourite.add') }}",
                type: 'post',
                data: {
                    id: {{$project->id}},
                    add: 1
                },
                success: function () {
                    btn.removeClass('btn-fix');
                    btn.addClass('btn-fixed');
                    btn.text('気になるリストから削除');
                }
            });
        });
        $(document).on('click', '.btn-fixed', function () {
            let btn = $(this);
            $.ajax({
                url: "{{ route('project.favourite.add') }}",
                type: 'post',
                data: {
                    id: {{$project->id}},
                    add: 0
                },
                success: function () {
                    btn.text('気になるリストに追加');
                    btn.removeClass('btn-fixed');
                    btn.addClass('btn-fix');
                }
            });
        });
    </script>
@endsection
