<div x-data="{ open: false }">
    @if(count($pets) || count($currents))
    <div class="flex md:flex-row flex-col md:items-center md:justify-between my-3">
        <div class="flex items-start">
            <div>
                {!! Form::label('pets_user', trans('lang.childs').' ('.count($currents).')', ['class' => 'text-gray-400 text-sm font-bold uppercase']) !!}
            </div>
            <div class="ml-2 cursor-pointer">
                <button @click="open=!open" type="button">
                    <div x-show="!open" class="text-gray-400"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open" class="text-gray-400"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </div>
        @if(count($currents) > 5)
        <div x-show="open" class="relative md:w-96 w-full ">
            <input class="form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm md:max-w-sm max-w-none pr-5" placeholder="Busca por nombre o código de la mascota..." wire:model="search" />
            @if($search <> '') <div wire:click="reset_search" class="cursor-pointer transform rotate-45 absolute top-1 right-2 text-lg">+</div> @endif
        </div>
        @endif
    </div>
    <div x-show="open" class="w-full max-h-80 flex flex-row flex-wrap overflow-y-scroll">
        @forelse ($pets as $pet)
        <div wire:loading.class="opacity-75" class="p-2 col-lg-4">
            <div class="border px-4 py-2 rounded-lg flex flex-row justify-between">
                <div class="flex flex-col">
                    <h4 class="uppercase font-bold">{!! $pet->name !!}</h4>
                    <small class="uppercase">{!! $pet->pet_id !!}</small>
                </div>

                <div class="flex items-center justify-center space-x-2">

                    @can('dashboard.pets.show')
                    <button type="button">
                        <a href="{{ route('dashboard.pets.show', $pet) }}" class="">
                            <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                        </a>
                    </button>
                    @endcan
                    @can('dashboard.pets.edit')
                    <button type="button">
                        <a href="{{ route('dashboard.pets.edit', $pet) }}" class=''>
                            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                        </a>
                    </button>
                    @endcan

                    @if($delete)
                    {!! Form::open(['route' => ['dashboard.deletePetChildren', $pet], 'method' => 'delete']) !!}
                    {!! Form::hidden('pet_id', $pet->pet_id, null) !!}
                    {!! Form::hidden('sex', $pet_sex, null) !!}
                    {!! Form::button('<li class="text-gray-500 hover:text-red-700 fa fa-times-circle"></li>', [
                    'type' => 'submit',
                    '' => '',
                    'onclick' => "return confirm('¿Estás seguro que deseas quitar este hijo $pet->name de este padre $pet_name?')",
                    ]) !!}
                    {!! Form::close() !!}
                    @endif

                </div>
            </div>

        </div>
        @empty
        <small>{{trans('lang.data_not_found')}}</small>
        @endforelse
    </div>

    @elseif(!count($pets) && !count($currents))
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!!trans('lang.childs_doesnt_have')!!}
    </h6>
    @endif

</div>

@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
@endpush