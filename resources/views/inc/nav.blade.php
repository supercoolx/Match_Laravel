<script>
    $(document).ready(function () {
        $('.account-menu').on({
            'mouseover': function () {
                $('#sidebar').removeClass('active');
            },
            'mouseout': function () {
                $('#sidebar').addClass('active');
            }
        });
    });
</script>

<header class="site-header">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-light">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ static_asset('assets/img/logo/logo.png') }}" class="img-fluid" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('*.dashboard') ? 'active' : '' }}" href="{{ route('home') }}">
                            <img src="{{ static_asset('assets/img/folder.png') }}" class="icon-list" alt="list icon" />
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.list') }}">
                            <img src="{{ static_asset('assets/img/contact.png') }}" class="icon-list" alt="list icon" />
                        </a>
                    </li>
                    @if(isAgent())
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="{{ static_asset('assets/img/chart.png') }}" class="icon-list" alt="list icon" />
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="{{ static_asset('assets/img/clipboard.png') }}" class="icon-list" alt="list icon" />
                        </a>
                    </li>
                    @if (!isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('chat.*') ? 'active' : '' }}" href="{{ route('chat.index') }}">
                                <img src="{{ static_asset('assets/img/chat.png') }}" class="icon-list" alt="list icon" />
                            </a>
                        </li>
                    @endif
                    <li class="nav-item account-menu">
                        <a class="nav-link" href="#"><img src="{{ getAuthAvatar() }}" class="icon-account object-cover-center" alt="" /></a>
                        <nav id="sidebar" class="active">
                            <ul class="sidebar-menu">
                                @if(isCompany())
                                    <li class="item">
                                        <a href="{{ route('company.setting') }}">ユーザー設定</a>
                                    </li>
                                @elseif(isAgent())
                                    <li class="item">
                                        <a href="{{ route('agent.setting') }}">ユーザー設定</a>
                                    </li>
                                    <li class="item">
                                        <a href="{{ route('agent.profile.setting') }}">プロフィール設定</a>
                                    </li>
                                @elseif(isEngineer())
                                    <li class="item">
                                        <a href="{{ route('engineer.setting') }}">ユーザー設定</a>
                                    </li>
                                    <li class="item">
                                        <a href="{{ route('engineer.profile.setting') }}">プロフィール設定</a>
                                    </li>
                                @endif
                                <li class="item">
                                    <a href="{{ route('projects.list') }}">掲載一覧ページ</a>
                                </li>
                                <li class="item">
                                    <a href="#">気になるリスト</a>
                                </li>
                                <li class="item">
                                    <a href="#">友達招待</a>
                                </li>
                                <li class="item">
                                    <a href="{{ route('logout') }}">ログアウト</a>
                                </li>
                            </ul>
                            <ul class="bottom-menu">
                                <li class="item">
                                    <a href="#">チュートリアル</a>
                                </li>
                                <li class="item">
                                    <a href="{{ route('terms') }}">利用規約</a>
                                </li>
                                <li class="item">
                                    <a href="{{ route('policy') }}">個人情報の取り扱いについて</a>
                                </li>
                            </ul>
                        </nav>
                        {{-- <div class="dropdown-menu" aria-labelledby="userDropdownMenu" style="left: {{ isAdmin() ? '-150px' : (isCompany() || isAgent() ? '-101px' : '-114px') }}">
                            @if (isAdmin()) 
                                <a class="dropdown-item" href="{{ route('admin.password') }}">パスワードを変更する</a>
                            @endif
                            @if (isCompany())
                                <a class="dropdown-item" href="{{ route('company.setting', ['step' => 2]) }}">ユーザー設定</a>
                            @elseif (isAgent())
                                <a class="dropdown-item" href="{{ route('agent.setting', ['step' => 2]) }}">ユーザー設定</a>
                                <a class="dropdown-item" href="{{ route('agent.profile.setting', ['step' => 2]) }}">プロフィール設定</a>
                            @elseif (isEngineer())
                                <a class="dropdown-item" href="{{ route('engineer.setting', ['step' => 2]) }}">ユーザー設定</a>
                                <a class="dropdown-item" href="{{ route('engineer.profile.setting', ['step' => 2]) }}">プロフィール設定</a>
                            @endif
                            @if(!isAdmin()) 
                                <a class="dropdown-item" href="{{ route('projects.list') }}">掲載一覧ページ</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}">ログアウト</a>
                        </div> --}}
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
