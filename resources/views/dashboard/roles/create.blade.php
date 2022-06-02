@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Register a role') }}</div>
    <a href="{{ route('dashboard.roles.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{ __('Roles list') }}
    </a>
</div>
@endsection
<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.roles.store']) !!}
        <div class="row">
            @include('dashboard.roles.fields')
        </div>
        {!! Form::close() !!}
        <div class="clearfix"></div>

    </div>
</div>
@endsection