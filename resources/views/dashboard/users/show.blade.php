@extends('layouts.admin')

@push('css')
<link rel="stylesheet" href="{{asset('css/flowbite.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{__('User data')}}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">
        @can('dashboard.users.index')
        <a href="{{ route('dashboard.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{__('Users list')}}
        </a>
        @endcan
        @can('dashboard.users.create')
        <a href="{{ route('dashboard.users.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-md font-semibold px-4 ">
            {{__('Add user')}}
        </a>
        @endcan
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-flash-messages />

        @include('dashboard.users.show_fields')
    </div>
</div>
@endsection