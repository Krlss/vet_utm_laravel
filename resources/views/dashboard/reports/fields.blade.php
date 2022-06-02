<div>
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {{ __('Pet data') }}
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

        {!! Form::hidden('pet_id', old('pet_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'maxlength' => 13, 'required' => true]) !!}

        <div class="flex flex-col px-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pet Specie -->
        <div class="px-2 md:mb-0 mb-2 flex items-center justify-between">
            <div class="flex flex-col w-full">
                {!! Form::label('id_specie', __('Species') . '*', ['class' => '']) !!}
                {!! Form::select('id_specie', $species, $pet->id_specie ? $pet->id_specie : null, ['class' => 'select2 form-control', 'required' => true ,'placeholder' => __('Select a specie')]) !!}
                @error('id_specie')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @can('dashboard.species.create')
            <div class="mt-4 pl-2">
                <a data-tooltip-target="tooltip-create-specie" href="{{ route('dashboard.species.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-specie" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{__('A new tab will be open to add a specie')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            @endcan

        </div>

        <!-- Pet Race -->
        <div class="px-2 md:mb-0 mb-2 flex items-center justify-between">
            <div class="flex flex-col w-full">
                {!! Form::label('id_race', __('Race') . '*', ['class' => '']) !!}
                {!! Form::select('id_race', $races, $pet->id_race ? $pet->id_race : null, ['class' => 'select2 form-control', 'required' => true, 'placeholder' => __('First select a specie')]) !!}
                @error('id_race')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @can('dashboard.races.create')
            <div class="mt-4 pl-2">
                <a data-tooltip-target="tooltip-create-race" href="{{ route('dashboard.races.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-race" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{__('A new tab will be open to add a race')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            @endcan

        </div>


    </div>

    {{-- --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

        {{-- Sex --}}
        <div class="flex flex-col px-2 mt-2">
            {!! Form::label('sex', __('Sex') . '*', ['class' => '']) !!}
            {!! Form::select('sex', ['M' => __('Male pet'), 'F' => __('Female pet')], $pet->sex, ['class' => 'select2 form-control', 'placeholder' => __('Select a sex'), 'required' => true]) !!}
            @error('sex')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2 mt-2">
            <!-- Birth pet -->
            {!! Form::label('birth', __('Birth date') . '*', ['class' => '']) !!}
            {!! Form::date('birth', old('birth'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'max' => date('Y-m-d'), 'required' => true]) !!}
            @error('birth')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! __('Pet information not required') !!}
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex items-center justify-between w-full col-span-2">
            <div class="flex flex-col px-2 md:mb-0 mb-2 w-full">
                {!! Form::label('id_fur', __('Fur'), ['class' => '']) !!}
                {!! Form::select('id_fur', $furs, $pet->id_fur, ['placeholder' => '']) !!}
                @error('id_fur')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @can('dashboard.furs.create')
            <div class="mt-3">
                <a data-tooltip-target="tooltip-create-fur" href="{{ route('dashboard.furs.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-fur" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{__('A new tab will be open to add a fur')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            @endcan

        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex flex-col px-2 md:mb-0 mb-2 col-span-2">
            {!! Form::label('characteristic', __('Characteristic'), ['class' => '']) !!}
            {!! Form::textarea('characteristic', old('characteristic'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Characteristic'), 'rows' => 2]) !!}
            @error('characteristic')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

        {{-- Castrado --}}
        <div class="flex flex-col px-2">
            <div class="form-group">
                <p class="font-weight-bold">{{ __('Castrated') }}</p>
                <label>
                    {!! Form::radio('castrated', 0, $pet->castrated ?? false) !!}
                    {{ __('No') }}
                </label>
                <label>
                    {!! Form::radio('castrated', 1, $pet->castrated ?? false) !!}
                    {{ __('Yes') }}
                </label>
                @error('castrated')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>
        {{-- Perdido --}}
        <div class="flex flex-col px-2">
            <div class="form-group">
                <p class="font-weight-bold">{{ __('Lost') }}</p>
                <label>
                    {!! Form::radio('lost', 0, $pet->lost ?? false) !!}
                    {{ __('No') }}
                </label>
                <label>
                    {!! Form::radio('lost', 1, $pet->lost ?? false) !!}
                    {{ __('Yes') }}
                </label>
                @error('lost')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        {{-- Publicado --}}
        <div class="flex flex-col px-2">

            <div class="form-group">
                <p class="font-weight-bold">{{ __('Published') }}</p>
                <label>
                    {!! Form::radio('published', 0, $pet->published ?? false) !!}
                    {{ __('No') }}
                </label>
                <label>
                    {!! Form::radio('published', 1, $pet->published ?? false) !!}
                    {{ __('Yes') }}
                </label>
                @error('published')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>



        </div>


    </div>

    <div class="grid grid-cols-1  mb-4">
        <div class="flex flex-col col-span-2 px-2">
            {{-- photos pet --}}
            <div x-data="{ open: true }">
                <div class="flex items-start">
                    <div>
                        {!! Form::label('photo_pet', __('Pet photos'), ['class' => '']) !!}
                    </div>
                    <div class="ml-2 cursor-pointer">
                        <button @click="open=!open" type="button">
                            <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                            <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                        </button>
                    </div>
                </div>
                <div x-show="open">
                    @livewire('images-edit', ['currentFiles' => $images_])
                    <livewire:scripts />
                </div>
            </div>
        </div>
    </div>

    <!-- 8 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 sm:space-y-0 space-y-2 mb-3">
        <!-- owner -->
        <div class="flex items-center w-full">
            <div class="flex flex-col px-2 w-full">
                {!! Form::label('user_id', __('Owner'), ['class' => '']) !!}
                {!! Form::select('user_id', $users, $pet->user_id , ['placeholder' => '']) !!}
                @error('user_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @can('dashboard.users.create')
            <div class="mt-4">
                <a data-tooltip-target="tooltip-create-user" href="{{ route('dashboard.users.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{__('A new tab will be open to add a user')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            @endcan

        </div>
    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>

@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $('#user_id').select2({
        width: '100%',
        placeholder: "Digite la cedula o RUC del dueño",
        minimumInputLength: 2,
        allowClear: true,
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            },
            inputTooShort: function() {
                return "Por favor ingresa al menos dos letras... (cedula, ruc o nombres del usuario)";
            }
        },
        ajax: {
            url: "{{url('dashboard/pet/user')}}",
            method: "POST",
            data: function(params) {
                var query = {
                    search: params.term,
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            dataType: "json",
            processResults: function(data) {
                return {
                    results: $.map(data, function(user) {
                        return {
                            text: user.name + " " + user.last_name1 + " " + user.last_name2 + " - " + user.user_id,
                            id: user.user_id
                        }
                    })
                };
            }
        }
    });

    $('#id_fur').select2({
        width: '100%',
        placeholder: "Digite el nombre del pelaje",
        minimumInputLength: 2,
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            },
            inputTooShort: function() {
                return "Por favor ingresa al menos dos letras...";
            }
        },
        allowClear: true,
        ajax: {
            url: "{{url('dashboard/getFurs')}}",
            method: "POST",
            data: function(params) {
                var query = {
                    search: params.term,
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            dataType: "json",
            processResults: function(data) {
                return {
                    results: $.map(data, function(fur) {
                        return {
                            text: fur.name,
                            id: fur.id
                        }
                    })
                };
            }
        }
    });

    $('#id_specie').on('change', function() {
        $('#id_race').html('');
        $("#id_race").val([]);
        $('#pather').val(null).trigger('change');
        $('#pather').html('');
        $('#mother').val(null).trigger('change');
        $('#mother').html('');
        $('#childrens').val(null).trigger('change');
        $('#childrens').html('');
        $('#select2-id_race-container').html('');

        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{url('dashboard/getRacesToSpeciesAjax')}}",
            data: {
                id_specie: $('#id_specie').val()
            }
        }).done(function(msg) {
            let raceOptions;
            if (msg.length <= 0) {
                if (!$("#id_specie").val())
                    raceOptions = "<option value>Primero seleccione una especie</option>"
                else
                    raceOptions = "<option value>No hay razas para esa especie</option>"
            } else {
                raceOptions = "<option value>Seleccione una raza</option>";
                $.each(msg, function(i, races) {
                    raceOptions += '<option value="' + races.id + '">' + races.name + '</option>';
                });
            }
            $('#id_race').html(raceOptions);
        });
    });
</script>
@endpush