<div class="col-md-12 project-item">
    <img src="{{ $project->image ? upload_asset($project->image): static_asset('assets/img/project-thumb.jpg') }}" alt="" class="project-thumb object-cover-center">
    <div class="job-type-industry">
        <button class="btn job-type">{{ $project->jobType->name }}</button>
        <button class="btn job-industry">{{ $project->industries->name }}</button>
        <span class="job-day">週 {{ $project->weeks->name }}</span>
    </div>
    <h2>{{ $project->name }}</h2>
    <h3>{{ $project->price_min }}　～　{{ $project->price_max }} / 月</h3>
    <div class="divider"></div>
    <p>{{ $project->content }}</p>
    <div class="publisher">
        <img src="{{ $project->user->avatar ? upload_asset($project->user->avatar) : static_asset('assets/img/avatar/default.png') }}" class="object-cover-center" alt="">
        <span>{{ $project->user->name }}</span>
    </div>
    <a href="{{ route('projects.detail', ['id' => $project->id]) }}" class="btn btn-detail d-flex justify-content-center align-items-center">詳細</a>
</div>
