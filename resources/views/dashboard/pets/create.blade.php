@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{trans('lang.pet_registration')}}</div>
    <a href="{{ route('dashboard.pets.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{trans('lang.list_pets')}}
    </a>
</div>
@endsection

<div class="card">
    <div class="card-body">

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
        @endif

        @if (session('info'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('info') }}
        </div>
        @endif

        {!! Form::open(['route' => 'dashboard.pets.store', 'enctype' => 'multipart/form-data']) !!}
        @include('dashboard.pets.fields_create')
        {!! Form::close() !!}
    </div>
</div>



@endsection