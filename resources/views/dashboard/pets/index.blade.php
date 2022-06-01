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
                @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->pet_id }}</td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->castrated == 1 ? __('Yes') : __('No') }}</td>
                    <td>{{ $pet->lost == 1 ? __('Yes') : __('No') }}</td>
                    <td>{{ $pet->specie ? $pet->specie->name : __('Specie undefined') }}</td>
                    <td>{{ $pet->user_id ?? __('Owner undefined') }}</td>

                    <td>{{ $pet->updated_at->diffForHumans() }}</td>
                    <td class="flex items-center justify-center space-x-3">
                        @can('dashboard.pets.show')
                        <button>
                            <a href="{{ route('dashboard.pets.show', $pet) }}">
                                <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                            </a>
                        </button>
                        @endcan
                        @can('dashboard.pets.edit')
                        <button>
                            <a href="{{ route('dashboard.pets.edit', $pet) }}" class=''>
                                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                            </a>
                        </button>
                        @endcan
                        @can('dashboard.pets.destroy')
                        {!! Form::open(['route' => ['dashboard.pets.destroy', $pet], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
                        'type' => 'submit',
                        'class' => '',
                        'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name')",
                        ]) !!}
                        {!! Form::close() !!}
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