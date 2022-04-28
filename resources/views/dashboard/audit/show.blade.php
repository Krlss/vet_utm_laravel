@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-y-0 space-y-2">
    <div class="text-lg font-bold">{{trans('lang.audit_show')}}</div>
    <div class="flex flex-col sm:space-x-2 sm:flex-row sm:items-center items-start sm:space-y-0 space-y-1">
        @can('dashboard.audit.index')
        <a href="{{ route('dashboard.audit.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 ">
            {{trans('lang.list_audits')}}
        </a>
        @endcan
    </div>
</div>
@endsection

<div class="card">
    <div class="card-body">
        @include('dashboard.audit.show_fields')
    </div>
</div>

@endsection