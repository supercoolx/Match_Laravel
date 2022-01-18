<div class="col-md-12 profile-list-item shadow">
    <div class="row">
        <div class="col-md-6 justify-content-center">
            <div class="avatar-view align-items-center">
                <img src="{{ upload_asset($project->user->avatar) }}" alt="" class="avatar-img">
                <span class="registrant-name">{{ $project->user->name }}</span>
                <span class="registrant-name-kana">{{ $project->user->name_kana }}</span>
                <a href="{{ route('projects.detail', ['id' => $project->id]) }}" class="btn btn-profile-detail d-flex justify-content-center align-items-center">詳細</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-detail-top">
                <div class="profile-detail-item profile-detail-skill">インフラエンジニア</div>
                <div class="profile-detail-item profile-detail-workdays">{{ $project->weeks->name }}</div>
                <div class="profile-detail-item profile-detail-contract">{{ $contractType->name }}</div>
            </div>
            <div class="profile-detail-bottom">
                @if(isEngineer())
                    <a class="btn btn-theme btn-chat" href="{{ getChatLink($project) }}">チャットで話を聞く</a>
                    <a class="btn btn-theme btn-call" href="tel:{{ $project->phone }}">電話で話を聞く</a>
                @elseif(Auth::user()->user_type == $project->user->user_type)
                    <a class="btn btn-theme btn-chat" href="{{ getChatLink($project) }}">チャットで話を聞く</a>
                @endif
            </div>
        </div>
    </div>
</div>