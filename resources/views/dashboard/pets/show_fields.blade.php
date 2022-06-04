<div>
    <!-- User data -->
    <x-owner-pet-show :pet=$pet />

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
                            <a href="{{ route('dashboard.pets.show', $pet->id_pet_pather) }}">
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
                            <a href="{{ route('dashboard.pets.show', $pet->id_pet_mother) }}">
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

    <x-pet-photos-show :pet=$pet />
</div>