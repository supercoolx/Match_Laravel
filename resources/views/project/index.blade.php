@extends('layout.app')

@section('content')
    <section class="content-section has-sidebar">
        <div class="container">
            <div class="content-sidebar">
                <form method="get" action="{{ route('projects.list') }}" id="filter-form">
                    <input type="hidden" name="for" value="{{ $search['for'] }}">
                    <div class="sidebar-wrapper shadow">
                        <div class="sidebar-item">
                            <div class="sidebar-item-header">
                                フリーワード
                            </div>
                            <div class="sidebar-item-content">
                                <div class="sidebar-search">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="icon-search"></span>
                                            </div>
                                        </div>
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
                                <div class="sidebar-list-label">エンジニア</div>
                                <div class="sidebar-job-type-list more-list">
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
                            <button type="submit" class="btn btn-dark btn-medium">検索する</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="content-list {{ $search['for'] == config("constants.tab_for.company") ? ' for-engineers' : '' }}">
                <div class="row section-header">
                    <div class="section-tab">
                        <div class="section-tab-item active" onclick="setListTypeTab('{{ route('projects.list') }}')">求人・案件一覧</div>
                        <div class="section-tab-item" onclick="setListTypeTab('{{ route('users.list') }}')">掲載プロフィール一覧</div>
                    </div>
                    <div class="section-tab">
                        <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.agent") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.agent") }}')">エージェント</div>
                        <div class="section-tab-item {{ $search['for'] == config("constants.tab_for.company") ? 'active': '' }}" onclick="setUserTypeTab('{{ config("constants.tab_for.company") }}')">企業</div>
                    </div>
                    <div class="section-items-count">該当案件数{{ count($projects) }}件中 {{ $cnt }}件表示</div>
                </div>
                <div class="row justify-content-center">
                    @foreach($projects as $project)
                        @if($search['for'] == config("constants.tab_for.agent"))
                            @include('project.template.agent')
                        @elseif($search['for'] == config("constants.tab_for.company"))
                            @include('project.template.company')
                        @endif
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <!-- Addresses Modal -->
    <div class="modal fade" id="addressesModal" role="dialog" aria-labelledby="addressesModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">勤務地</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="nav flex-column nav-pills" id="addresses-tab" role="tablist" aria-orientation="vertical">
                            @foreach($addresses as $address)
                                <a class="nav-link {{ $address->id == 1 ? 'active' : '' }}" data-toggle="pill" href="#addresses-{{ $address->id }}" role="tab" aria-controls="addresses-{{ $address->id }}" aria-selected="true">{{ $address->name }}</a>
                            @endforeach
                        </div>
                        <div class="tab-content" id="addresses-tab-content">
                            @foreach($addresses as $address)
                                <div class="tab-pane fade {{ $address->id == 1 ? 'show active' : '' }}" id="addresses-{{ $address->id }}" role="tabpanel" aria-labelledby="addresses-{{ $address->id }}">
                                    @foreach($address['children'] as $level2Address)
                                        <div class="checkbox-addresses">
                                            <label class="checkcontainer">{{ $level2Address->name }}
                                                <input type="checkbox" name="addresses[]" {{ in_array($level2Address->id, $search['addresses']) ? 'checked="checked"' : '' }} value="{{ $level2Address->id }}" data-label="2" data-name="{{ $level2Address->name }}" data-parent="{{ $address->id }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        @if(isset($level2Address['children']) && count($level2Address['children']) > 0)
                                            @foreach($level2Address['children'] as $level3Address)
                                                <div class="checkbox-addresses level-3-addresses">
                                                    <label class="checkcontainer">{{ $level3Address->name }}
                                                        <input type="checkbox" name="addresses[]" {{ in_array($level3Address->id, $search['addresses']) ? 'checked="checked"' : '' }} value="{{ $level3Address->id }}" data-label="3" data-name="{{ $level3Address->name }}" data-parent="{{ $level2Address->id }}">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    @if(isset($level3Address['children']) && count($level3Address['children']) > 0)
                                                        <a class="collapse-address collapsed" data-toggle="collapse" href="#addresses-{{ $level3Address->id }}" role="button" aria-expanded="false" aria-controls="addresses-{{ $level3Address->id }}"></a>
                                                    @endif
                                                </div>
                                                @foreach($level3Address['children'] as $level4Address)
                                                    <div class="collapse" id="addresses-{{ $level3Address->id }}">
                                                        <div class="checkbox-addresses level-4-addresses">
                                                            <label class="checkcontainer">{{ $level4Address->name }}
                                                                <input type="checkbox" name="addresses[]" {{ in_array($level4Address->id, $search['addresses']) ? 'checked="checked"' : '' }} value="{{ $level4Address->id }}" data-label="4" data-name="{{ $level4Address->name }}" data-parent="{{ $level3Address->id }}">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-theme btn-small btn-dark" onclick="applyAddressFilter()">この条件で検索する</button>
                    <button type="button" class="btn btn-theme btn-small btn-blue" onclick="resetAddressFilter()">条件をクリア</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Industries Modal -->
    <div class="modal fade" id="industriesModal" role="dialog" aria-labelledby="industriesModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">業界</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-industries">
                        <div class="row">
                            @foreach($industries as $industry)
                                <div class="modal-body-industries col-sm-6 col-12">
                                    <label class="checkcontainer">{{ $industry->name }}
                                        <input type="checkbox" {{ in_array($industry->id, $search['industries']) ? 'checked="checked"' : '' }} name="industries[]" data-name="{{ $industry->name }}" value="{{ $industry->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-theme btn-small btn-dark" onclick="applyIndustryFilter()">この条件で検索する</button>
                    <button type="button" class="btn btn-theme btn-small btn-blue" onclick="resetIndustryFilter()">条件をクリア</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function setListTypeTab(url) {
            window.location.href = url;
        }
        function setUserTypeTab(userType) {
            window.location.href = '{{ route('projects.list') }}?for=' + userType
        }
        function applyAddressFilter() {
            $('#addressesModal').modal('hide');
            // $('#filter-form').submit();
        }
        function resetAddressFilter() {
            $('#addressesModal input[name="addresses[]"]').prop('checked', false).change();
            $('#addressesModal').modal('hide');
        }
        function openAddressFilter() {
            $('#addressesModal').modal('show');
        }
        function applyIndustryFilter() {
            $('#industriesModal').modal('hide');
            // $('#filter-form').submit();
        }
        function resetIndustryFilter() {
            $('#industriesModal input[name="industries[]"]').prop('checked', false).change();
            $('#industriesModal').modal('hide');
        }
        function openIndustryFilter() {
            $('#industriesModal').modal('show');
        }
        function addCheckedAddressesToSidebar() {
            const elAddressesFilter = $('#address-filter-list');
            elAddressesFilter.html("");
            const checkedAddresses = $('#addressesModal input[name="addresses[]"]:checked').map(function(){
                elAddressesFilter.append('<div class="sidebar-condition-list-item">' +
                    '<label class="checkcontainer">' + $(this).data('name') +
                    '<input type="checkbox" name="addresses[]" value="' + $(this).val() + '" checked>' +
                    '<span class="checkmark"></span>' +
                    '</label>' +
                    '</div>');
                return $(this).val();
            }).get();
            if(checkedAddresses.length > 0) {
                elAddressesFilter.css('display', 'block');
            } else {
                elAddressesFilter.css('display', 'none');
            }
        }
        function addCheckedIndustriesToSidebar() {
            const elIndustryFilter = $('#industry-filter-list');
            elIndustryFilter.html("");
            const checkedIndustries = $('#industriesModal input[name="industries[]"]:checked').map(function(){
                elIndustryFilter.append('<div class="sidebar-condition-list-item">' +
                    '<label class="checkcontainer">' + $(this).data('name') +
                    '<input type="checkbox" name="industries[]" value="' + $(this).val() + '" checked>' +
                    '<span class="checkmark"></span>' +
                    '</label>' +
                    '</div>');
                return $(this).val();
            }).get();
            if(checkedIndustries.length > 0) {
                elIndustryFilter.css('display', 'block');
            } else {
                elIndustryFilter.css('display', 'none');
            }
        }
        $(document).ready(function () {
            addCheckedAddressesToSidebar();
            addCheckedIndustriesToSidebar();
            $('.sidebar-list-label').click(function (e) {
                $(this).toggleClass('open');
            });
            $('#addressesModal input[name="addresses[]"]').change(function () {
                const isChecked = $(this).is(":checked");
                const addressId = $(this).val();
                $('#addressesModal input[data-parent="' + addressId + '"]').prop('checked', isChecked).change();
                addCheckedAddressesToSidebar();
            });
            $('#industriesModal input[name="industries[]"]').change(function () {
                addCheckedIndustriesToSidebar();
            });
            $('#address-filter-list').on('change', 'input[name="addresses[]"]', function () {
                $('#addressesModal input[value="' + $(this).val() + '"]').prop('checked', false).change();
            });
            $('#industry-filter-list').on('change', 'input[name="industries[]"]', function () {
                $('#industriesModal input[value="' + $(this).val() + '"]').prop('checked', false).change();
            });
        })
    </script>
@endsection
