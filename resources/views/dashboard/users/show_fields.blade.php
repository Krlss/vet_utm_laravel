<!-- Head -->
<div class="flex items-center space-x-2 my-3">
    <p class="text-gray-400 text-sm font-bold uppercase">{{__('User data')}}</p>
    @can('dashboard.users.edit')
    <a data-tooltip-target="tooltip-edit-user" href="{{ route('dashboard.users.edit', $user) }}" class='bg-green-600 hover:bg-green-500 text-white p-1 rounded shadow-sm'>
        <x-icon icon="pencil" class="cursor-pointer" width=16 height=16 viewBox="16 16" strokeWidth=0 fill="white" />
        <div id="tooltip-edit-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            {{__('Edit user data')}}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </a>
    @endcan
    @can('dashboard.users.destroy')
    {!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-white text-sm"></i>', [
    'type' => 'submit',
    'class' => 'bg-red-700 hover:bg-red-500 text-white px-1 rounded shadow-sm',
    'data-tooltip-target' => 'tooltip-delete-user',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $user->name')",
    ]) !!}
    <div id="tooltip-delete-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{__('Delete user')}}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    {!! Form::close() !!}
    @endcan
</div>

<!-- 1 ROW -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-3">
    <!-- User ID -->
    <div>
        {!! Form::label('tableUserID', __('CI/RUC'), ['class' => '']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate">{!! $user->user_id !!}</p>
        </div>
    </div>
    <!-- Names -->
    <div>
        {!! Form::label('namesUser', __('Names'), ['class' => '']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->name !!} </p>
        </div>
    </div>
    <!-- Last name -->
    <div>
        {!! Form::label('last_names', __('Last names'), ['class' => '']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->last_name1 !!} {!! $user->last_name2 !!}</p>
        </div>
    </div>
</div>

<!-- 2 ROW -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-2">
    <!-- PHONE -->
    <div>
        {!! Form::label('phone', __('Phone'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm flex items-center justify-between">
            <p class="truncate pr-2"> {!! $user->phone ?? __('Phone undefined') !!} </p>
        </div>
    </div>
    <!-- EMAIL -->
    <div>
        {!! Form::label('email', __('Email'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm flex items-center justify-between">
            <p class="truncate pr-2"> {!! $user->email !!} </p>
            <livewire:email-is-check :email_verified_at="$user->email_verified_at" :api_token="$user->api_token" :email="$user->email" />
            @livewireScripts
        </div>
    </div>
</div>

<!-- 3 ROW -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-2">
    <!-- PROVINCE -->
    <div>
        {!! Form::label('province', __('Province'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {{ $user->province ? $user->province->name : __('Province undefined') }} </p>
        </div>
    </div>
    <!-- CANTON -->
    <div>
        {!! Form::label('canton', __('Canton'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {{ $user->canton ? $user->canton->name : __('Canton undefined') }} </p>
        </div>
    </div>
    <!-- PARISH -->
    <div>
        {!! Form::label('parish', __('Parish'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {{ $user->parish ? $user->parish->name : __('Parish undefined') }} </p>
        </div>
    </div>
</div>

<!-- 4 ROW -->
<div class="grid grid-cols-1 gap-3 mt-2">
    <!-- ADDRESS MAIN -->
    <div>
        {!! Form::label('main_street', __('Street main'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->main_street ?? __('Street main undefined') !!} </p>
        </div>
    </div>
    <!-- ADDRES 1 -->
    <div>
        {!! Form::label('street_1_sec', __('Street secondary one'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->street_1_sec ?? __('Street secondary one undefined') !!} </p>
        </div>
    </div>
    <!-- ADDRESS 2 -->
    <div>
        {!! Form::label('street_2_sec', __('Street secondary two'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->street_2_sec ?? __('Street secondary two undefined') !!} </p>
        </div>
    </div>
    <!-- REFF -->
    <div>
        {!! Form::label('address_ref', __('Reference'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->address_ref ?? __('Reference undefined') !!} </p>
        </div>
    </div>
</div>

<livewire:users.show-list-pets :currentsPets="$user->pets" :user_id="$user->user_id" :delete="true" />

@push('js')
<script src="{{ asset('js/alpine.min.js') }}"></script>
@livewireScripts
@endpush