<div class="content-sidebar">
    <form method="get" action="" id="filter-form">
        <input type="hidden" name="for" value="{{ $search['for'] }}">
        <div class="sidebar-wrapper shadow">
            <div class="sidebar-item">
                <div class="sidebar-item-header">
                    フリーワード
                </div>
                <div class="sidebar-item-content">
                    <div class="sidebar-search">
                        <div class="input-group align-items-center">
                            <span class="icon-search"></span>
                            <input type="text" class="form-control" name="s" value="" placeholder="検索">
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-item">
                <div class="sidebar-item-header">
                    スコア
                </div>
                <div class="sidebar-list-label" data-toggle="collapse" data-target="#project">公開案件数</div>
                <div class="sidebar-radio-list collapse show" id="project">
                    @foreach(range(1, 5) as $level)
                        <div class="sidebar-radio-list-item">
                            <label class="checkcontainer">Lv.{{ $level }}～
                                <input type="radio" name="minPrice" value="{{ $level }}">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    @endforeach
                    <div class="sidebar-radio-list-item">
                        <label class="checkcontainer">Lv.MAX
                            <input type="radio" name="minPrice" value="0">
                            <span class="radiobtn"></span>
                        </label>
                    </div>
                </div>
                <div class="sidebar-list-label" data-toggle="collapse" data-target="#project_viewed">公開案件閲覧数</div>
                <div class="sidebar-radio-list collapse show" id="project_viewed">
                    @foreach(range(1, 5) as $level)
                        <div class="sidebar-radio-list-item">
                            <label class="checkcontainer">Lv.{{ $level }}～
                                <input type="radio" name="minPrice" value="{{ $level }}">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    @endforeach
                    <div class="sidebar-radio-list-item">
                        <label class="checkcontainer">Lv.MAX
                            <input type="radio" name="minPrice" value="0">
                            <span class="radiobtn"></span>
                        </label>
                    </div>
                </div>
                <div class="sidebar-list-label" data-toggle="collapse" data-target="#contract">契約成立数</div>
                <div class="sidebar-radio-list collapse show" id="contract">
                    @foreach(range(1, 5) as $level)
                        <div class="sidebar-radio-list-item">
                            <label class="checkcontainer">Lv.{{ $level }}～
                                <input type="radio" name="minPrice" value="{{ $level }}">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    @endforeach
                    <div class="sidebar-radio-list-item">
                        <label class="checkcontainer">Lv.MAX
                            <input type="radio" name="minPrice" value="0">
                            <span class="radiobtn"></span>
                        </label>
                    </div>
                </div>
                <div class="sidebar-list-label" data-toggle="collapse" data-target="#follow">フォロー数</div>
                <div class="sidebar-radio-list collapse show" id="follow">
                    @foreach(range(1, 5) as $level)
                        <div class="sidebar-radio-list-item">
                            <label class="checkcontainer">Lv.{{ $level }}～
                                <input type="radio" name="minPrice" value="{{ $level }}">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    @endforeach
                    <div class="sidebar-radio-list-item">
                        <label class="checkcontainer">Lv.MAX
                            <input type="radio" name="minPrice" value="0">
                            <span class="radiobtn"></span>
                        </label>
                    </div>
                </div>
                <div class="sidebar-list-label" data-toggle="collapse" data-target="#follower">フォロワー数</div>
                <div class="sidebar-radio-list collapse show" id="follower">
                    @foreach(range(1, 5) as $level)
                        <div class="sidebar-radio-list-item">
                            <label class="checkcontainer">Lv.{{ $level }}～
                                <input type="radio" name="minPrice" value="{{ $level }}">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    @endforeach
                    <div class="sidebar-radio-list-item">
                        <label class="checkcontainer">Lv.MAX
                            <input type="radio" name="minPrice" value="0">
                            <span class="radiobtn"></span>
                        </label>
                    </div>
                </div>
                <div class="sidebar-list-label" data-toggle="collapse" data-target="#referral">友達紹介数</div>
                <div class="sidebar-radio-list collapse show" id="referral">
                    @foreach(range(1, 5) as $level)
                        <div class="sidebar-radio-list-item">
                            <label class="checkcontainer">Lv.{{ $level }}～
                                <input type="radio" name="minPrice" value="{{ $level }}">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    @endforeach
                    <div class="sidebar-radio-list-item">
                        <label class="checkcontainer">Lv.MAX
                            <input type="radio" name="minPrice" value="0">
                            <span class="radiobtn"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="sidebar-apply-filter d-flex justify-content-center">
                <button type="submit" class="btn btn-dark rounded-pill">検索する</button>
            </div>
        </div>
    </form>
</div>