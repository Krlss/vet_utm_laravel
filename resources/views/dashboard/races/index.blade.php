@extends('layouts.admin')

@section('content')
@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush
@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Races list') }}</div>

    @can('dashboard.races.create')
    <a href="{{ route('dashboard.races.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 hover:no-underline ">
        {{ __('Add race') }}
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
                    <th>{{ __('Race ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Species') }}</th>
                    <th>{{ __('Created ago') }}</th>
                    <th>{{ __('Updated ago') }}</th>

                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($races as $race)
                <tr>
                    <td>{{ $race->id }}</td>
                    <td>{{ $race->name }}</td>
                    <td>{{ $race->specie ? $race->specie->name : __('Specie undefined') }}</td>
                    <td>{{ $race->updated_at->diffForHumans() }}</td>
                    <td>{{ $race->updated_at->diffForHumans() }}</td>

                    <td class="flex items-center justify-center space-x-3">

                        @can('dashboard.races.edit')
                        <button>
                            <a href="{{ route('dashboard.races.edit', $race) }}" class=''>
                                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                            </a>
                        </button>
                        @endcan

                        @can('dashboard.races.destroy')
                        {!! Form::open(['route' => ['dashboard.races.destroy', $race], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
                        'type' => 'submit',
                        'class' => '',
                        'onclick' => "return confirm('Estás seguro que deseas eliminar a $race->name')",
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