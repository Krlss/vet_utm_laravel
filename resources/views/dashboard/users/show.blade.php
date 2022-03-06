@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{trans('lang.show_user')}}</div>
    <a href="{{ route('dashboard.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
        {{trans('lang.list_user')}}
    </a>
</div>
@endsection

<div class="card">
    <div class="card-body">
        @include('dashboard.users.show_fields')
    </div>
</div>



@endsection