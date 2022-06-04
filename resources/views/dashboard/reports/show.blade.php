@extends('layouts.admin')

@push('css')
<link rel="stylesheet" href="{{asset('css/flowbite.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Showing data report pet') }}</div>
    @can('dashboard.reports.index')
    <a href="{{ route('dashboard.reports.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{ __('Reports list') }}
    </a>
    @endcan
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-flash-messages />
        @include('dashboard.reports.show_fields')
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/flowbite.js') }}"></script>
<script src="{{ asset('js/alpine.min.js') }}"></script>
@livewireScripts
@endpush