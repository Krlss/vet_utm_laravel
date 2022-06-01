@extends('layouts.admin')

@section('content')
@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush
@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Users list') }}</div>
    @can('dashboard.users.create')
    <a href="{{ route('dashboard.users.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 hover:no-underline ">
        {{ __('Add user') }}
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
                    <th>{{ __('CI/RUC') }}</th>
                    <th>{{ __('Names') }}</th>
                    <th>{{ __('Last names') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Updated ago') }}</th>
                    <th>{{ __('Actions') }}</th>
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
                    <td class="flex items-center justify-center space-x-3">

                        @can('dashboard.users.show')
                        <button>
                            <a href="{{ route('dashboard.users.show', $user) }}">
                                <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                            </a>
                        </button>
                        @endcan
                        @can('dashboard.users.edit')
                        <button>
                            <a href="{{ route('dashboard.users.edit', $user) }}" class=''>
                                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                            </a>
                        </button>
                        @endcan

                        @can('dashboard.users.destroy')
                        {!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
                        'type' => 'submit',
                        'class' => '',
                        'onclick' => "return confirm('Estás seguro que deseas eliminar a $user->name')",
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