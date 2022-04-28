<div x-data="{ open: false }">
    @if(count($pets) || count($currents))
    <div class="flex md:flex-row flex-col md:items-center md:justify-between my-3">
        <div class="flex items-start">
            <div>
                {!! Form::label('pets_user', trans('lang.label_data_user_pets').' ('.count($currents).')', ['class' => 'text-gray-400 text-sm font-bold uppercase']) !!}
            </div>
            <div class="ml-2 cursor-pointer">
                <button @click="open=!open" type="button">
                    <div x-show="!open" class="text-gray-400"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open" class="text-gray-400"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </div>
        @if(count($currents) > 5)
        <div x-show="open" class="relative md:w-96">
            <input class="form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm md:max-w-sm max-w-none pr-5" placeholder="Busca por nombre o código de la mascota..." wire:model="search" />
            @if($search <> '') <div wire:click="reset_search" class="cursor-pointer absolute top-2 right-3 text-sm text-gray-600">x</div> @endif
        </div>
        @endif
    </div>
    <div x-show="open" class="w-full max-h-80 flex flex-row flex-wrap overflow-y-scroll overflow-x-hidden">
        @forelse ($pets as $pet)
        <div wire:loading.class="animate-pulse" class="p-2 col-lg-4">
            <div class="border px-4 py-2 rounded-lg grid grid-cols-3">
                <div class="flex flex-col col-span-2">
                    <h4 class="uppercase font-bold truncate">{!! $pet->name !!}</h4>
                    <small class="uppercase truncate">{!! $pet->pet_id !!}</small>
                </div>

                <div class="flex items-center justify-end space-x-2 col-start-3">

                    @can('dashboard.pets.show')
                    <div>
                        <button data-tooltip-target="show" data-tooltip-placement="left" type="button">
                            <a href="{{ route('dashboard.pets.show', $pet) }}" class="">
                                <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                            </a>
                        </button>
                        <div id="show" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{trans('lang.show_data')}}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    @endcan
                    @can('dashboard.pets.edit')
                    <div>
                        <button data-tooltip-target="edit" data-tooltip-placement="left" type="button">
                            <a href="{{ route('dashboard.pets.edit', $pet) }}" class=''>
                                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                            </a>
                        </button>
                        <div id="edit" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{trans('lang.edit_data')}}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    @endcan

                    @if($delete)
                    {!! Form::open(['route' => ['dashboard.deletePetUser', $pet], 'method' => 'delete']) !!}
                    {!! Form::hidden('pet_id', $pet->pet_id, null) !!}
                    {!! Form::button('<li class="text-gray-500 hover:text-red-700 fa fa-times-circle"></li>', [
                    'type' => 'submit',
                    'data-tooltip-target' => 'tooltip-remove-pet-to-user',
                    'data-tooltip-placement' => 'left',
                    'onclick' => "return confirm('Estás seguro que deseas quitar a $pet->name de este usuario?')",
                    ]) !!}
                    <div id="tooltip-remove-pet-to-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{trans('lang.remove')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    {!! Form::close() !!}
                    @endif

                </div>
            </div>

        </div>
        @empty
        <small wire:loading.class="animate-pulse">{{trans('lang.data_not_found')}}</small>
        @endforelse
    </div>

    @elseif(!count($pets) && !count($currents))
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!!trans('lang.label_data_user_pets_without')!!}
    </h6>
    @endif

</div>

@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
<script>
    window.onload = () => {
        document.querySelector("html").style.overflowX = "hidden";
    }
</script>
@endpush