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
                    <th>{{ __('update ago') }}</th>

                    <th>{{ __('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->pet_id }}</td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->specie ? $pet->specie->name : __('Specie undefined') }}</td>
                    <td>{{ $pet->published == 1 ? __('Yes') : __('No') }}</td>
                    <td>{{ $pet->user_id ?? __('Owner undefined') }}</td>

                    <td>{{ $pet->updated_at->diffForHumans() }}</td>
                    <td class="flex items-center justify-center space-x-1">
                        @can('dashboard.reports.show')
                        <button>
                            <a href="{{ route('dashboard.reports.show', $pet) }}">
                                <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i> </a>
                        </button>
                        @endcan
                        @can('dashboard.reports.edit')
                        <button>
                            <a href="{{ route('dashboard.reports.edit', $pet) }}" class='btn btn-link'>
                                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                            </a>
                        </button>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts_lib')
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
@endpush