<div class="project-item">
    <div class="job-type-industry">
        <span class="btn job-type">{{ $project->jobType->name }}</span>
        <span class="btn job-industry">{{ $project->industries->name }}</span>
        <span class="job-day">週 {{ $project->weeks->name }}</span>
    </div>
    <h2>{{ $project->name }}</h2>
    <h3>{{ number_comma($project->price_min) }} ~ {{ number_comma($project->price_max) }} / 月</h3>
    <div class="divider"></div>
    <p>{{ $project->content }}</p>
    <div class="publisher">
        <img src="{{ $project->user->avatar ? upload_asset($project->user->avatar) : static_asset('assets/img/avatar/default.png') }}" class="object-cover-center" alt="">
        <span>{{ $project->user->name }}</span>
    </div>
    <a href="{{ route('projects.detail', ['id' => $project->id]) }}" class="btn btn-detail d-flex justify-content-center align-items-center" target="_blank">詳細</a>
</div>
