@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{ __('Register a parish') }}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">

        @can('dashboard.parishs.index')
        <a href="{{ route('dashboard.parishs.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ __('Parishs list') }}
        </a>
        @endcan

    </div>
</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.parishs.store', 'autocomplete' => 'off']) !!}
        @include('dashboard.parishs.fields')
        {!! Form::close() !!}

        @can('dashboard.cantons.create')
        @include('dashboard.cantons.modal', ['provinces' => $provinces])
        @endcan

    </div>
</div>

@endsection