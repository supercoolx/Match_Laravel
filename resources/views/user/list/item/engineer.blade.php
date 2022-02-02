<div class="profile-list-item shadow">
    @php 
        $follow_by = array_column($user->follow_by->toArray(), 'id');
    @endphp
    <img src="{{ isset($user->avatar) ? upload_asset($user->avatar) : static_asset('assets/img/avatar/default.png') }}" alt="" class="avatar-img">
    <span class="registrant-name-kana">{{ $user->name_kana }}</span>
    @if($user->profile)
        <div class="job-type">
            <img src="{{ static_asset('assets/img/icon-light.png') }}">
            {{ implode(', ', array_column($user->profile->jobs->toArray(), 'name')) }}
        </div>
        <div class="week">
            <img src="{{ static_asset('assets/img/icon-calendar.png') }}">
            週{{ $user->profile->week }}日
        </div>
        <div class="contract-type">
            <img src="{{ static_asset('assets/img/icon-handshake.png') }}">
            {{ implode(', ', array_column($user->profile->contractTypes->toArray(), 'name')) }}
        </div>
    @else
        <div class="job-type"></div>
        <div class="week"></div>
        <div class="contract-type"></div>
    @endif
    <div class="group">
        @isset($user->profile->open_job)
            @if($user->profile->open_job)
                <button class="btn btn-circle-black">求職中</button>
            @endif
        @endisset
        @if(in_array(Auth::user()->id, $follow_by))
            <button class="btn btn-circle unfollow" data-id="{{ $user->id }}">フォロー中</button>
        @else
            <button class="btn btn-circle-o follow" data-id="{{ $user->id }}">フォロー</button>
        @endif
        <a class="btn btn-circle" href="{{ route('user.detail', ['id' => $user->id]) }}" target="_blank">詳細</a>
    </div>
</div>