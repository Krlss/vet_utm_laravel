@extends('layouts.admin')

@section('content')

@push('css_lib')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex justify-between lg:items-center items-start lg:flex-row flex-col">

    <div class="text-lg font-bold">{{ trans('lang.edit_pet_report') }}</div>

    <div class="flex justify-center items-end space-x-2">

        <button type="submit" form="form_edit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>


        <a href="{{ route('dashboard.reports.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{ trans('lang.list_pets_lost') }}
        </a>


    </div>
</div>
@endsection

<div class="card">
    <div class="card-body">

        @if (session('error'))
        <div class="alert alert-danger">
            <strong>{{ session('error') }}</strong>
        </div>
        @endif

        @if (session('info'))
        <div class="alert alert-info">
            <strong>{{ session('info') }}</strong>
        </div>
        @endif

        {!! Form::model($pet, ['route' => ['dashboard.reports.update', $pet], 'autocomplete' => 'off', 'method' => 'put', 'id' => 'form_edit']) !!}
        @include('dashboard.reports.fields')
        {!! Form::close() !!}

        @if ($images)
        <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">{{ trans('lang.photos_report') }}
        </div>
        @else
        <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">
            {{ trans('lang.not_photos_report') }}
        </div>
        <div class="w-full text-left">
            {{ trans('lang.recommendable_not_published') }}
        </div>
        @endif

        <div class="flex flex-wrap w-full h-full">
            @foreach ($images as $img)
            {{ Form::open(['route' => ['dashboard.destroyImageGoogle', $img], 'method' => 'delete']) }}
            <section class="flex flex-col p-1 h-60 w-60 relative overflow-hidden">
                {!! Form::hidden('url', $img->url, null) !!}
                <img class="h-60 w-60 border object-cover" src={{ $img->url }} />
                @can('dashboard.destroyImageGoogle')

                {!! Form::button('<i class="fa fa-trash text-red-400 hover:text-red-500 absolute top-3 right-2 font-extrabold"></i>', [
                'type' => 'submit',
                'class' => '',
                'onclick' => "return confirm('Estás seguro que deseas eliminar esa imagen?')",
                ]) !!}
                {!! Form::close() !!}

                @endcan

            </section>
            {{ Form::close() }}
            @endforeach
        </div>

    </div>
</div>



@endsection