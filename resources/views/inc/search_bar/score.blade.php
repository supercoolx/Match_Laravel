<div class="content-sidebar">
    <div class="sidebar-wrapper">
        <div class="sidebar-item">
            <div class="sidebar-item-header">
                フリーワード
            </div>
            <div class="sidebar-item-content row mb-3">
                <div class="col-6 border-right">
                    <p class="text-center">スコア</p>
                    <p class="text-center mb-0">{{ array_sum($review['score']) }}</p>
                </div>
                <div class="col-6">
                    <p class="text-center">ランキング</p>
                    <p class="text-center mb-0">
                        @php
                            switch ($review['total_ranking']) {
                                case 1: $ribon = '-gold'; break;
                                case 2: $ribon = '-silver'; break;
                                case 3: $ribon = '-copper'; break;
                                default: $ribon = ''; break;
                            }
                        @endphp
                        <img src="{{ static_asset("assets/img/ribon$ribon.png") }}" class="mr-1">
                        {{ $review['total_ranking'] }}位
                    </p>
                </div>
            </div>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-item-header">
                公開案件数
            </div>
            <div class="sidebar-list-content">
                @foreach($projects as $el)
                    <div class="sidebar-list-label collapsed {{ $review['score']['projects'] > $el->require ? 'font-weight-bold text-black' : 'grayed' }}" data-toggle="collapse" data-target="#project{{ $el->id }}">Lv.{{ $el->level === 6 ? 'MAX' : $el->level }}</div>
                    <div class="collapse" id="project{{ $el->id }}">
                        <div class="d-flex flex-wrap justify-content-center px-4">
                            <img src="{{ static_asset('assets/img/reward/project-'.$el->level.'.png') }}" alt="reward" class="w-50 mx-5">
                            <p class="my-3">{{ $el->description }}</p>
                            <p class="ml-3">公開案件数が{{ $el->require }}件以上になる。(Lv.{{ $el->id - 1 }}-Lv.{{ $el->level === 6 ? 'MAX' : $el->level }})</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-item-header">
                公開案件閲覧数
            </div>
            <div class="sidebar-list-content">
                @foreach($projects_view as $el)
                    <div class="sidebar-list-label collapsed {{ $review['score']['projects_view'] > $el->require ? 'font-weight-bold text-black' : 'grayed' }}" data-toggle="collapse" data-target="#project{{ $el->id }}">Lv.{{ $el->level === 6 ? 'MAX' : $el->level }}</div>
                    <div class="collapse" id="project{{ $el->id }}">
                        <div class="d-flex flex-wrap justify-content-center px-4">
                            <img src="{{ static_asset('assets/img/reward/attention-'.$el->level.'.png') }}" alt="reward" class="w-50 mx-5">
                            <p class="my-3">{{ $el->description }}</p>
                            <p class="ml-3">公開案件閲覧数が{{ $el->require }}件以上になる。(Lv.{{ $el->id - 1 }}-Lv.{{ $el->level === 6 ? 'MAX' : $el->level }})</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-item-header">
                契約成立数
            </div>
            <div class="sidebar-list-content">
                @foreach($projects_end as $el)
                    <div class="sidebar-list-label collapsed {{ $review['score']['projects_end'] > $el->require ? 'font-weight-bold text-black' : 'grayed' }}" data-toggle="collapse" data-target="#project{{ $el->id }}">Lv.{{ $el->level === 6 ? 'MAX' : $el->level }}</div>
                    <div class="collapse" id="project{{ $el->id }}">
                        <div class="d-flex flex-wrap justify-content-center px-4">
                            <img src="{{ static_asset('assets/img/reward/contract-'.$el->level.'.png') }}" alt="reward" class="w-50 mx-5">
                            <p class="my-3">{{ $el->description }}</p>
                            <p class="ml-3">契約成立数が{{ $el->require }}件以上になる。(Lv.{{ $el->id - 1 }}-Lv.{{ $el->level === 6 ? 'MAX' : $el->level }})</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-item-header">
                フォロー数
            </div>
            <div class="sidebar-list-content">
                @foreach($follow_cnt as $el)
                    <div class="sidebar-list-label collapsed {{ $review['score']['follow_cnt'] > $el->require ? 'font-weight-bold text-black' : 'grayed' }}" data-toggle="collapse" data-target="#project{{ $el->id }}">Lv.{{ $el->level === 6 ? 'MAX' : $el->level }}</div>
                    <div class="collapse" id="project{{ $el->id }}">
                        <div class="d-flex flex-wrap justify-content-center px-4">
                            <img src="{{ static_asset('assets/img/reward/following-'.$el->level.'.png') }}" alt="reward" class="w-50 mx-5">
                            <p class="my-3">{{ $el->description }}</p>
                            <p class="ml-3">フォロー数が{{ $el->require }}件以上になる。(Lv.{{ $el->id - 1 }}-Lv.{{ $el->level === 6 ? 'MAX' : $el->level }})</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-item-header">
                フォロワー数
            </div>
            <div class="sidebar-list-content">
                @foreach($followed_cnt as $el)
                    <div class="sidebar-list-label collapsed {{ $review['score']['followed_cnt'] > $el->require ? 'font-weight-bold text-black' : 'grayed' }}" data-toggle="collapse" data-target="#project{{ $el->id }}">Lv.{{ $el->level === 6 ? 'MAX' : $el->level }}</div>
                    <div class="collapse" id="project{{ $el->id }}">
                        <div class="d-flex flex-wrap justify-content-center px-4">
                            <img src="{{ static_asset('assets/img/reward/follower-'.$el->level.'.png') }}" alt="reward" class="w-50 mx-5">
                            <p class="my-3">{{ $el->description }}</p>
                            <p class="ml-3">フォロワー数が{{ $el->require }}件以上になる。(Lv.{{ $el->id - 1 }}-Lv.{{ $el->level === 6 ? 'MAX' : $el->level }})</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-item-header">
                友達招待数
            </div>
            <div class="sidebar-list-content">
                @foreach($invites as $el)
                    <div class="sidebar-list-label collapsed {{ $review['score']['invites'] > $el->require ? 'font-weight-bold text-black' : 'grayed' }}" data-toggle="collapse" data-target="#project{{ $el->id }}">Lv.{{ $el->level === 6 ? 'MAX' : $el->level }}</div>
                    <div class="collapse" id="project{{ $el->id }}">
                        <div class="d-flex flex-wrap justify-content-center px-4">
                            <img src="{{ static_asset('assets/img/reward/friend-'.$el->level.'.png') }}" alt="reward" class="w-50 mx-5">
                            <p class="my-3">{{ $el->description }}</p>
                            <p class="ml-3">友達招待数が{{ $el->require }}件以上になる。(Lv.{{ $el->id - 1 }}-Lv.{{ $el->level === 6 ? 'MAX' : $el->level }})</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>