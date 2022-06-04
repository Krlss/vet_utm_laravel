@extends('layouts.admin')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/flowbite.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{ __('Editing data pet') }}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">
        @can('dashboard.pets.index')
        <a href="{{ route('dashboard.pets.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ __('Pets list') }}
        </a>
        @endcan
        @can('dashboard.pets.create')
        <a href="{{ route('dashboard.pets.create') }}" class="bg-yellow-300 hover:bg-yellow-500 text-white p-2 rounded-md font-semibold px-4 ">
            {{ __('Add pet') }}
        </a>
        @endcan
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::model($pet, ['route' => ['dashboard.pets.update', $pet], 'autocomplete' => 'off', 'method' => 'put','enctype' => 'multipart/form-data']) !!}
        @include('dashboard.pets.fields')
        {!! Form::close() !!}

        @include('dashboard.species.modal')
        @include('dashboard.races.modal')
        @include('dashboard.furs.modal')
    </div>
</div>
@endsection