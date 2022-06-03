@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between lg:items-center items-start lg:flex-row flex-col">

    <div class="text-lg font-bold">{{ __('Editing data report pet') }}</div>

    <a href="{{ route('dashboard.reports.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{ __('Reports list') }}
    </a>

</div>
@endsection

<div class="card">
    <div class="card-body">

        <x-flash-messages />

        {!! Form::model($pet, ['route' => ['dashboard.reports.update', $pet], 'autocomplete' => 'off', 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
        @include('dashboard.reports.fields')
        {!! Form::close() !!}

        @include('dashboard.species.modal')
        @include('dashboard.races.modal')
        @include('dashboard.furs.modal')

    </div>
</div>



@endsection