@extends('layouts.admin')

@section('content_header')
<div class="flex flex-col justify-between md:items-center items-start md:flex-row gap-2">
    <div class="flex flex-col">
        <div class="text-2xl font-extrabold">{{ __('Product revenue') }}</div>
        <span class="text-bold">{{__('Register an entry order for your products')}}</span>
    </div>

    <div>
        <button form="form-kardex" class="bg-green-page text-white py-2 px-4 hover:bg-green-900 rounded-md font-medium" type="submit">{{__('Save')}}</button>

        <a href="{{route('dashboard.products-ingress.index')}}">
            <button class="bg-red-700 py-2 px-4 hover:bg-red-800 rounded-md text-white font-medium">
                {{__('Back')}}
            </button>
        </a>

    </div>


</div>
@endsection

@section('content')
<form id="form-kardex" class="md:mb-0 mb-10" action="{{ route('dashboard.products-ingress.store') }}" method="POST">

    <x-flash-messages />
    @csrf
    <x-card-kardex id="{{$count}}" readonly={{false}} :kardex=null />

    @livewire('products-kardexes', ['products' => old('products') ? old('products') : [], 'type' => 'ingress'])
    <livewire:scripts :currentFiles="" />
</form>

@endsection