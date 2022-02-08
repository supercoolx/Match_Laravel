<div class="row">
    <div class="col-md-4 review">
        <div>
            <span>100位	公開案件数</span>
            <span class="float-right">{{ $review['projects'] }}</span>
        </div>
        <div>
            <span>100位	公開案件閲苣数</span>
            <span class="float-right">{{ $review['projects_view'] }}</span>
        </div>
        <div>
            <span>100位	契約成立数</span>
            <span class="float-right">{{ $review['projects_end'] }}</span>
        </div>
        <div>
            <span>100位	フォロー数</span>
            <span class="float-right">{{ $review['follow_cnt'] }}</span>
        </div>
        <div>
            <span>100位	フォロワー数</span>
            <span class="float-right">{{ $review['followed_cnt'] }}</span>
        </div>
        <div>
            <span>100位	友達紹介数</span>
            <span class="float-right">{{ $review['invites'] }}</span>
        </div>
    </div>
    <div class="col-md-8">
        <div id="score-chart"></div>
    </div>
</div>