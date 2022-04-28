@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ trans('lang.audit_table') }}</div>
</div>
@endsection
<div class="card">
    <div class="card-body">
        <livewire:auditions :currentsAudit="$currentsAudit" />
        @livewireScripts
    </div>
</div>
@endsection