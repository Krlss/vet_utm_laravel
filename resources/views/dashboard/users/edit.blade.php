@extends('layouts.admin')

@section('content')

@section('content_header')
    <div class="flex justify-between items-center">
        <div class="text-lg font-bold">{{trans('lang.edit_user')}}</div>
        <a href="{{ route('dashboard.users.index') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.list_user')}}
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

        {!! Form::model($user, ['route' => ['dashboard.users.update', $user], 'autocomplete' => 'off', 'method' => 'put']) !!}
        @include('dashboard.users.fields')
        {!! Form::close() !!}
    </div>
</div>



@endsection
