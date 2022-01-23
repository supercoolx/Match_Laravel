<p class="text-center"><b>掲載しました!</b></p>
<div class="case-entry-btn text-center">
    @if(isCompany())
        <a href="{{ route('company.dashboard') }}" class="btn btn-black">ダッシュボード</a>
    @elseif(isAgent())
        <a href="{{ route('company.dashboard') }}" class="btn btn-black">ダッシュボード</a>
    @endif
    <img src="{{ static_asset('assets/img/project_created.png') }}" class="img-success-background">
</div>