<div>
    <!-- User data -->
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

    <!-- Pet data -->
    <div x-data="{ open: true}">
        <!-- Header + actions -->
        <div class="flex items-center space-x-2 my-3">

            <p class="text-gray-400 text-sm font-bold uppercase">{{ __('Pet data') }}</p>
            <div class="cursor-pointer text-gray-400">
                <button @click="open=!open" type="button">
                    <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>

            @can('dashboard.pets.edit')
            <a data-tooltip-target="tooltip-edit-pet" href="{{ route('dashboard.pets.edit', $pet) }}" class='bg-green-600 hover:bg-green-500 text-white p-1 rounded shadow-sm'>
                <x-icon icon="pencil" class="cursor-pointer" width=16 height=16 viewBox="16 16" strokeWidth=0 fill="white" />
                <div id="tooltip-edit-pet" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{ __('Edit data pet') }}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </a>
            @endcan

            @can('dashboard.pets.destroy')
            {!! Form::open(['route' => ['dashboard.pets.destroy', $pet], 'method' => 'delete']) !!}
            {!! Form::button('<i class="fa fa-trash text-white"></i>', [
            'type' => 'submit',
            'class' => 'bg-red-700 hover:bg-red-500 text-white px-1 rounded shadow-sm',
            'data-tooltip-target' => 'tooltip-delete-pet',
            'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name')",
            ]) !!}
            <div id="tooltip-delete-pet" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                {{ __('Delete pet') }}
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
                    {!! Form::label('pet_id', __('Pet ID'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->pet_id !!} </p>
                    </div>
                </div>

                <!-- pet name -->
                <div>
                    {!! Form::label('namePet', __('Name'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->name !!} </p>
                    </div>
                </div>

                <!-- Pet Specie -->
                <div>
                    {!! Form::label('specie', __('Species'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->specie ? $pet->specie->name : __('Specie undefined') !!} </p>
                    </div>
                </div>

                <!-- Pet race -->
                <div>
                    {!! Form::label('race', __('Race'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->race ? $pet->race->name : __('Race undefined') !!} </p>
                    </div>
                </div>
            </div>

            <!-- 2 ROW -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 mt-2">

                <!-- pet sex -->
                <div>
                    {!! Form::label('sex', __('Sex'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate">
                            @if ($pet->sex == '##########')
                            {{ $pet->sex }}
                            @else
                            {{ $pet->sex == 'M' ? __('Male pet') : __('Female pet') }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- pet castr -->
                <div>
                    {!! Form::label('castrated', __('Castrated'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->castrated ? __('Yes') : __('No') !!} </p>
                    </div>
                </div>

                <!-- Pet lost -->
                <div>
                    {!! Form::label('lost', __('Lost'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->lost ? __('Yes') : __('No') !!} </p>
                    </div>
                </div>

                <!-- Pet birth -->
                <div>
                    {!! Form::label('fur', __('Fur'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->fur ? $pet->fur->name : __('Fur undefined') !!} </p>
                    </div>
                </div>
            </div>

            <!-- 3 ROW -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 mt-2">

                <!-- Pet birth -->
                <div>
                    {!! Form::label('birth', __('Birth date'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->birth !!} </p>
                    </div>
                </div>

                <!-- pet pather -->
                <div>
                    {!! Form::label('pather', __('Pather'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate">
                            @if ($pet->id_pet_pather)
                            <a href={{ route('dashboard.pets.show', $pet->id_pet_pather) }}>
                                {!! $pet->id_pet_pather !!}
                            </a>
                            @else
                        <p>{{ __('Pather undefined') }}</p>
                        @endif
                        </p>
                    </div>
                </div>

                <!-- pet mother -->
                <div>
                    {!! Form::label('mother', __('Mother'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate">
                            @if ($pet->id_pet_mother)
                            <a href={{ route('dashboard.pets.show', $pet->id_pet_mother) }}>
                                {!! $pet->id_pet_mother !!}
                            </a>
                            @else
                        <p>{{ __('Mother undefined') }}</p>
                        @endif
                        </p>
                    </div>
                </div>

                <!-- Pet n lost -->
                <div>
                    {!! Form::label('n_lost', __('N° of lost'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->n_lost !!} </p>
                    </div>
                </div>
            </div>

            <!-- 4 ROW -->
            <div class="grid grid-cols-1 mt-2">
                <!-- characteristic -->
                <div>
                    {!! Form::label('characteristic', __('Characteristic'), ['class' => ' ']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $pet->characteristic ?? __('Characteristic undefined') !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHILDS -->
    <livewire:pets.show-list-childs :currentsPets="$childs" :pet_id="$pet->pet_id" :pet_name="$pet->name" :pet_sex="$pet->sex" :delete="true" />
    @livewireScripts

    @if(count($pet->images))
    <div x-data="{ open: true }">
        <div class="flex items-center">
            <h6 class="text-gray-400 text-sm my-3 font-bold uppercase"> {{ __('Pet photos') }} </h6>
            <div class="ml-2 cursor-pointer">
                <button @click="open=!open" type="button" class="text-gray-400">
                    <div x-show="!open"><i class="fa fa-angle-down text-sm"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-sm"></i></div>
                </button>
            </div>
        </div>
        <div x-show="open" id="container_images" class="w-full relative m-auto flex justify-evenly gap-5 flex-wrap items-end">
            @foreach ($pet->images as $image)
            <div class="bg-cover bg-center h-48 w-64" style="background-image: url('{{$image->url}}')"></div>
            @endforeach
        </div>
    </div>
    @else
    <h6 class="text-yellow-400 text-sm my-3 font-bold uppercase"> {{ __('Pet photos undefined') }} </h6>
    @endif

    @push('scripts_lib')
    <script src="//unpkg.com/alpinejs"></script>
    @endpush
</div>