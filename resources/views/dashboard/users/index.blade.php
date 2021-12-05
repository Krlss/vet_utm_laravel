@extends('layouts.admin')

@section('content')
    @push('css_lib')
        <link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
    @endpush
@section('content_header')
    <div class="flex justify-between items-center">
        <div class="text-lg font-bold">{{ trans('lang.list_user') }}</div>
        <a href="{{ route('dashboard.users.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ trans('lang.createUser') }}
        </a>
    </div>
@endsection
<div class="card">
    <div class="card-body">
        @if (session('info'))
            <div class="alert alert-info">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif

        <table id="users" class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('lang.tableUserID') }}</th>
                    <th>{{ trans('lang.namesUser') }}</th>
                    <th>{{ trans('lang.last_names') }}</th>
                    <th>{{ trans('lang.emailTable') }}</th>
                    <th>{{ trans('lang.updated_at') }}</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name1 }} {{ $user->last_name2 }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td class="flex items-center justify-center">

                            <a href="{{ route('dashboard.users.show', $user) }}">
                                <i class="fas fa-eye text-gray-500 hover:text-gray-700 cursor-pointer"></i>
                            </a>
                            <a href="{{ route('dashboard.users.edit', $user) }}" class='btn btn-link'>
                                <i class="fas fa-edit text-gray-500 hover:text-gray-700  cursor-pointer"></i>
                            </a>
                            {!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-gray-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $user->name')",
]) !!}
                            {!! Form::close() !!}
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
    $('#users').DataTable({
        columnDefs: [{
            orderable: false,
            targets: -1,
        }],
        responsive: true,
        autoWidth: false,
    });
</script>
@endpush
