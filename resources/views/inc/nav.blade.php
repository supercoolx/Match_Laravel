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
                    @if (!isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('*.dashboard') ? 'active' : '' }}" href="{{ route('home') }}">
                                <img src="{{ static_asset('assets/img/folder.png') }}" class="icon-list" alt="list icon" />
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.follow.list') }}">
                                <img src="{{ static_asset('assets/img/contact.png') }}" class="icon-list" alt="list icon" />
                            </a>
                        </li>
                        @if(isAgent())
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('agent.score') ? 'active' : '' }}" href="{{ route('agent.score') }}">
                                    <img src="{{ static_asset('assets/img/chart.png') }}" class="icon-list" alt="list icon" />
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="{{ static_asset('assets/img/clipboard.png') }}" class="icon-list" alt="list icon" />
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('chat.*') ? 'active' : '' }}" href="{{ route('chat.index') }}">
                                <img src="{{ static_asset('assets/img/chat.png') }}" class="icon-list" alt="list icon" />
                                @if(Auth::user()->newMessageCount())
                                    <span class="badge badge-danger position-absolute" style="right: 57px; top: 10px;">{{ Auth::user()->newMessageCount() }}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                    <li class="nav-item account-menu">
                        <a class="nav-link" href="#"><img src="{{ getAuthAvatar() }}" class="icon-account object-cover-center" alt="" /></a>
                        <nav id="sidebar" class="active">
                            <ul class="sidebar-menu">
                                @if(isCompany())
                                    <li class="item">
                                        <a href="{{ route('company.setting') }}">??????????????????</a>
                                    </li>
                                @elseif(isAgent())
                                    <li class="item">
                                        <a href="{{ route('agent.setting') }}">??????????????????</a>
                                    </li>
                                    <li class="item">
                                        <a href="{{ route('agent.profile.setting') }}">????????????????????????</a>
                                    </li>
                                @elseif(isEngineer())
                                    <li class="item">
                                        <a href="{{ route('engineer.setting') }}">??????????????????</a>
                                    </li>
                                    <li class="item">
                                        <a href="{{ route('engineer.profile.setting') }}">????????????????????????</a>
                                    </li>
                                @elseif(isAdmin())
                                    <li class="item">
                                        <a href="{{ route('admin.password') }}">???????????????</a>
                                    </li>
                                @endif
                                @if(!isAdmin())
                                    <li class="item">
                                        <a href="{{ route('projects.list') }}">?????????????????????</a>
                                    </li>
                                @endif
                                @if(isEngineer())
                                    <li class="item">
                                        <a href="{{ route('engineer.dashboard') }}?favourite">?????????????????????</a>
                                    </li>
                                @endif
                                @if(isAgent())
                                    <li class="item">
                                        <a href="{{ route('invite') }}">????????????</a>
                                    </li>
                                @endif
                                <li class="item">
                                    <a href="{{ route('logout') }}">???????????????</a>
                                </li>
                            </ul>
                            <ul class="bottom-menu">
                                <li class="item">
                                    <a href="#">?????????????????????</a>
                                </li>
                                <li class="item">
                                    <a href="{{ route('terms') }}">????????????</a>
                                </li>
                                <li class="item">
                                    <a href="{{ route('policy') }}">???????????????????????????????????????</a>
                                </li>
                            </ul>
                        </nav>
                        {{-- <div class="dropdown-menu" aria-labelledby="userDropdownMenu" style="left: {{ isAdmin() ? '-150px' : (isCompany() || isAgent() ? '-101px' : '-114px') }}">
                            @if (isAdmin()) 
                                <a class="dropdown-item" href="{{ route('admin.password') }}">??????????????????????????????</a>
                            @endif
                            @if (isCompany())
                                <a class="dropdown-item" href="{{ route('company.setting', ['step' => 2]) }}">??????????????????</a>
                            @elseif (isAgent())
                                <a class="dropdown-item" href="{{ route('agent.setting', ['step' => 2]) }}">??????????????????</a>
                                <a class="dropdown-item" href="{{ route('agent.profile.setting', ['step' => 2]) }}">????????????????????????</a>
                            @elseif (isEngineer())
                                <a class="dropdown-item" href="{{ route('engineer.setting', ['step' => 2]) }}">??????????????????</a>
                                <a class="dropdown-item" href="{{ route('engineer.profile.setting', ['step' => 2]) }}">????????????????????????</a>
                            @endif
                            @if(!isAdmin()) 
                                <a class="dropdown-item" href="{{ route('projects.list') }}">?????????????????????</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}">???????????????</a>
                        </div> --}}
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
