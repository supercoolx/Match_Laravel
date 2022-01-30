<div class="profile-list-item shadow">
    @php 
        $follow_by = array_column($user->follow_by->toArray(), 'id');
    @endphp
    <img src="{{ isset($user->avatar) ? upload_asset($user->avatar) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
    <span class="registrant-name-kana">{{ $user->name_kana }}</span>
    <div class="level">
        <img src="{{ static_asset('assets/img/icon-light.png') }}">
        Lv.1
    </div>
    <div class="level">
        <img src="{{ static_asset('assets/img/icon-light.png') }}">
        Lv.2
    </div>
    <div class="level">
        <img src="{{ static_asset('assets/img/icon-light.png') }}">
        Lv.3
    </div>
    <div class="level">
        <img src="{{ static_asset('assets/img/icon-light.png') }}">
        Lv.4
    </div>
    <div class="level">
        <img src="{{ static_asset('assets/img/icon-light.png') }}">
        Lv.5
    </div>
    <div class="group">
        <button class="btn btn-circle-yellow-o">58</button>
        <button class="btn btn-circle-yellow"><img src="{{ static_asset('assets/img/ribon.png') }}">1位</button>
        @if(in_array(Auth::user()->id, $follow_by))
            <button class="btn btn-circle unfollow" data-id="{{ $user->id }}">フォロー中</button>
        @else
            <button class="btn btn-circle-o follow" data-id="{{ $user->id }}">フォロー</button>
        @endif
        <button class="btn btn-circle">詳細</button>
    </div>
</div>