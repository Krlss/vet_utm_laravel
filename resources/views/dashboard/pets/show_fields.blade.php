<div>

    @if (session('info'))
    <div class="alert alert-info">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        <strong>{{ session('error') }}</strong>
    </div>
    @endif

    @if ($user)
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center space-x-2">
        <div>{{ trans('lang.data_owner') }}</div>
        @can('dashboard.users.show')
        <button>
            <a href="{{ route('dashboard.users.show', $user) }}" class="">
                <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
            </a>
        </button>
        @endcan
        @can('dashboard.users.edit')
        <button>
            <a href="{{ route('dashboard.users.edit', $user) }}" class=''>
                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
            </a>
        </button>
        @endcan
        @can('dashboard.users.destroy')
        {!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
        'type' => 'submit',
        'class' => '',
        'onclick' => "return confirm('Estás seguro que deseas eliminar a $user->name')",
        ]) !!}
        {!! Form::close() !!}
        @endcan
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        {{-- User ID --}}
        <div class="form-group flex-col">
            {!! Form::label('tableUserID', trans('lang.tableUserID'), ['class' => ' ']) !!}
            <div class="">
                {!! $user->user_id !!}
            </div>
        </div>
        {{-- User first_name --}}
        <div class="form-group flex-col">
            {!! Form::label('namesUser', trans('lang.namesUser'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->name !!}
                </p>
            </div>
        </div>
        {{-- User last_name --}}
        <div class="form-group flex-col">
            {!! Form::label('last_names', trans('lang.last_names'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->last_name1 !!} {!! $user->last_name2 !!}
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
        {{-- UserEmail --}}
        <div class="form-group flex-col">
            {!! Form::label('email', trans('lang.email'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->email !!}
                </p>
            </div>
        </div>

        {{-- User Phone --}}
        <div class="form-group flex-col">
            {!! Form::label('phone', trans('lang.phone'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->phone !!}
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        {{-- User province --}}
        <div class="form-group flex-col">
            {!! Form::label('province', trans('lang.province'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {{ $province ? $province->name : trans('lang.without_province') }}
                </p>
            </div>
        </div>

        {{-- User Canton --}}
        <div class="form-group flex-col">
            {!! Form::label('canton', trans('lang.canton'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {{ $canton ? $canton->name : trans('lang.without_canton')}}
                </p>
            </div>
        </div>

        {{-- User parish --}}
        <div class="form-group flex-col">
            {!! Form::label('parish', trans('lang.parishe'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {{ $parish ? $parish->name : trans('lang.without_parishe')}}
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 ">

        <div class="form-group flex-col">
            {!! Form::label('main_street', trans('lang.main_street'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->main_street ? $user->main_street : trans('lang.without_main_street') !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('street_1_sec', trans('lang.street_1_sec'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->street_1_sec ? $user->street_1_sec : trans('lang.without_street_1_sec') !!}
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 ">

        <div class="form-group flex-col">
            {!! Form::label('street_2_sec', trans('lang.street_2_sec'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->street_2_sec ? $user->street_2_sec : trans('lang.without_street_2_sec') !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('address_ref', trans('lang.address_ref'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $user->address_ref ? $user->address_ref : trans('lang.without_address_ref') !!}
                </p>
            </div>
        </div>

    </div>
    @endif

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center space-x-2">
        <div>{{ trans('lang.data_pet') }}</div>
        @can('dashboard.pets.edit')
        <button>
            <a href="{{ route('dashboard.pets.edit', $pet) }}" class=''>
                <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
            </a>
        </button>
        @endcan
        @can('dashboard.pets.destroy')
        {!! Form::open(['route' => ['dashboard.pets.destroy', $pet], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
        'type' => 'submit',
        'class' => '',
        'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name')",
        ]) !!}
        {!! Form::close() !!}
        @endcan
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        {{-- Pet ID --}}
        <div class="form-group flex-col">
            {!! Form::label('pet_id', trans('lang.pet_id'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $pet->pet_id !!}
                </p>
            </div>
        </div>
        {{-- Pet name --}}
        <div class="form-group flex-col">
            {!! Form::label('namePet', trans('lang.namePet'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $pet->name !!}
                </p>
            </div>
        </div>
        {{-- Pet Specie --}}
        <div class="form-group flex-col">
            {!! Form::label('specie', trans('lang.specie'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! trans('lang.' . $pet->specie) !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('race', trans('lang.race'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $pet->race !!}
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5">

        <div class="form-group flex-col">
            {!! Form::label('sex', trans('lang.sexP'), ['class' => ' ']) !!}
            <div class="">
                <p>

                    @if ($pet->sex == '##########')
                    {{ $pet->sex }}
                    @else
                    {{ $pet->sex == 'M' ? trans('lang.maleP') : trans('lang.femaleP') }}
                    @endif
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('birth', trans('lang.birth'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $pet->birth !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('castrated', trans('lang.castrated'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $pet->castrated ? trans('lang.yep') : trans('lang.nop') !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('lost', trans('lang.lost'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $pet->lost ? trans('lang.yep') : trans('lang.nop') !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('n_lost', trans('lang.n_lost'), ['class' => ' ']) !!}
            <div class="">
                <p>
                    {!! $pet->n_lost !!}
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        <div class="form-group flex-col">
            {!! Form::label('pather', trans('lang.pather'), ['class' => ' ']) !!}
            <div class="">
                @if ($pet->id_pet_pather)
                <a href={{ route('dashboard.pets.show', $pet->id_pet_pather) }}>
                    {!! $pet->id_pet_pather !!}
                </a>
                @else
                <p>{{ trans('lang.it_doesnt_have') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('mother', trans('lang.mother'), ['class' => ' ']) !!}
            <div class="">
                @if ($pet->id_pet_mother)
                <a href={{ route('dashboard.pets.show', $pet->id_pet_mother) }}>
                    {!! $pet->id_pet_mother !!}
                </a>
                @else
                <p>{{ trans('lang.it_doesnt_have') }}</p>
                @endif
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
            <figure class="md:w-2/12 sm:w-1/4 w-2/4">
                <img src="{{$image->url}}" class="mb-2" />
            </figure>
            @endforeach
        </div>
    </div>
    @else
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase"> {{ trans('lang.not_photos_report') }} </h6>
    @endif

    @if(count($childs))
    <div class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center">{!!trans('lang.childs')!!} ({!! count($childs) !!})</div>

    <div class="w-full max-h-80 flex flex-row flex-wrap overflow-y-scroll">
        @foreach ($childs as $child)
        <div class="p-2 col-lg-4">
            <div class="border px-4 py-2 rounded-lg flex flex-row justify-between">
                <div class="flex flex-col">
                    <h4 class="uppercase font-bold">{!! $child->name !!}</h4>
                    <small class="uppercase">{!! $child->pet_id !!}</small>
                </div>
                <div class="flex items-center justify-center space-x-2">

                    @can('dashboard.pets.show')
                    <button>
                        <a href="{{ route('dashboard.pets.show', $child) }}" class="">
                            <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                        </a>
                    </button>
                    @endcan
                    @can('dashboard.pets.edit')
                    <button>
                        <a href="{{ route('dashboard.pets.edit', $child) }}" class=''>
                            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
                        </a>
                    </button>
                    @endcan

                    {!! Form::open(['route' => ['dashboard.deletePetChildren', $child], 'method' => 'delete']) !!}
                    {!! Form::button('<i class="fa fa-times-circle text-gray-500 hover:text-red-700"></i>', [
                    'type' => 'submit',
                    'class' => '',
                    'onclick' => "return confirm('¿Estás seguro que deseas quitar este hijo $child->name de este padre $pet->name? ')",
                    ]) !!}
                    {!! Form::close() !!}

                </div>
            </div>

        </div>
        @endforeach
    </div>
    @else
    <div class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center">{!!trans('lang.childs_doesnt_have')!!}</div>
    @endif

    @push('scripts_lib')
    <script src="//unpkg.com/alpinejs"></script>
    @endpush
</div>