@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{__('Register a fur')}}</div>

    @can('dashboard.furs.index')
    <a href="{{ route('dashboard.furs.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{__('Furs list')}}
    </a>
    @endcan


</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.furs.store']) !!}
        @include('dashboard.furs.fields_create')
        {!! Form::close() !!}
    </div>
</div>



@endsection