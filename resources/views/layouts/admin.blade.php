@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@yield('content_header')
@stop

@section('content')
@yield('content')
@stop

@section('footer')
<div class="float-right d-none d-md-block">
    <b>Version</b> 1.0.0
</div>
<strong>Copyright © Facultad de Ciencias informáticas UTM.</strong> Todos los derechos reservados.
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.3/dist/flowbite.min.css" />
@stack('css_lib')
@stop

@section('js')
@stack('scripts_lib')
<script src="https://unpkg.com/flowbite@1.4.3/dist/flowbite.js"></script>
<script>
    window.onload = () => {
        document.querySelector("html").style.overflowX = "hidden";
    }
    $('form').submit(function(event) {
        if ($(this).hasClass('submitted')) {
            event.preventDefault();
        } else {
            $(this).find(':submit').html('Cargando... <i class="fa fa-spinner fa-spin"></i>');
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
</script>
@stop