@if ($pet->user)
<div x-data="{ open: true}">
    <!-- Head + actions -->
    <div class="flex items-center space-x-2 my-3">

        <p class="text-gray-400 text-sm font-bold uppercase">{{ __('Ower data') }}</p>
        <div class="cursor-pointer text-gray-400">
            <button @click="open=!open" type="button">
                <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
            </button>
        </div>

        @can('dashboard.users.show')
        <a data-tooltip-target="tooltip-show-user" href="{{ route('dashboard.users.show', $pet->user) }}" class="">
            <i class="fas fa-eye text-white bg-blue-600 hover:bg-blue-500 p-1 rounded shadow-sm"></i>
            <div id="tooltip-show-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                {{ __('Show data user') }}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </a>
        @endcan

        @can('dashboard.users.edit')
        <a data-tooltip-target="tooltip-edit-user" href="{{ route('dashboard.users.edit', $pet->user) }}" class='bg-green-600 hover:bg-green-500 text-white p-1 rounded shadow-sm'>
            <x-icon icon="pencil" class="cursor-pointer" width=16 height=16 viewBox="16 16" strokeWidth=0 fill="white" />
            <div id="tooltip-edit-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                {{ __('Edit data user') }}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </a>
        @endcan

        @can('dashboard.users.destroy')
        {!! Form::open(['route' => ['dashboard.users.destroy', $pet->user], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fa fa-trash text-white"></i>', [
        'type' => 'submit',
        'class' => 'bg-red-700 hover:bg-red-500 text-white px-1 rounded shadow-sm',
        'data-tooltip-target' => 'tooltip-delete-user',
        'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->user->name')",
        ]) !!}
        <div id="tooltip-delete-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            {{ __('Delete user') }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        {!! Form::close() !!}
        @endcan
    </div>

    <!-- rows -->
    <div x-show="open">

        <!-- 1 ROW -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <!-- User ID -->
            <div>
                {!! Form::label('tableUserID', __('CI/RUC'), ['class' => '']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate">{!! $pet->user->user_id !!}</p>
                </div>
            </div>
            <!-- Names -->
            <div>
                {!! Form::label('namesUser', __('Names'), ['class' => '']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {!! $pet->user->name !!} </p>
                </div>
            </div>
            <!-- Last name -->
            <div>
                {!! Form::label('last_names', __('Last names'), ['class' => '']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {!! $pet->user->last_name1 !!} {!! $pet->user->last_name2 !!}</p>
                </div>
            </div>
        </div>

        <!-- 2 ROW -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-2">
            <!-- PHONE -->
            <div>
                {!! Form::label('phone', __('Phone'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm flex items-center justify-between">
                    <p class="truncate pr-2"> {!! $pet->user->phone ?? __('Phone undefined') !!} </p>
                </div>
            </div>
            <!-- EMAIL -->
            <div>
                {!! Form::label('email', __('Email'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm flex items-center justify-between">
                    <p class="truncate pr-2"> {!! $pet->user->email !!} </p>
                    <livewire:email-is-check :email_verified_at="$pet->user->email_verified_at" :api_token="$pet->user->api_token" :email="$pet->user->email" />
                </div>
            </div>
        </div>

        <!-- 3 ROW -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-2">
            <!-- PROVINCE -->
            <div>
                {!! Form::label('province', __('Province'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {{ $pet->user->province ? $pet->user->province->name : __('Province undefined') }} </p>
                </div>
            </div>
            <!-- CANTON -->
            <div>
                {!! Form::label('canton', __('Canton'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {{ $pet->user->canton ? $pet->user->canton->name : __('Canton undefined') }} </p>
                </div>
            </div>
            <!-- PARISH -->
            <div>
                {!! Form::label('parish', __('Parish'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {{ $pet->user->parish ? $pet->user->parish->name : __('Parish undefined') }} </p>
                </div>
            </div>
        </div>

        <!-- 4 ROW -->
        <div class="grid grid-cols-1 gap-3 mt-2">
            <!-- ADDRESS MAIN -->
            <div>
                {!! Form::label('main_street', __('Street main'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {!! $pet->user->main_street ?? __('Street main undefined') !!} </p>
                </div>
            </div>
            <!-- ADDRES 1 -->
            <div>
                {!! Form::label('street_1_sec', __('Street secondary one'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {!! $pet->user->street_1_sec ?? __('Street secondary one undefined') !!} </p>
                </div>
            </div>
            <!-- ADDRESS 2 -->
            <div>
                {!! Form::label('street_2_sec', __('Street secondary two'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {!! $pet->user->street_2_sec ?? __('Street secondary two undefined') !!} </p>
                </div>
            </div>
            <!-- REFF -->
            <div>
                {!! Form::label('address_ref', __('Reference'), ['class' => ' ']) !!}
                <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                    <p class="truncate"> {!! $pet->user->address_ref ?? __('Reference undefined') !!} </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endif