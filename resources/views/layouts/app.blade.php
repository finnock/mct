<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Meta Tags --}}
    <meta name="description" content="Collection tracker application for the trading card game magic the gathering. Not associated with wizards of the coast or magic tm.">
    <meta name="author" content="Jan Oechsler">

    {{-- CSRF Roken --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'MCT' }}</title>

    {{-- Complete Stylesheet Compiled Using Webpack --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

@yield('vue-storage')

<div id="app">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="ss ss-zen" style="font-size: 30px;">&nbsp;</i>&nbsp;<span class="mtg-font" style="display: inline-block; transform: scale(1.5);">MCT</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        @yield('nav')
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('collection.index') }}" class="dropdown-item">
                                    <i class="fa fa-cube mr-2"></i>
                                    Collection
                                </a>
                                <a href="{{ route('collection.add') }}" class="dropdown-item">
                                    <i class="fa fa-plus mr-2"></i>
                                    Add Cards
                                </a>
                                <a href="{{ route('collection.add-batch') }}" class="dropdown-item">
                                    <i class="fa fa-paste mr-2"></i>
                                    Add Cardbatch
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('dashboard') }}" class="dropdown-item">
                                    <i class="fa fa-pie-chart mr-2"></i>
                                    Dashboard
                                </a>
                                <a href="#" class="dropdown-item disabled">
                                    <i class="fa fa-address-card mr-2"></i>
                                    Profile
                                </a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out mr-2"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>

    <div class="container{{ ($fullscreen ?? false) ? '-fluid' : '' }}" id="container">
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')

</body>
</html>
