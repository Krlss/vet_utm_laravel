@extends('layouts.admin')

@section('content')
@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush
@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ trans('lang.list_species') }}</div>

    @can('dashboard.species.create')
    <a href="{{ route('dashboard.species.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 hover:no-underline ">
        {{ trans('lang.createSpecie') }}
    </a>
    @endcan

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

        <table id="table" class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('lang.id') }}</th>
                    <th>{{ trans('lang.name') }}</th>
                    <th>{{ trans('lang.created_at') }}</th>
                    <th>{{ trans('lang.updated_at') }}</th>

                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($species as $specie)
                <tr>
                    <td>{{ $specie->id }}</td>
                    <td>{{ $specie->name }}</td>

                    <td>{{ $specie->updated_at->diffForHumans() }}</td>
                    <td>{{ $specie->updated_at->diffForHumans() }}</td>

                    <td class="flex items-center justify-center space-x-3">

                        @can('dashboard.species.edit')
                        <button>
                            <a href="{{ route('dashboard.species.edit', $specie) }}" class=''>
                                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                            </a>
                        </button>
                        @endcan

                        @can('dashboard.species.destroy')
                        {!! Form::open(['route' => ['dashboard.species.destroy', $specie], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
                        'type' => 'submit',
                        'class' => '',
                        'onclick' => "return confirm('Estás seguro que deseas eliminar a $specie->name')",
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