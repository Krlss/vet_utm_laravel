@extends('layouts.admin')

@section('content')
@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush
@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ trans('lang.role_table') }}</div>
    <div class="flex items-center justify-between space-x-2">
        @can('dashboard.permissions')
        <a href="{{ route('dashboard.permissions.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ trans('lang.permission_look') }}
        </a>
        @endcan
        @can('dashboard.roles.create')
        <a href="{{ route('dashboard.roles.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ trans('lang.role_create') }}
        </a>
        @endcan
    </div>
</div>
@endsection
<div class="card">
    <div class="card-body">
        @if (session('info'))
        <div class="alert alert-info">
            <strong>{{ session('info') }}</strong>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            <strong>{{ session('error') }}</strong>
        </div>
        @endif

        <table id="roles" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('lang.name') }}</th>
                    <!-- <th>{{ trans('lang.guard_name') }}</th> -->

                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <!-- <td>{{ $role->guard_name }}</td> -->

                    <td class="flex items-center justify-center">
                        @can('dashboard.roles.edit')
                        <a href="{{ route('dashboard.roles.edit', $role) }}" class='btn btn-link'>
                            <i class="fas fa-edit text-gray-500 hover:text-gray-700  cursor-pointer"></i>
                        </a>
                        @endcan

                        @can('dashboard.roles.destroy')
                        {!! Form::open(['route' => ['dashboard.roles.destroy', $role], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-gray-700"></i>', [
                        'type' => 'submit',
                        'class' => '',
                        'onclick' => "return confirm('Estás seguro que deseas eliminar a $role->name')",
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
<script>
    $('#roles').DataTable({
        columnDefs: [{
            orderable: false,
            targets: -1,
        }],
        responsive: true,
        autoWidth: false,
    });
</script>
@endpush