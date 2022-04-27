<div>

    <!-- User data -->
    @if ($user)
    <div x-data="{ open: true}">
        <!-- Head + actions -->
        <div class="flex items-center space-x-2 my-3">

            <p class="text-gray-400 text-sm font-bold uppercase">{{ trans('lang.data_owner') }}</p>
            <div class="cursor-pointer text-gray-400">
                <button @click="open=!open" type="button">
                    <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>

            @can('dashboard.users.show')
            <a data-tooltip-target="tooltip-show-user" href="{{ route('dashboard.users.show', $user) }}" class="">
                <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                <div id="tooltip-show-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{trans('lang.show_data')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </a>
            @endcan

            @can('dashboard.users.edit')
            <a data-tooltip-target="tooltip-edit-user" href="{{ route('dashboard.users.edit', $user) }}" class=''>
                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
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

        <!-- rows -->
        <div x-show="open">

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
                        <p class="truncate"> {{ $province ? $province->name : trans('lang.without_province') }} </p>
                    </div>
                </div>
                <!-- CANTON -->
                <div>
                    {!! Form::label('canton', trans('lang.canton'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {{ $canton ? $canton->name : trans('lang.without_canton')}} </p>
                    </div>
                </div>
                <!-- PARISH -->
                <div>
                    {!! Form::label('parish', trans('lang.parishe'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {{ $parish ? $parish->name : trans('lang.without_parishe')}} </p>
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

        </div>
    </div>
    @endif

    <!-- Pet data -->
    <div x-data="{ open: true}">
        <!-- Header + actions -->
        <div class="flex items-center space-x-2 my-3">

            <p class="text-gray-400 text-sm font-bold uppercase">{{ trans('lang.data_pet') }}</p>
            <div class="cursor-pointer text-gray-400">
                <button @click="open=!open" type="button">
                    <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>

            @can('dashboard.pets.edit')
            <a data-tooltip-target="tooltip-edit-pet" href="{{ route('dashboard.pets.edit', $pet) }}" class=''>
                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                <div id="tooltip-edit-pet" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{trans('lang.edit_pet_data')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </a>
            @endcan

            @can('dashboard.pets.destroy')
            {!! Form::open(['route' => ['dashboard.pets.destroy', $pet], 'method' => 'delete']) !!}
            {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
            'type' => 'submit',
            'class' => '',
            'data-tooltip-target' => 'tooltip-delete-pet',
            'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name')",
            ]) !!}
            <div id="tooltip-delete-pet" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                {{trans('lang.delete_pet')}}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            {!! Form::close() !!}
            @endcan
        </div>

        <!-- ROWS -->
        <div x-show="open">

            <!-- 1 ROW -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">

                <!-- pet id -->
                <div>
                    {!! Form::label('pet_id', trans('lang.pet_id'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->pet_id !!} </p>
                    </div>
                </div>

                <!-- pet name -->
                <div>
                    {!! Form::label('namePet', trans('lang.name'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->name !!} </p>
                    </div>
                </div>

                <!-- Pet Specie -->
                <div>
                    {!! Form::label('specie', trans('lang.specie'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! trans('lang.' . $pet->specie) !!} </p>
                    </div>
                </div>

                <!-- Pet race -->
                <div>
                    {!! Form::label('race', trans('lang.race'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->race !!} </p>
                    </div>
                </div>
            </div>

            <!-- 2 ROW -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 mt-2">

                <!-- pet sex -->
                <div>
                    {!! Form::label('sex', trans('lang.sexP'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate">
                            @if ($pet->sex == '##########')
                            {{ $pet->sex }}
                            @else
                            {{ $pet->sex == 'M' ? trans('lang.maleP') : trans('lang.femaleP') }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- pet castr -->
                <div>
                    {!! Form::label('castrated', trans('lang.castrated'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->castrated ? trans('lang.yep') : trans('lang.nop') !!} </p>
                    </div>
                </div>

                <!-- Pet lost -->
                <div>
                    {!! Form::label('lost', trans('lang.lost'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->lost ? trans('lang.yep') : trans('lang.nop') !!} </p>
                    </div>
                </div>

                <!-- Pet birth -->
                <div>
                    {!! Form::label('birth', trans('lang.birth'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->birth !!} </p>
                    </div>
                </div>
            </div>

            <!-- 3 ROW -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 mt-2">

                <!-- publi app -->
                <div>
                    {!! Form::label('published', trans('lang.published'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->published ? trans('lang.yep') : trans('lang.nop') !!} </p>
                    </div>
                </div>

                <!-- Pet n lost -->
                <div>
                    {!! Form::label('n_lost', trans('lang.n_lost'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->n_lost !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($images))
    <div x-data="{ open: false }">
        <div class="flex items-center">
            <h6 class="text-gray-400 text-sm my-3 font-bold uppercase"> {{ trans('lang.photo_pet') }} </h6>
            <div class="ml-2 cursor-pointer">
                <button @click="open=!open" type="button" class="text-gray-400">
                    <div x-show="!open"><i class="fa fa-angle-down text-sm"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-sm"></i></div>
                </button>
            </div>
        </div>
        <div x-show="open" id="container_images" class="w-full relative m-auto flex justify-evenly gap-5 flex-wrap items-end">
            @foreach ($images as $image)
            <div class="bg-cover bg-center h-48 w-64" style="background-image: url('{{$image->url}}')"></div>
            @endforeach
        </div>
    </div>
    @else
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase"> {{ trans('lang.not_photos_report') }} </h6>
    <div class="w-full text-left"> {{ trans('lang.recommendable_not_published') }} </div>
    @endif

    @push('scripts_lib')
    <script src="//unpkg.com/alpinejs"></script>
    @endpush
</div>