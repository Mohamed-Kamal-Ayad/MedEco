<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>{{ $title ? $title .' | '. app_name() : app_name() }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="PUSHER_APP_KEY" content="{{ config('broadcasting.connections.pusher.key') }}">
        <meta name="PUSHER_APP_CLUSTER" content="{{ config('broadcasting.connections.pusher.options.cluster') }}">
        <meta name="PUSHER_APP_HOST" content="{{ config('broadcasting.connections.pusher.options.host') }}">
        <meta name="PUSHER_APP_PORT" content="{{ config('broadcasting.connections.pusher.options.port') }}">

        <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon" />

        <!-- Styles -->
        @if(Locales::getDir() == 'rtl')
            <link rel="stylesheet" href="{{ asset('/css/app.rtl.css') }}">
        @else
            <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        @endif
    </head>
    <body class="{{ $bodyClass ?? '' }}">
        <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom py-3">
            <div class="container">
                <a class="navbar-brand mr-0" href="{{ url('/') }}">
                    <img src="{{ app_logo() }}" width="60px" alt="{{ app_name() }}">
                </a>

                @auth
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ auth()->user()->getAvatar() }}" alt="{{ auth()->user()->name }}" class="rounded-circle" width="30">
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        @lang('dashboard.auth.logout')
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @else
                    <ul class="navbar-nav mr-0 pr-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <button class="btn btn-login">
                                    @lang('dashboard.auth.login.submit')
                                </button>
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>
        </nav>

        @yield('content')
    </body>
</html>
