@extends('layouts.admin')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">

@can('dashboard.species.create')
<link rel="stylesheet" href="{{asset('css/flowbite.min.css')}}">
@endcan

@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{ __('Edit data a race') }}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">

        @can('dashboard.races.index')
        <a href="{{ route('dashboard.races.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ __('Races list') }}
        </a>
        @endcan

        @can('dashboard.races.create')
        <a href="{{ route('dashboard.races.create') }}" class="bg-yellow-300 hover:bg-yellow-500 text-white p-2 rounded-md font-semibold px-4 ">
            {{ __('Add race') }}
        </a>
        @endcan


    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::model($race, ['route' => ['dashboard.races.update', $race], 'autocomplete' => 'off', 'method' => 'put']) !!}
        @include('dashboard.races.fields')
        {!! Form::close() !!}
        @include('dashboard.species.modal')
    </div>
</div>

@endsection