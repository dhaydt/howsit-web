<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.3.1.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/agora-rtc-sdk@3.6.11/AgoraRTCSDK.min.js"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<style>
    #app>.py-4 {
        padding: 0 0 !important;

    }

    .navbar>.container {
        padding: 0;
    }

    .navbar>.container>.nav-logo {
        margin-left: 30px;
    }

    #navbarSupportedContent>ul.navbar-nav.ml-auto>li:nth-child(3) {
        margin-right: 30px;
    }

    #navbarSupportedContent>ul.navbar-nav.ml-auto>li:nth-child(2)>a>i {
        font-size: 26px !important;
        line-height: 1.5;
        margin-right: 20px;
    }

    .container .col {
        width: 100%;
        padding: 0 0;
    }

    .alert {
        position: fixed;
        top: 60px;
        right: 0;
        font-weight: 600;
        color: #000;
        width: fit-content;
        text-align: left;
        z-index: 2;
    }

    .alert-danger {
        background-color: #f9d6d5b8;
        text-transform: capitalize;
    }

    .alert-success {
        background-color: #58f89c;
        text-transform: capitalize;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-light bg-lights shadow fixed-top">
            <div class="container">
                <a class="navbar-brand nav-logo" href="{{ url('/') }}">
                    <img class="nav-log" src="{{ asset('css/howsit2.png') }}" width="30" height="30">
                    <span class="nav-brand">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <div class="navs mx-auto">
                    <ul class="navbar-nav nav-ul">
                        <li class="{{ Request::segment(1) === 'home' ? 'active' : null }} navbar-item nav-li">
                            <a class="nav-link nav-a" aria-current="page" href="{{ url('home') }}">
                                <i class="fas fa-home nav-i"></i>
                            </a>
                        </li>
                        <li class="{{ Request::segment(1) === 'agora-chat' ? 'active' : null }} navbar-item nav-li">
                            <a class="nav-link nav-a" href="{{ url('/agora-chat') }}">
                                <i class="fas fa-video nav-i"></i>
                            </a>
                        </li>
                        <li class="{{ Request::segment(1) === 'messenger' ? 'active' : null }} navbar-item nav-li">
                            <a class="nav-link nav-a" href="{{ url('/messenger') }}">
                                <i class="fas fa-comments nav-i"></i>
                            </a>
                        </li>
                        <li class="{{ Request::segment(1) === 'info' ? 'active' : null }} navbar-item nav-li">
                            <a class="nav-link nav-a" href="{{ url('/info') }}">
                                <i class="fas fa-exclamation-triangle nav-i"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto mb-lg-0">

                    </ul>

                    <div class="accordion accordion-flush d-sm-none" id="accordionFlushExample">
                        <div class="accordion-item">
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <h2 class="accordion-header p-4" id="flush-headingTwo">
                                <button class="accordion-button collapsed p-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <div class="img-user-div me-2">
                                        <img class="usr-img mt-0"
                                            src="{{ url('/images/profile/' . Auth::user()->profile_image) }}" alt="">
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body pt-0">
                                    <li>
                                        <a class="dropdown-item mb-0" href="{{ url('profile') }}">
                                            <div class="rounded-bg">
                                                <i class="fas fa-user text-center"></i>
                                            </div>
                                            <p>Profile</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item mb-0" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                                                                document.getElementById('logout-form').submit();">
                                            <div class="rounded-bg">
                                                <i class="fas fa-door-open text-center"></i>
                                            </div>
                                            <p>{{ __('Logout') }}</p>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </div>
                            </div>
                        </div>
                        @can('admin-list')
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingAdmin">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseAdmin" aria-expanded="false"
                                    aria-controls="flush-collapseAdmin">
                                    <div class="rounded-bg">
                                        <i class="fas fa-user-cog text-center"></i>
                                    </div>
                                    <span>Admin Menu</span>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="flush-collapseAdmin"
                                aria-labelledby="flush-headingAdmin" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/admin') }}" style="margin-top: 15px;">
                                            <div class="rounded-bg">
                                                <i class="fas fa-users-cog"></i>
                                            </div>
                                            <p>Admin Panel</p>
                                        </a>
                                    </li>
                                </div>
                            </div>
                        </div>
                        @endcan
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <div class="rounded-bg">
                                        <i class="fas fa-concierge-bell text-center"></i>
                                    </div>
                                    {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
                                    <span>Notification</span>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <li>
                                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                                            <span class="float-right text-muted text-sm">3 mins</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-users mr-2"></i> 8 friend requests
                                            <span class="float-right text-muted text-sm">12 hours</span>
                                        </a>

                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-file mr-2"></i> 3 new reports
                                            <span class="float-right text-muted text-sm">2 days</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                                    </li>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    <div class="rounded-bg">
                                        <i class="fas fa-caret-down text-center"></i>
                                    </div>
                                    Menu
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul>
                                        <a class="dropdown-item" href="{{ url('/setting') }}" style="margin-top: 15px;">
                                            <div class="rounded-bg">
                                                <i class="fas fa-cog"></i>
                                            </div>
                                            <p>Setting</p>
                                        </a>
                                        <a class="dropdown-item" href="{{ url('/group') }}">
                                            <div class="rounded-bg">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <p>Groups</p>
                                        </a>
                                        <a class="dropdown-item" href="{{ url('/furnite') }}">
                                            <div class="rounded-bg">
                                                <i class="fas fa-user-plus"></i>
                                            </div>
                                            <p>Add Friend</p>
                                        </a>
                                        <div class="half-border"></div>
                                        <a class="dropdown-item" href="{{ url('/help') }}">
                                            <div class="rounded-bg">
                                                <i class="fas fa-question-circle"></i>
                                            </div>
                                            <p>Help</p>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endguest

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto mb-lg-0" style="align-items: center;">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <div class="admin-panel align-items-center">
                        @can('admin-list')
                        <a class="admin-a" href="{{ url('/feeds') }}">
                            <p class="mb-0">Admin Panel</p>
                        </a>
                        @endcan
                    </div>
                    <div class="user-div">
                        <a class="user-a" href="{{ url('profile') }}" style="display: flex;">
                            <div class="img-user-div">
                                <img class="usr-img" src="{{ url('/images/profile/' . Auth::user()->profile_image) }}"
                                    alt="">
                            </div>
                            <div class="name-user-div">
                                <li class="user-li">
                                    {{ Auth::user()->name }}
                                </li>
                            </div>
                        </a>
                    </div>

                    {{-- <notify-item :userid="{{ auth()->id() }}":unreads="{{ auth()->user()->unreadNotifications }}">
                    </notify-item> --}}

                    <li class="nav-item dropdown dropdown-slide dropdown-hover">
                        <a id="navbarDropdown text-center" class="drop nav-link" href="#" role="button"
                            data-bs-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false" v-pre>
                            <i class="fas fa-caret-down" style="margin-left: 3px; font-size: 28px;"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end dropdown-menu-sm-end"
                            aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ url('/setting') }}" style="margin-top: 15px;">
                                <div class="rounded-bg">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <p>Setting</p>
                            </a>
                            {{-- <a class="dropdown-item" href="{{ url('/group') }}">
                            <div class="rounded-bg">
                                <i class="fas fa-users"></i>
                            </div>
                            <p>Groups</p>
                            </a> --}}
                            <a class="dropdown-item" href="{{ url('/furnite') }}">
                                <div class="rounded-bg">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <p>Add Friend</p>
                            </a>
                            <div class="half-border"></div>
                            <a class="dropdown-item" href="{{ url('/help') }}">
                                <div class="rounded-bg">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <p>Help</p>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                        document.getElementById('logout-form').submit();">
                                <div class="rounded-bg">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <p>{{ __('Logout') }}</p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>


        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script>
    {{-- $(function() {
            var $elmt = $(this);

            setInterval(function() {
                scrollText($elmt);
            }, 15);

            var scrollText = function($elmt) {
                var left = $elmt.find('.user-li').position().left - 1;
                left = -left > $elmt.find('.user-li').width() ? $elmt.width() : left;
                $elmt.find('.user-li').css({
                    left: left
                });
            };
        }); --}}
</script>

</html>