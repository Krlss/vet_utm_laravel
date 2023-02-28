@extends('adminlte::page')

@section('title', 'Dashboard')

@section('footer')
<div class="float-right d-none d-md-block">
    <b>Version</b> 1.0.0
</div>
<strong>Copyright © Facultad de Ciencias informáticas UTM.</strong> Todos los derechos reservados.
@endsection
@section('css')
<link rel="stylesheet"  href="{{ asset('css/app.css') }}">
@stop

@section('js')
@livewireScripts
<script>
    window.onload = () => {
        document.querySelector("html").style.overflowX = "hidden";
    }
    $('form').submit(function(event) {
        if ($(this).hasClass('submitted')) {
            event.preventDefault();
        } else {
            if ($(this).find(':submit').hasClass('save')) {
                $(this).find(':submit').html('Cargando... <i class="fa fa-spinner fa-spin"></i>');
            } else {
                $(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
            }
            $(this).find(':submit').prop('disabled', true);
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