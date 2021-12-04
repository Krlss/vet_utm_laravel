@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    @yield('content_header')
@stop

@section('content')
    @yield('content')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css_lib')
@stop

@section('js')
    @stack('scripts_lib')
@stop
