@extends('layouts.admin')

@section('content')
    @push('css_lib')
        <link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
    @endpush
@section('content_header')
    <div class="flex justify-between items-center">
        <div class="text-lg font-bold">{{ trans('lang.list_pets') }}</div>
        <a href="{{ route('dashboard.pets.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ trans('lang.createPet') }}
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

        @if (session('error'))
            <div class="alert alert-danger">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        <table id="pets" class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('lang.pet_id') }}</th>
                    <th>{{ trans('lang.namePet') }}</th> 
                    <th>{{ trans('lang.castrated') }}</th> 
                    <th>{{ trans('lang.lost') }}</th> 
                    <th>{{ trans('lang.duenio') }}</th> 
                    <th>{{ trans('lang.updated_at') }}</th> 
                    
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                    <tr>
                        <td>{{ $pet->pet_id }}</td>
                        <td>{{ $pet->name }}</td>
                        <td>{{ $pet->castrated == 1 ? trans('lang.yep') : trans('lang.nop') }}</td>
                        <td>{{ $pet->lost == 1 ? trans('lang.yep') : trans('lang.nop') }}</td>
                        <td>{{ $pet->user_id }}</td>

                        <td>{{ $pet->updated_at->diffForHumans() }}</td>
                        <td class="flex items-center justify-center">

                            <a href="{{ route('dashboard.pets.show', $pet) }}">
                                <i class="fas fa-eye text-gray-500 hover:text-gray-700 cursor-pointer"></i>
                            </a>
                            <a href="{{ route('dashboard.pets.edit', $pet) }}" class='btn btn-link'>
                                <i class="fas fa-edit text-gray-500 hover:text-gray-700  cursor-pointer"></i>
                            </a>
                            {!! Form::open(['route' => ['dashboard.pets.destroy', $pet], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-gray-700"></i>', [
                                'type' => 'submit',
                                'class' => '',
                                'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name')",
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
    $('#pets').DataTable({
        columnDefs: [{
            orderable: false,
            targets: -1,
        }],
        responsive: true,
        autoWidth: false,
    });
</script>
@endpush
