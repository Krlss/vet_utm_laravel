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
        <a href="{{ route('dashboard.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 truncate">
            {{trans('lang.list_user')}}
        </a>
        @endcan
        @can('dashboard.users.create')
        <a href="{{ route('dashboard.users.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-md font-semibold px-4 truncate">
            {{trans('lang.createUser')}}
        </a>
        @endcan
    </div>
</div>
@endsection

<div class="card">
    <div class="card-body">

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
        @endif

        @if (session('info'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('info') }}
        </div>
        @endif


        {!! Form::model($user, ['route' => ['dashboard.users.update', $user], 'autocomplete' => 'off', 'method' => 'put']) !!}
        @include('dashboard.users.fields')
        {!! Form::close() !!}

    </div>

</div>
</div>



@endsection