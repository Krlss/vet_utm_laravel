@extends('layouts.admin')

@section('content')
@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush
@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Pets list') }}</div>
    @can('dashboard.pets.create')
    <a href="{{ route('dashboard.pets.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 hover:no-underline ">
        {{ __('Add pet') }}
    </a>
    @endcan
</div>
@endsection
<div class="card">
    <div class="card-body">

        <x-flash-messages />

        <table id="table" class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Pet ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Castrated') }}</th>
                    <th>{{ __('Lost') }}</th>
                    <th>{{ __('Species') }}</th>
                    <th>{{ __('Owner') }}</th>
                    <th>{{ __('Updated ago') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts_lib')
@include('dashboard.pets.datatable')
@endpush