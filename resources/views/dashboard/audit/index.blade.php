@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ trans('lang.audit_table') }}</div>
</div>
@endsection
<div class="card">
    <div class="card-body">
        @foreach($audits as $audit)
        {{$audit->getMetaData()}}
        @endforeach
    </div>
</div>
@endsection