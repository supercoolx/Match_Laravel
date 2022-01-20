<header class="site-header">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-light">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ static_asset('assets/img/logo/logo.png') }}" class="img-fluid" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-folder fa-lg fa-color"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-address-card fa-lg"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-chart-line fa-lg"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-clipboard fa-lg"></i></a>
                    </li>
                    @if (!isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chat.index') }}"><i class="fas fa-comment-alt fa-flip-horizontal fa-lg"></i></a>
                        </li>
                    @endif
                    <li class="nav-item dropdown account-menu">
                        <a class="nav-link" href="#"><img src="{{ getAuthAvatar() }}" class="icon-account object-cover-center" alt="" /></a>
                        <div class="dropdown-menu" aria-labelledby="userDropdownMenu" style="left: {{ isAdmin() ? '-150px' : (isCompany() || isAgent() ? '-101px' : '-114px') }}">
                            @if (isAdmin()) 
                                <a class="dropdown-item" href="{{ route('admin.password') }}">パスワードを変更する</a>
                            @endif
                            @if (isCompany())
                                <a class="dropdown-item" href="{{ route('company.setting', ['step' => 2]) }}">ユーザー設定</a>
                            @elseif (isAgent())
                                <a class="dropdown-item" href="{{ route('agent.setting', ['step' => 2]) }}">ユーザー設定</a>
                            @elseif (isEngineer())
                                <a class="dropdown-item" href="{{ route('engineer.setting', ['step' => 2]) }}">ユーザー設定</a>
                                <a class="dropdown-item" href="{{ route('engineer.profile.setting', ['step' => 2]) }}">プロフィール設定</a>
                            @endif
                            @if(!isAdmin()) 
                                <a class="dropdown-item" href="{{ route('projects.list') }}">掲載一覧ページ</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}">ログアウト</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
