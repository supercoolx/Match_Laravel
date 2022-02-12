<div class="content-sidebar {{ Auth::check() ? '' : 'h-100' }}">
    <form method="get" action="" id="filter-form">
        <input type="hidden" name="for" value="{{ $search['for'] }}">
        <div class="sidebar-wrapper">
            <div class="sidebar-item">
                <div class="sidebar-item-header">
                    フリーワード
                </div>
                <div class="sidebar-item-content">
                    <div class="sidebar-search">
                        <div class="input-group align-items-center">
                            <span class="icon-search"></span>
                            <input type="text" class="form-control" name="s" value="{{ $search['s'] }}" placeholder="検索">
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-item">
                <div class="sidebar-item-header">
                    職種
                </div>
                <div class="sidebar-item-content sidebar-job-type">
                    <div class="sidebar-list-label" data-toggle="collapse" data-target=".more-list">エンジニア</div>
                    <div class="sidebar-job-type-list more-list collapse">
                        @foreach($jobTypes as $jobType)
                            @if($jobType->more == 1)
                                <div class="sidebar-job-type-list-item">
                                    <label class="checkcontainer">{{ $jobType->name }}
                                        <input type="checkbox" {{ in_array($jobType->id, $search['jobType']) ? 'checked="checked"': '' }} value="{{ $jobType->id }}" name="jobType[]">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="sidebar-job-type-list origin-list">
                        @foreach($jobTypes as $jobType)
                            @if($jobType->more == 0)
                                <div class="sidebar-job-type-list-item">
                                    <label class="checkcontainer">{{ $jobType->name }}
                                        <input type="checkbox" {{ in_array($jobType->id, $search['jobType']) ? 'checked="checked"': '' }} value="{{ $jobType->id }}" name="jobType[]">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="sidebar-item">
                <div class="sidebar-item-header">
                    条件
                </div>
                <div class="sidebar-item-content sidebar-condition">
                    <div class="sidebar-condition-label">契約形態</div>
                    <div class="sidebar-condition-list">
                        @foreach($contractTypes as $contractType)
                            <div class="sidebar-condition-list-item">
                                <label class="checkcontainer">{{ $contractType->name }}
                                    <input type="checkbox" {{ in_array($contractType->id, $search['contractType']) ? 'checked="checked"' : '' }} name="contractType[]" value="{{ $contractType->id }}">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="sidebar-condition-label">稼働日数(週)</div>
                    <div class="sidebar-condition-list sidebar-condition-working-days">
                        @foreach($weeks as $week)
                            <div class="sidebar-condition-list-item">
                                <label class="checkcontainer">{{ $week->name }}
                                    <input type="checkbox" {{ in_array($week->id, $search['week']) ? 'checked="checked"' : '' }} name="week[]" value="{{ $week->id }}">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="sidebar-location-industry">
                        <div class="sidebar-location-industry-label">勤務地</div>
                        <div class="sidebar-location-industry-select" onclick="openAddressFilter()">選択する</div>
                    </div>
                    <div class="sidebar-condition-list" id="address-filter-list" style="display: none"></div>
                    <div class="sidebar-location-industry">
                        <div class="sidebar-location-industry-label">業界</div>
                        <div class="sidebar-location-industry-select" onclick="openIndustryFilter()">選択する</div>
                    </div>
                    <div class="sidebar-condition-list" id="industry-filter-list" style="display: none"></div>
                    <div class="sidebar-unite-price-label">単価</div>
                    <div class="sidebar-radio-list">
                        @foreach(range(3, 8) as $minPriceI)
                            <div class="sidebar-radio-list-item">
                                <label class="checkcontainer">{{ $minPriceI }}0万円～
                                    <input type="radio" name="minPrice" {{ $search['minPrice'] == $minPriceI * 100000 ? 'checked="checked"' : '' }} value="{{ $minPriceI * 100000 }}">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        @endforeach
                        <div class="sidebar-radio-list-item">
                            <label class="checkcontainer">指定無し
                                <input type="radio" name="minPrice" value="0">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-apply-filter d-flex justify-content-center">
                <button type="submit" class="btn btn-circle-black">検索する</button>
            </div>
        </div>
    </form>
</div>