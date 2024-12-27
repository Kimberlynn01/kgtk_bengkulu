<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Laravel 11 Starter">
    <meta name="keywords" content="Laravel 11 Starter">
    <meta name="author" content="Alief">
    <link rel="icon" href="{{asset('assets')}}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon.png" type="image/x-icon">
    <title>{{ config('app.name') }}</title>
    <!-- Google font-->
    @include('layouts.components.guest-styles')

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
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7">
                    <img class="bg-img-cover bg-center" src="{{asset('assets')}}/images/login/2.jpg" alt="looginpage">
                </div>
                <div class="col-xl-5 p-0">
                    @yield('contents', '')
                </div>
            </div>
        </div>
    </section>
    <!-- page-wrapper end-->

    @include('layouts.components.guest-scripts')

    @stack('scripts')
</body>

</html>