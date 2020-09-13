<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
    @section('header')
    @include('layouts.partials.header-scripts')
    @show
</head>
@include('layouts.partials.nav')
@yield('content')
@include('layouts.partials.footer')
@section('footer')
@include('layouts.partials.footer-scripts')
@show
</body>