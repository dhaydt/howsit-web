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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        $(function() {
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
        });

    </script>
</head>
<style>
    #app>.py-4 {
        min-height: 80vh;
        padding: 0 0 !important;
        margin: 0 0 !important;
    }

    .navbar>.container {
        padding: 0 !important;
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

</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-yellow shadow-sm">
            <div class="container">
                <a class="navbar-brand nav-logo" href="{{ url('/') }}">
                    <img class="nav-log" src="{{ asset('css/howsit2.png') }}" width="30" height="30">
                    <span class="nav-brand"
                        style="padding: 15px 10px 0 20px;">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <div class="navs">
                    <ul class="nav-ul">
                        <li class="nav-li">
                            <a class="nav-link nav-a" href="{{ url('/home') }}">
                                <i class="fas fa-home nav-i"></i>
                            </a>
                        </li>
                        <li class="nav-li">
                            <a class="nav-link nav-a" href="{{ url('/agora-chat') }}">
                                <i class="fas fa-video nav-i"></i>
                            </a>
                        </li>
                        <li class="nav-li">
                            <a class="nav-link nav-a" href="{{ url('/messenger') }}">
                                <i class="fas fa-comments nav-i"></i>
                            </a>
                        </li>
                        <li class="nav-li">
                            <a class="nav-link nav-a" href="{{ url('/info') }}">
                                <i class="fas fa-exclamation-triangle nav-i"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="align-items: center;">
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
                            <div class="user-div">
                                <a class="user-a" href="{{ url('profile') }}" style="display: flex;">
                                    <div class="img-user-div">
                                        <img class="usr-img"
                                            src="{{ url('/images/profile/' . Auth::user()->profile_image) }}" alt="">
                                    </div>
                                    <div class="name-user-div">
                                        <li class="user-li">
                                            {{ Auth::user()->name }}
                                        </li>
                                    </div>
                                </a>
                            </div>

                            <!-- Notifications Dropdown Menu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    <i class="far fa-bell" style="font-size: 20px;"></i>
                                    {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
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
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="drop nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @can('admin-list')
                                        <a class="dropdown-item" href="{{ url('/admin') }}" style="margin-top: 15px;">
                                            <div class="rounded-bg">
                                                <i class="fas fa-users-cog"></i>
                                            </div>
                                            <p>Admin Panel</p>
                                        </a>
                                    @endcan
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
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

</html>
