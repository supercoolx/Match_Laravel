<div class="applicant-profile-preview">
    <div class="container">
        <div class="profile-header row">
            <div class="user-follow col-md-4">
                <img src="{{ getAuthAvatar() }}" alt="" class="avatar-img">
                <p class="registrant-name-kana">{{ Auth::user()->name_kana }}</p>
                <button class="btn btn-circle btn-follow">フォロー</button>
            </div>
            <div class="col-md-4">
                <div id="user-chart"></div>
            </div>
            <div class="col-md-4">
                <a href="#" class="btn btn-theme btn-chat d-flex justify-content-center align-items-center">チャットで話を聞く</a>
                <a href="#" class="btn btn-theme btn-call d-flex justify-content-center align-items-center">電話で話を聞く</a>
            </div>
        </div>
    </div>
    <div class="profile-container">
        <div class="container">
            <nav>
                <div class="nav nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-work-tab" data-toggle="tab" href="#nav-work" role="tab" aria-controls="nav-work" aria-selected="true">業務経験</a>
                    <a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false">学歴</a>
                    <a class="nav-item nav-link" id="nav-qualification-tab" data-toggle="tab" href="#nav-qualification" role="tab" aria-controls="nav-qualification" aria-selected="false">資格</a>
                    <a class="nav-item nav-link" id="nav-award-tab" data-toggle="tab" href="#nav-award" role="tab" aria-controls="nav-award" aria-selected="false">受賞歴</a>
                    <a class="nav-item nav-link" id="nav-writing-tab" data-toggle="tab" href="#nav-writing" role="tab" aria-controls="nav-writing" aria-selected="false">執筆歴</a>
                    <a class="nav-item nav-link" id="nav-score-tab" data-toggle="tab" href="#nav-score" role="tab" aria-controls="nav-score" aria-selected="false">スコア</a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                    @include('profile.step2.tab-work')
                </div>
                <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
                    @include('profile.step2.tab-education')
                </div>
                <div class="tab-pane fade" id="nav-qualification" role="tabpanel" aria-labelledby="nav-qualification-tab">
                    @include('profile.step2.tab-qualification')
                </div>
                <div class="tab-pane fade" id="nav-award" role="tabpanel" aria-labelledby="nav-award-tab">
                    @include('profile.step2.tab-award')
                </div>
                <div class="tab-pane fade" id="nav-writing" role="tabpanel" aria-labelledby="nav-writing-tab">
                    @include('profile.step2.tab-writing')
                </div>
                <div class="tab-pane fade" id="nav-score" role="tabpanel" aria-labelledby="nav-score-tab">
                    @include('profile.step2.tab-score')
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-black-sm btn-prev mr-4">修正</button>
            <button class="btn btn-black-sm btn-next">掲載</button>
        </div>
    </div>
</div>