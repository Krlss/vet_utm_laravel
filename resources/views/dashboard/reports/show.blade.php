@extends('layouts.admin')

@section('content')

@section('content_header')
    <div class="flex justify-between items-center">
        <div class="text-lg font-bold">{{trans('lang.show_pet_lost')}}</div>
        <a href="{{ route('dashboard.reports.index') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.list_pets_lost')}}
        </a>
    </div>
@endsection

<div class="card">
    <div class="card-body">
        @include('dashboard.reports.show_fields')
    </div>
</div>

@endsection
