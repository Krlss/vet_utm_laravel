@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{trans('lang.show_pet')}}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">
        @can('dashboard.pets.index')
        <a href="{{ route('dashboard.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.list_pets')}}
        </a>
        @endcan
        @can('dashboard.pets.create')
        <a href="{{ route('dashboard.pets.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.createPet')}}
        </a>
        @endcan
    </div>
</div>
@endsection

<div class="card">
    <div class="card-body">
        @include('dashboard.pets.show_fields')
    </div>
</div>

@endsection