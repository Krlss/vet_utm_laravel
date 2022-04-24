@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{trans('lang.pet_registration')}}</div>
    <a href="{{ route('dashboard.reports.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{trans('lang.list_pets')}}
    </a>
</div>
@endsection

<div class="card">
    <div class="card-body">

        @if (session('error'))
        <div class="alert alert-danger">
            <strong>{{ session('error') }}</strong>
        </div>
        @endif

        {!! Form::open(['route' => 'dashboard.reports.store']) !!}
        @include('dashboard.reports.fields_create')
        {!! Form::close() !!}
    </div>
</div>


<!-- <div class="flex flex-wrap w-full h-full">
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
        </div> -->
@endsection