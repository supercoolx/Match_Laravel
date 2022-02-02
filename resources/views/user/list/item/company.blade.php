<div class="profile-list-item shadow">
    @php 
        $follow_by = array_column($user->follow_by->toArray(), 'id');
    @endphp
    <img src="{{ isset($user->avatar) ? upload_asset($user->avatar) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
    <span class="registrant-name-kana">{{ $user->name_kana }}</span>
    <div style="flex: 1"></div>
    <div class="group">
        <button class="btn btn-circle-gray">求職中</button>
        <button class="btn btn-circle-purple">不動產</button>
        <button class="btn btn-circle-gray-o">HP</button>
        @if(in_array(Auth::user()->id, $follow_by))
            <button class="btn btn-circle unfollow" data-id="{{ $user->id }}">フォロー中</button>
        @else
            <button class="btn btn-circle-o follow" data-id="{{ $user->id }}">フォロー</button>
        @endif
        <a class="btn btn-circle" href="{{ route('user.detail', ['id' => $user->id]) }}" target="_blank">詳細</a>
    </div>
</div>