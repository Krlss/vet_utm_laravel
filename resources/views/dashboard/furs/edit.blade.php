@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{__('Edit data fur')}}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">

        @can('dashboard.furs.index')
        <a href="{{ route('dashboard.furs.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{__('Furs list')}}
        </a>
        @endcan

        @can('dashboard.furs.create')
        <a href="{{ route('dashboard.furs.create') }}" class="bg-yellow-300 hover:bg-yellow-500 text-white p-2 rounded-md font-semibold px-4 ">
            {{__('Add fur')}}
        </a>
        @endcan

    </div>
</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::model($fur, ['route' => ['dashboard.furs.update', $fur], 'autocomplete' => 'off', 'method' => 'put']) !!}
        @include('dashboard.furs.fields')
        {!! Form::close() !!}

        @include('dashboard.species.modal')


    </div>
</div>

@endsection