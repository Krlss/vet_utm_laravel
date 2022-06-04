@extends('layouts.admin')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/flowbite.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Registration a pet') }}</div>
    <a href="{{ route('dashboard.pets.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{ __('Pets list') }}
    </a>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.pets.store', 'enctype' => 'multipart/form-data']) !!}
        @include('dashboard.pets.fields_create')
        {!! Form::close() !!}

        @include('dashboard.species.modal')
        @include('dashboard.races.modal')
        @include('dashboard.furs.modal')
    </div>
</div>
@endsection