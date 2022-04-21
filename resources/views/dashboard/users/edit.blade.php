@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{trans('lang.edit_user')}}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">
        @can('dashboard.users.index')
        <a href="{{ route('dashboard.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.list_user')}}
        </a>
        @endcan
        @can('dashboard.users.create')
        <a href="{{ route('dashboard.users.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.createUser')}}
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


        {!! Form::model($user, ['route' => ['dashboard.users.update', $user], 'autocomplete' => 'off', 'method' => 'put','id' => 'form_edit']) !!}
        @include('dashboard.users.fields')
        {!! Form::close() !!}


        <div class="">
            @if(count($pets))
            <div x-data="{ open: true }">
                <h6 class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center">
                    {!!trans('lang.label_data_user_pets')!!} ({!! count($pets) !!})
                    <div class="ml-2 cursor-pointer">
                        <button @click="open=!open" type="button">
                            <div x-show="!open"><i class="fa fa-angle-down text-lg"></i></div>
                            <div x-show="open"><i class="fa fa-angle-left text-lg"></i></div>
                        </button>
                    </div>
                </h6>

                <div x-show="open" class="w-full max-h-80 flex flex-row flex-wrap overflow-y-scroll">
                    @foreach ($pets as $pet)
                    <div class="p-2 col-lg-4">
                        <div class="border px-4 py-2 rounded-lg flex flex-row justify-between">
                            <div class="flex flex-col">
                                <h4 class="uppercase font-bold">{!! $pet->name !!}</h4>
                                <small class="uppercase">{!! $pet->pet_id !!}</small>
                            </div>
                            <div class="flex items-center justify-center">
                                @can('dashboard.pets.show')
                                <a href="{{ route('dashboard.pets.show', $pet) }}">
                                    <i class="fas fa-eye text-gray-500 hover:text-blue-700 cursor-pointer"></i>
                                </a>
                                @endcan
                                @can('dashboard.pets.edit')
                                <a href="{{ route('dashboard.pets.edit', $pet) }}" class='btn btn-link'>
                                    <i class="fas fa-edit text-gray-500 hover:text-green-700  cursor-pointer"></i>
                                </a>
                                @endcan

                                <!-- {!! Form::open(['route' => ['dashboard.deletePetUser', $pet], 'method' => 'delete']) !!}
                                {!! Form::hidden('pet_id', $pet->pet_id, null) !!}
                                {!! Form::button('<i class="fa fa-times-circle text-gray-500 hover:text-red-700"></i>', [
                                'type' => 'submit',
                                'class' => '',
                                'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name de este usuario?')",
                                ]) !!}
                                {!! Form::close() !!} -->

                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
                {!!trans('lang.label_data_user_pets_without')!!}
            </h6>
            @endif

            <button form="form_edit" type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-4 mb-2 rounded-md text-whire font-medium text-white">Guardar</button>

        </div>

    </div>
</div>



@endsection