@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="content-case-entry item-detail for-company">
                        <div class="input-title-preview">
                            <h2 class="text-center">{{ $project->name }}</h2>
                            <div class="d-flex justify-content-center job-type-industry">
                                <button class="btn job-type">{{ $project->jobType->name }}</button>
                                <button class="btn job-industry">{{ $project->industries->name }}</button>
                            </div>
                        </div>
                        <div class="image-upload-preview d-flex align-items-center">
                            <img src="{{ upload_asset($project->user->avatar) ?? static_asset('assets/img/account.png') }}" class="object-cover-center" alt="{{ $project->user->name }}">
                            <span>{{ $project->user->name }}</span>
                        </div>
                        <div class="img-thumbnail-preview">
                            <img src="{{ $project->image ? upload_asset($project->image) : static_asset('assets/img/project-thumb.jpg') }}" class="object-cover-center" alt="{{ $project->name }}">
                        </div>
                        <div class="website-url-preview">
                            {{ $project->user->website }}
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>契約形態</label>
                            </div>
                            <div class="preview-value">{{ $project->contractType->name }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>週</label>
                            </div>
                            <div class="preview-value">{{ $project->weeks->name }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>単価</label>
                            </div>
                            <div class="preview-value">{{ $project->price_min }} ～ {{ $project->price_max }} / 月</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>職務内容</label>
                            </div>
                            <div class="preview-value">{{ $project->content }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>必須スキル</label>
                            </div>
                            <div class="preview-value">{{ $project->required_skills }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>尚可スキル</label>
                            </div>
                            <div class="preview-value">{{ $project->applicable_skills }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>求める人物像</label>
                            </div>
                            <div class="preview-value">{{ $project->required_person }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>チーム体制</label>
                            </div>
                            <div class="preview-value">{{ $project->team_structure }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>得られるスキル</label>
                            </div>
                            <div class="preview-value">{{ $project->gained_skills }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>勤務地</label>
                            </div>
                            <div class="preview-value">{{ $project->address->name }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>面談回数</label>
                            </div>
                            <div class="preview-value">{{ $project->interviews }} 回</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>作業開始日</label>
                            </div>
                            <div class="preview-value">{{ $project->start_date }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>始業/終業時間</label>
                            </div>
                            <div class="preview-value">{{ $project->start_time }}時 ～ {{ $project->end_time }}時</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>平均稼働時間</label>
                            </div>
                            <div class="preview-value">{{ $project->uptime_min }}h ～ {{ $project->uptime_max }}h</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>オンライン面談</label>
                            </div>
                            <div class="preview-value">{{ $project->online_interview == 1 ? '可' : '不可' }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>リモートワーク</label>
                            </div>
                            <div class="preview-value">{{ $project->remote_work == 1 ? '可' : '不可' }}</div>
                        </div>
                        <div class="input-preview">
                            <div class="preview-label">
                                <label>コメント</label>
                            </div>
                            <div class="preview-value">{{ $project->comment }}</div>
                        </div>
                        <div class="input-preview-btn-group d-flex justify-content-center">
                            <a href="{{ getChatLink($project) }}" class="btn btn-theme btn-medium btn-chat d-flex align-items-center justify-content-center">チャットで話を聞く</a>
                            <a href="tel:{{ $project->user->phone }}" class="btn btn-theme btn-medium btn-call d-flex align-items-center justify-content-center">電話で話を聞く</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
