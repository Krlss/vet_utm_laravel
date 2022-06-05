@extends('layouts.admin')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/flowbite.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{__('Edit data a user')}}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">
        @can('dashboard.users.index')
        <a href="{{ route('dashboard.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 truncate">
            {{__('Users list')}}
        </a>
        @endcan
        @can('dashboard.users.create')
        <a href="{{ route('dashboard.users.create') }}" class="bg-yellow-300 hover:bg-yellow-500 text-white p-2 rounded-md font-semibold px-4 truncate">
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

        {!! Form::model($user, ['route' => ['dashboard.users.update', $user], 'autocomplete' => 'off', 'method' => 'put']) !!}
        @include('dashboard.users.fields')
        {!! Form::close() !!}

        @if($lettersAvailable)
        @include('dashboard.provinces.modal')
        @endif

        @include('dashboard.cantons.modal_user')
        @include('dashboard.parishs.modal')
        @include('dashboard.roles.modal')

    </div>

</div>
</div>
@endsection