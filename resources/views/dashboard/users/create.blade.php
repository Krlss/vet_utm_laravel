@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{__('Creating a user')}}</div>
    <a href="{{ route('dashboard.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{__('Users list')}}
    </a>
</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.users.store']) !!}
        @include('dashboard.users.fields_create')
        {!! Form::close() !!}
    </div>
</div>



@endsection