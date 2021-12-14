@extends('layouts.admin')

@section('content')

@section('content_header')
    <div class="flex justify-between items-center">
        <div class="text-lg font-bold">{{trans('lang.pet_registration')}}</div>
        <a href="{{ route('dashboard.reports.index') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.list_pets')}}
        </a>
    </div>
@endsection

<div class="card">
    <div class="card-body">

        @if (session('error'))
            <div class="alert alert-danger">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        {!! Form::open(['route' => 'dashboard.reports.store']) !!}
        @include('dashboard.reports.fields_create')
        {!! Form::close() !!}
    </div>
</div>



@endsection
