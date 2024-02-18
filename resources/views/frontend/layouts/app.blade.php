<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title data-title="{{ env('APP_NAME') }}">{{ env('APP_NAME') }}</title>

    <!-- icon -->
    <link rel="icon" href="{{ asset('assets/vendor/img/logo.png') }}" type="image/*" sizes="16x16">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Url Path -->
    <meta name="server-path" content="{{ url('/') }}">
    <!-- Asset Path -->
    <meta name="assets-path" content="{{ asset() }}">

    @auth
        <!-- Auth ID-->
        <meta name="auth_id" content="{{ auth()->id() }}">
        <meta name="encrypted_auth_id" content="{{ encrypt(auth()->id()) }}">
    @endauth()


    {{-- Theme css libraury --}}
    @include('frontend.css.theme-css')

    {{-- customes css file include  --}}
    @include('frontend.css.custom-css')


    @yield('styles')

</head>

<body class="page-has-left-panels page-has-right-panels">
    @include('frontend.partials.preloader')
    @include('frontend.partials.left-sidebar')
    @include('frontend.partials.right-sidebar')
    @include('frontend.partials.header')

    <!-- ... end Responsive Header-BP -->
    <div class="header-spacer"></div>

    <div class="container">
        <div class="row">
            @yield('body')
        </div>
    </div>


    {{-- Theme scripts libraury --}}
    @include('frontend.js.theme-script')

    {{-- customes scripts file include  --}}
    @include('frontend.js.custom-script')

    @yield('scripts')

</body>

</html>
