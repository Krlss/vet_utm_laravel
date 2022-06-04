@extends('layouts.admin')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Parishs list') }}</div>

    @can('dashboard.parishs.create')
    <a href="{{ route('dashboard.parishs.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 hover:no-underline ">
        {{ __('Add parish') }}
    </a>
    @endcan

</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-flash-messages />

        <table id="table" class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Province') }}</th>
                    <th>{{ __('Canton') }}</th>
                    <th>{{ __('Created ago') }}</th>
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

@push('js')
@include('dashboard.parishs.datatable')
@endpush