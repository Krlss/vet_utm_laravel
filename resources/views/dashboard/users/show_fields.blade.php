<!-- Head -->
<div class="flex items-center space-x-2 my-3">
    <p class="text-gray-400 text-sm font-bold uppercase">{!!trans('lang.label_data_user')!!}</p>
    @can('dashboard.users.edit')
    <a data-tooltip-target="tooltip-edit-user" href="{{ route('dashboard.users.edit', $user) }}" class='text-gray-500 hover:text-green-700'>
        <i class="fas fa-edit cursor-pointer"></i>
        <div id="tooltip-edit-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            {{trans('lang.edit_this_user')}}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </a>
    @endcan
    @can('dashboard.users.destroy')
    {!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'data-tooltip-target' => 'tooltip-delete-user',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $user->name')",
    ]) !!}
    <div id="tooltip-delete-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{trans('lang.delete_user')}}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    {!! Form::close() !!}
    @endcan
</div>

<!-- 1 ROW -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-3">
    <!-- Names -->
    <div>
        {!! Form::label('namesUser', trans('lang.namesUser'), ['class' => '']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->name !!} </p>
        </div>
    </div>
    <!-- Last name -->
    <div>
        {!! Form::label('last_names', trans('lang.last_names'), ['class' => '']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->last_name1 !!} {!! $user->last_name2 !!}</p>
        </div>
    </div>
    <!-- User ID -->
    <div>
        {!! Form::label('tableUserID', trans('lang.tableUserID'), ['class' => '']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate">{!! $user->user_id !!}</p>
        </div>
    </div>
</div>

<!-- 2 ROW -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-2">
    <!-- PHONE -->
    <div>
        {!! Form::label('phone', trans('lang.phone'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm flex items-center justify-between">
            <p class="truncate pr-2"> {!! $user->phone !!} </p>
        </div>
    </div>
    <!-- EMAIL -->
    <div>
        {!! Form::label('email', trans('lang.email'), ['class' => ' ']) !!}
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
        {!! Form::label('province', trans('lang.province'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {{ $user->province ? $user->province->name : trans('lang.without_province') }} </p>
        </div>
    </div>
    <!-- CANTON -->
    <div>
        {!! Form::label('canton', trans('lang.canton'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {{ $user->canton ? $user->canton->name : trans('lang.without_canton')}} </p>
        </div>
    </div>
    <!-- PARISH -->
    <div>
        {!! Form::label('parish', trans('lang.parishe'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {{ $user->parish ? $user->parish->name : trans('lang.without_parishe')}} </p>
        </div>
    </div>
</div>

<!-- 4 ROW -->
<div class="grid grid-cols-1 gap-3 mt-2">
    <!-- ADDRESS MAIN -->
    <div>
        {!! Form::label('main_street', trans('lang.main_street'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->main_street ? $user->main_street : trans('lang.without_main_street') !!} </p>
        </div>
    </div>
    <!-- ADDRES 1 -->
    <div>
        {!! Form::label('street_1_sec', trans('lang.street_1_sec'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->street_1_sec ? $user->street_1_sec : trans('lang.without_street_1_sec') !!} </p>
        </div>
    </div>
    <!-- ADDRESS 2 -->
    <div>
        {!! Form::label('street_2_sec', trans('lang.street_2_sec'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->street_2_sec ? $user->street_2_sec : trans('lang.without_street_2_sec') !!} </p>
        </div>
    </div>
    <!-- REFF -->
    <div>
        {!! Form::label('address_ref', trans('lang.address_ref'), ['class' => ' ']) !!}
        <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
            <p class="truncate"> {!! $user->address_ref ? $user->address_ref : trans('lang.without_address_ref') !!} </p>
        </div>
    </div>
</div>

<livewire:users.show-list-pets :currentsPets="$user->pets" :user_id="$user->user_id" :delete="true" />
@livewireScripts