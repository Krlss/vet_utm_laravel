@extends('layouts.admin')

@section('content')

@section('content_header')

@endsection


<div class="content">
    <!-- Small boxes (Stat box) -->
    <div class="flex flex-row flex-wrap items-center justify-end pt-4">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            @can('dashboard.users.index')
            <a href="{{route('dashboard.users.index')}}">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$users}}</h3>
                        <p>{{trans('lang.users_count')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </a>
            @endcan
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            @can('dashboard.pets.index')
            <a href="{{ route('dashboard.pets.index') }}">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$pets}}</h3>
                        <p>{{trans('lang.pets_count')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-paw"></i>
                    </div>
                </div>
            </a>
            @endcan
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            @can('dashboard.reports.index')
            <a href="{{ route('dashboard.reports.index') }}">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$petsReport}}</h3>
                        <p>{{trans('lang.reports_count')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-question"></i>
                    </div>
                </div>
            </a>
            @endcan
        </div>

    </div>

</div>



@endsection