@extends('layouts.admin')

@section('content')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{__('Register a race')}}</div>

    @can('dashboard.races.index')
    <a href="{{ route('dashboard.races.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{__('Races list')}}
    </a>
    @endcan

</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::open(['route' => 'dashboard.races.store']) !!}
        @include('dashboard.races.fields_create')
        {!! Form::close() !!}
        @include('dashboard.species.modal')
    </div>
</div>



@endsection