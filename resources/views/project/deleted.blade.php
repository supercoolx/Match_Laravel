@extends('layout.app')

@section('content')
    <section class="content-section deletion-completion">
        <div class="container">
            <div class="row section-header">
                <div class="col-md-12 text-center">
                    <div class="completion-icon">
                        削除しました
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                @if(isCompany())
                    <a href="{{ route('company.dashboard') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">ダッシュボード</a>
                @endif
                @if(isAgent())
                    <a href="{{ route('agent.dashboard') }}" class="btn btn-theme btn-large d-flex justify-content-center align-items-center">ダッシュボード</a>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
