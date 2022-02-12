<div class="row">
    <div class="col-md-4 review">
        <div class="review-list active" data-for="projects">
            <span>{{ $review['rank']['projects'] }}位 公開案件数</span>
            <span class="float-right">{{ $review['score']['projects'] }}</span>
        </div>
        <div class="review-list" data-for="projects_view">
            <span>{{ $review['rank']['projects_view'] }}位 公開案件閲苣数</span>
            <span class="float-right">{{ $review['score']['projects_view'] }}</span>
        </div>
        <div class="review-list" data-for="projects_end">
            <span>{{ $review['rank']['projects_end'] }}位 契約成立数</span>
            <span class="float-right">{{ $review['score']['projects_end'] }}</span>
        </div>
        <div class="review-list" data-for="follow_cnt">
            <span>{{ $review['rank']['follow_cnt'] }}位 フォロー数</span>
            <span class="float-right">{{ $review['score']['follow_cnt'] }}</span>
        </div>
        <div class="review-list" data-for="followed_cnt">
            <span>{{ $review['rank']['followed_cnt'] }}位 フォロワー数</span>
            <span class="float-right">{{ $review['score']['followed_cnt'] }}</span>
        </div>
        <div class="review-list" data-for="invites">
            <span>{{ $review['rank']['invites'] }}位 友達紹介数</span>
            <span class="float-right">{{ $review['score']['invites'] }}</span>
        </div>
    </div>
    <div class="col-md-8">
        <div id="score-chart"></div>
    </div>
</div>