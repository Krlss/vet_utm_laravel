@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{__('Register a species')}}</div>

    @can('dashboard.species.index')
    <a href="{{ route('dashboard.species.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{ __('Species list') }}
    </a>
    @endcan

</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.species.store', 'enctype' => 'multipart/form-data']) !!}
        @include('dashboard.species.fields_create')
        {!! Form::close() !!}

        @include('dashboard.furs.modal')
    </div>
</div>



@endsection