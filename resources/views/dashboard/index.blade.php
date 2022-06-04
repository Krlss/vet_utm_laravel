@extends('layouts.admin')

@section('content_header')
<div class="flex flex-col w-full">
    <h2>{{__('Hi')}}, <b>{{Auth::user()->name}}</b></h2>
    <h1><b>{{getGoodMorningOrGoodEveningOrGoodAfternoon()}}</b></h1>
</div>

@endsection

@section('content')

<div class="content">
    <!-- Small boxes (Stat box) -->
    <div class="flex md:flex-row flex-col items-center justify-end gap-2">
        @can('dashboard.users.index')
        <x-card-home small='Users quantity' value="{{shortenNumber($users)}}" icon="fa fa-users" route="dashboard.users.index" bg="blue" color="white" />
        @endcan

        @can('dashboard.pets.index')
        <x-card-home small='Pets quantity' value="{{shortenNumber($pets)}}" icon="fas fa-paw" route="dashboard.pets.index" bg="green" color="white" />
        @endcan

        @can('dashboard.reports.index')
        <x-card-home small='Reports quantity' value="{{shortenNumber($petsReport)}}" icon="fas fa-question" route="dashboard.reports.index" bg="yellow" color="black" />
        @endcan
    </div>

</div>



@endsection