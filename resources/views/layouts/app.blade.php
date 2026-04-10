<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Laravel 11 Starter">
    <meta name="keywords" content="Laravel 11 Starter">
    <meta name="author" content="Alief">
    <link rel="icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <title>{{ config('app.name') }}</title>
    <meta content="{{ url('/') }}/" name="base-url" />
    <meta content="{{ config('app.theme') }}" name="asset-url" />
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <meta content="{{ session('role_name') }}" name="role-name">
    <meta content="{{ $activeSlug }}" name="active-slug">

    @include('layouts.components.plugins')
    @include('layouts.components.app-styles')

    @stack('styles')
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start       -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <div class="logo-wrapper"><a href="#"><img class="img-fluid"
                                src="../assets/images/logo/logo.png" alt=""></a></div>
                    <div class="dark-logo-wrapper"><a href="#"><img class="img-fluid"
                                src="../assets/images/logo/dark-logo.png" alt=""></a></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center"
                            id="sidebar-toggle"></i></div>
                </div>
                <div class="nav-right col pull-right right-menu p-0">
                    <ul class="nav-menus">
                        {{-- Impersonate --}}
                        @if (@$isImpersonating)
                            <li>
                                <a href="{{ route('impersonate.stop') }}" class="btn btn-sm btn-danger">Stop
                                    Impersonate :
                                    <strong>{{ Auth::user()->name }}</strong></a>
                            </li>
                        @endif
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    data-feather="maximize"></i></a></li>
                        <li>
                            <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span>
                            </div>
                        </li>
                        <li>
                            <div class="mode"><i class="fa fa-moon-o"></i></div>
                        </li>
                        @if (session('multi_role'))
                            <li>
                                <a href="{{ route('select-role') }}" class="btn btn-secondary">Ganti Otoritas</a>
                            </li>
                        @endif
                        <li class="onhover-dropdown p-0">

                            <a href="#"
                                onclick="
                                sessionStorage.removeItem('menu_data');
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                                ">
                                <button class="btn btn-primary-light" type="button">
                                    <i data-feather="log-out"></i>
                                    Log out
                                </button>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            <header class="main-nav">
                <div class="sidebar-user text-center">
                    <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6>
                    <p class="mb-0 font-roboto">{{ session('role_name') }}</p>
                </div>
                <nav>
                    <div class="main-navbar">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="mainnav">
                            <ul class="nav-menu custom-scrollbar">
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </div>
                </nav>
            </header>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>{{ $title ?? config('app.name') }}</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                    @if ($title)
                                        <li class="breadcrumb-item active">{{ $title }}</li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid dashboard-default-sec">
                    @yield('contents', '')
                </div>
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2021-22 © viho All rights reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="pull-right mb-0">Hand crafted & made with <i
                                    class="fa fa-heart font-secondary"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @include('layouts.components.app-scripts')

    @stack('scripts-plugins')
    @stack('scripts')


</body>

</html>
