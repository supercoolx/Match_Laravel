@extends('layout.app')

@section('content')
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    @if($project->user_type == config("constants.user_type.agent"))
                        @include('project.template.detail-agent')
                    @elseif($project->user_type == config("constants.user_type.company"))
                        @include('project.template.detail-company')
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
