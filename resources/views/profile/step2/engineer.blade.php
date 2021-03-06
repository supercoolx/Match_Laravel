<div class="applicant-profile-preview">
    @php 
        $follow_by = $profile ? array_column($profile->user->follow_by->toArray(), 'id') : [];
    @endphp
    <div class="container">
        <div class="profile-header row">
            <div class="user-follow col-md-4">
                <img src="{{ isset($profile) && $profile->user->avatar ? upload_asset($profile->user->avatar) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
                <p class="registrant-name-kana">{{ isset($profile) ? $profile->user->name_kana : Auth::user()->name_kana }}</p>
                @if(in_array(Auth::user()->id, $follow_by))
                    <button class="btn btn-circle unfollow" data-id="{{ $profile ? $profile->user_id : Auth::user()->id }}">フォロー中</button>
                @else
                    <button class="btn btn-circle-o follow" data-id="{{ $profile ? $profile->user_id : Auth::user()->id }}">フォロー</button>
                @endif
            </div>
            <div class="col-md-4 text-left">
                <p><div class="row">
                    <div class="col-md-3"><img src="{{ static_asset('assets/img/icon-light.png') }}"></div>
                    <div class="col-md-9" id="profile-job">
                        @isset($profile->jobs)
                            {{ implode(', ', array_column($profile->jobs->toArray(), 'name')) }}
                        @endisset
                    </div>
                </div></p>
                <p><div class="row">
                    <div class="col-md-3"><img src="{{ static_asset('assets/img/icon-calendar.png') }}"></div>
                    <div class="col-md-9" id="profile-week">週{{ isset($profile->week) ? $profile->week : '5' }}日</div>
                </div></p>
                <p><div class="row">
                    <div class="col-md-3"><img src="{{ static_asset('assets/img/icon-handshake.png') }}"></div>
                    <div class="col-md-9" id="profile-contract">
                        @isset($profile->contractTypes)
                            {{ implode(', ', array_column($profile->contractTypes->toArray(), 'name')) }}
                        @endisset
                    </div>
                </div></p>
            </div>
            <div class="col-md-4">
                <a href="{{ isset($project) ? getChatLink($project) : 'javascript: void(0);' }}" class="btn btn-theme btn-chat d-flex justify-content-center align-items-center">チャットで話を聞く</a>
                <a href="tel:{{ $profile->user->phone }}" class="btn btn-theme btn-call d-flex justify-content-center align-items-center">電話で話を聞く</a>
            </div>
        </div>
    </div>
    <div class="profile-container">
        <div class="container">
            <nav>
                <div class="nav nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-work-tab" data-toggle="tab" href="#nav-work" role="tab" aria-controls="nav-work" aria-selected="true">業務経験</a>
                    <a class="nav-item nav-link" id="nav-skill-tab" data-toggle="tab" href="#nav-skill" role="tab" aria-controls="nav-skill" aria-selected="true">スキル</a>
                    <a class="nav-item nav-link" id="nav-education-qualification-tab" data-toggle="tab" href="#nav-education-qualification" role="tab" aria-controls="nav-education-qualification" aria-selected="false">学歴, 資格</a>
                    <a class="nav-item nav-link" id="nav-award-writing-tab" data-toggle="tab" href="#nav-award-writing" role="tab" aria-controls="nav-award-writing" aria-selected="false">受賞歴, 執筆歴</a>
                    <a class="nav-item nav-link" id="nav-portfolio-tab" data-toggle="tab" href="#nav-portfolio" role="tab" aria-controls="nav-portfolio" aria-selected="false">ポートフォリオ</a>
                    <a class="nav-item nav-link" id="nav-commit-tab" data-toggle="tab" href="#nav-commit" role="tab" aria-controls="nav-commit" aria-selected="false">こだわり</a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                    @include('profile.step2.tab-work')
                </div>
                <div class="tab-pane fade" id="nav-skill" role="tabpanel" aria-labelledby="nav-skill-tab">
                    @include('profile.step2.tab-skill')
                </div>
                <div class="tab-pane fade" id="nav-education-qualification" role="tabpanel" aria-labelledby="nav-education-qualification-tab">
                    <div class="row">
                        <div class="col-md-6" id="nav-education">
                            @include('profile.step2.tab-education')
                        </div>
                        <div class="col-md-6" id="nav-qualification">
                            @include('profile.step2.tab-qualification')
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-award-writing" role="tabpanel" aria-labelledby="nav-award-writing-tab">
                    <div class="row">
                        <div class="col-md-6" id="nav-award">
                            @include('profile.step2.tab-award')
                        </div>
                        <div class="col-md-6" id="nav-writing">
                            @include('profile.step2.tab-writing')
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-portfolio" role="tabpanel" aria-labelledby="nav-portfolio-tab">
                    @include('profile.step2.tab-portfolio')
                </div>
                <div class="tab-pane fade" id="nav-commit" role="tabpanel" aria-labelledby="nav-commit-tab">
                    @include('profile.step2.tab-commit')
                </div>
            </div>
        </div>
        @if(Route::currentRouteName() != 'user.detail')
            <div class="d-flex justify-content-center">
                <button class="btn btn-black-sm btn-prev mr-4">修正</button>
                <button class="btn btn-black-sm btn-next">掲載</button>
            </div>
        @endif
    </div>
</div>