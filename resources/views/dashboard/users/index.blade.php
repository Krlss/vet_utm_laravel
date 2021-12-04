@extends('layouts.admin')

@section('content')
    @push('css_lib')
        <link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
    @endpush
@section('content_header')
    <div class="flex justify-between items-center">
        <div class="text-lg font-bold">{{trans('lang.list_user')}}</div>
        <a href="{{ route('dashboard.users.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ trans('lang.createUser') }}
        </a>
    </div>
@endsection

<table id="example" class="table table-striped table-bordered">
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
                <td class="flex items-center justify-center space-x-2">
                    <a><i class="fas fa-edit text-blue-400 cursor-pointer"></i></a>
                    <a><i class="fas fa-trash-alt text-red-400 cursor-pointer"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts_lib')
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            targets: -1
        }]
    });
</script>
@endpush
