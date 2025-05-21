<!--================================= header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
            <img src="{{ URL::asset('assets/images/eduspark2.png') }}" alt="logo" width="140px" height="190px"></a>
    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i
                    class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>
        <!-- <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value=""
                        name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li> -->
    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">

        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                @else
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                @endif
            </button>
            <div class="dropdown-menu">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>

        @php
            $user = null;

            if (auth('student')->check()) {
                $user = auth('student')->user();
                $routePrefix = 'student';
            } elseif (auth('teacher')->check()) {
                $user = auth('teacher')->user();
                $routePrefix = 'teacher';
            } elseif (auth('web')->check()) {
                $user = auth('web')->user();
                $routePrefix = 'admin';
            }
            
            $unreadNotifications = $user ? $user->unreadNotifications : collect();
            $allNotifications = $user ? $user->notifications()->limit(10)->get() : collect();
        @endphp

        @if ($user)
            <li class="nav-item dropdown">
                <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ti-bell"></i>
                    @if ($unreadNotifications->count() > 0)
                        <span class="badge badge-danger notification-status">dd</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                    <div class="dropdown-header notifications">
                        <strong>{{ trans('Sidebar_trans.Notifications') }}</strong>
                        <span class="badge badge-pill badge-warning">{{ $unreadNotifications->count() }}</span>
                    </div>
                    <div class="dropdown-divider"></div>

                    @foreach ($allNotifications as $notification)
                        <a href="{{ route($routePrefix . '.notification.read', $notification->id) }}"
                            class="dropdown-item @if ($notification->read_at) text-muted @else fw-bold @endif">
                            {{ $notification->data['body'] }}
                            <small
                                class="float-right text-muted time">{{ $notification->created_at->diffForHumans() }}</small>
                        </a>
                    @endforeach

                    @if ($allNotifications->isEmpty())
                        <p class="dropdown-item text-muted">{{ trans('main_trans.no_notifications') }}</p>
                    @endif
                </div>
            </li>
        @endif



        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ URL::asset('assets/images/user_icon.png') }}" alt="avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">
                                @if (auth('student')->check())
                                    {{ Auth::user()->name }}
                                @elseif(auth('teacher')->check())
                                    {{ auth()->user()->Name_Teacher }}
                                @elseif(auth('parent')->check())
                                    {{ auth()->user()->Name_Father }}
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                            </h5>
                            <!-- <span>{{ Auth::user()->email }}</span> -->
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i>Activity</a> -->
                <!-- <a class="dropdown-item" href="#"><i class="text-success ti-email"></i>Messages</a> -->
                <a class="dropdown-item"
                    href=" @if (auth('student')->check()) {{ route('profile-student.index') }}
                    @elseif(auth('teacher')->check())
                    {{ route('profile.show') }}
                        @elseif(auth('parent')->check())
                        {{ route('profile.show.parent') }}
                            @else
                            # @endif "><i
                        class="text-warning ti-user"></i>Profile</a>
                <!-- <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span class="badge badge-info">6</span> </a> -->
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a> -->
                @if (auth('student')->check())
                    <form method="GET" action="{{ route('logout', 'student') }}">
                    @elseif(auth('teacher')->check())
                        <form method="GET" action="{{ route('logout', 'teacher') }}">
                        @elseif(auth('parent')->check())
                            <form method="GET" action="{{ route('logout', 'parent') }}">
                            @else
                                <form method="GET" action="{{ route('logout', 'web') }}">
                @endif

                @csrf
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault();this.closest('form').submit();"><i class="bx bx-log-out"></i>تسجيل
                    الخروج</a>
                </form>

            </div>
        </li>
    </ul>
</nav>
<!--================================= header End-->

{{-- <header class="header">
    <section class="flex">
        <div class="icons">
            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
            <a href="{{ LaravelLocalization::getLocalizedURL(App::getLocale() == 'ar' ? 'en' : 'ar', null, [], true) }}"
                id="lang-btn" title="{{ trans('main_trans.change_lang') }}" class="fas fa-language">
            </a>
            <a href="#" id="search-btn" class="fas fa-search" title="{{ trans('Teacher_trans.search') }}"></a>
            <a href="#" id="user-btn" class="fas fa-user" title="{{ trans('Teacher_trans.user') }}"></a>
            <a href="#" id="bell-btn" class="fas fa-bell" title="{{ trans('Teacher_trans.notifications') }}"></a>

            <!-- <div id="msg-btn" class="fa-solid fa-message" title="الرسائل"></div> -->
        </div>
        <!-- <form action="" method="post" class="search-form">
            <input type="text" name="search_box" placeholder=".. عن ماذا تبحث" required maxlength="100">
            <button type="submit" class="fas fa-search" name="search_box"></button>
        </form> -->

        <a href="{{ url('/dashboard') }}" class="logo"><img src="{{ asset('assets/images/spark.png') }}"
                alt="spark education"></a>

        <div class="profile">
            <img src="{{ asset('assets/images/pic-1.jpg') }}" alt="">
            <h3>{{ Auth::user()->Name }}</h3>
            <span>{{ trans('Teacher_trans.teacher') }}</span>
            <div class="flex-btn">
                <br>
                <a href="loginTeacher.html" class="option-btn">{{ trans('Teacher_trans.logout') }}</a>
            </div>
        </div>
    </section>
</header> --}}
