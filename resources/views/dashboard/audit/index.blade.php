@extends('layouts.admin')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Audits list') }}</div>
</div>
@section('content')

@endsection
<div class="card">
    <div class="card-body">
        <livewire:auditions :currentsAudit="$currentsAudit" />
    </div>
</div>
@endsection

@push('js')
@livewireScripts
@endpush