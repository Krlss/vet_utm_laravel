@extends('layouts.admin')

@section('content')
@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush
@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Reports list') }}</div>
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
                    <th>{{ __('Species') }}</th>
                    <th>{{ __('Published') }}</th>
                    <th>{{ __('Owner') }}</th>
                    <th>{{ __('Updated ago') }}</th>

                    <th>{{ __('Actions')}}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts_lib')
@include('dashboard.reports.datatable')
@endpush