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
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.3/dist/flowbite.min.css" />
@stack('css_lib')
@stop

@section('js')
@stack('scripts_lib')
<script src="https://unpkg.com/flowbite@1.4.3/dist/flowbite.js"></script>
<script>
    $('form').submit(function(event) {
        if ($(this).hasClass('submitted')) {
            event.preventDefault();
        } else {
            $(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
            $(this).addClass('submitted');
        }
    });
    $("#email_verificate").on("click", function() {
        if ($(this).hasClass('submitted')) {
            event.preventDefault();
        } else {
            $(this).prop("disabled", true);
        }
    });

    $(document).ready(function() {
        $(".d-md-inline") && $(".d-md-inline").removeClass('d-md-inline');
    });
</script>
@stop