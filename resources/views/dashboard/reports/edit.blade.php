@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between lg:items-center items-start lg:flex-row flex-col">

    <div class="text-lg font-bold">{{ trans('lang.edit_pet_report') }}</div>

    <a href="{{ route('dashboard.reports.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{ trans('lang.list_pets_lost') }}
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

        {!! Form::model($pet, ['route' => ['dashboard.reports.update', $pet], 'autocomplete' => 'off', 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
        @include('dashboard.reports.fields')
        {!! Form::close() !!}

    </div>
</div>



@endsection