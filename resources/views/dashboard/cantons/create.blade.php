@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{ __('Register a canton') }}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">

        @can('dashboard.cantons.index')
        <a href="{{ route('dashboard.cantons.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ __('Cantons list') }}
        </a>
        @endcan

    </div>
</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.cantons.store', 'autocomplete' => 'off']) !!}
        @include('dashboard.cantons.fields')
        {!! Form::close() !!}
    </div>
</div>

@endsection