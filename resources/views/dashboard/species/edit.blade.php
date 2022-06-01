@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{trans('lang.edit_specie')}}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">

        @can('dashboard.species.index')
        <a href="{{ route('dashboard.species.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.list_species')}}
        </a>
        @endcan

        @can('dashboard.species.create')
        <a href="{{ route('dashboard.species.create') }}" class="bg-yellow-300 hover:bg-yellow-500 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.createSpecie')}}
        </a>
        @endcan


    </div>
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

        {!! Form::model($specie, ['route' => ['dashboard.species.update', $specie], 'autocomplete' => 'off', 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
        @include('dashboard.species.fields')
        {!! Form::close() !!}
    </div>
</div>

@endsection