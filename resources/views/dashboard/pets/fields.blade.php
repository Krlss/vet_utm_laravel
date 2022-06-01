<div>
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! trans('lang.label_info_pet_create') !!}
    </h6>

    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">

        <!-- Pet_id -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('pet_id', trans('lang.pet_id'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('pet_id', old('user_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'maxlength' => 13, 'required' => true]) !!}
            @error('pet_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pet name -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', trans('lang.namePet'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pet Specie -->
        <div class="px-2 md:mb-0 mb-2 flex items-center justify-between">
            <div class="flex flex-col w-full">
                {!! Form::label('id_specie', trans('lang.specie'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                {!! Form::select('id_specie', $species, $pet->id_specie ? $pet->id_specie : null, ['class' => 'select2 form-control', 'required' => true, 'placeholder' => trans('lang.select_specie')]) !!}
                @error('id_specie')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4 pl-2">
                <a data-tooltip-target="tooltip-create-specie" href="{{ route('dashboard.species.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-logo hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-specie" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{trans('lang.create_new_specie_tooltip')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>

        <!-- Pet Race -->
        <div class="px-2 md:mb-0 mb-2 flex items-center justify-between">
            <div class="flex flex-col w-full">
                {!! Form::label('id_race', trans('lang.race'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                {!! Form::select('id_race', $races, $pet->id_race ? $pet->id_race : null, ['class' => 'select2 form-control', 'required' => true, 'placeholder' => trans('lang.select_race')]) !!}
                @error('id_race')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4 pl-2">
                <a data-tooltip-target="tooltip-create-race" href="{{ route('dashboard.races.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-logo hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-race" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{trans('lang.create_new_race_tooltip')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>

    </div>

    <!-- 2 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 sm:space-y-0 space-y-2 mb-2">
        <!-- sex -->
        <div class="flex flex-col px-2">
            {!! Form::label('sex', trans('lang.sexP'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('sex', ['M' => trans('lang.maleP'), 'F' => trans('lang.femaleP')], $pet->sex, ['class' => 'select2 form-control', 'placeholder' => 'Selecciona el sexo', 'required' => true]) !!}
            @error('sex')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Birth pet -->
        <div class="flex flex-col px-2">
            {!! Form::label('birth', trans('lang.birth'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::date('birth', old('birth'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'max' => date('Y-m-d'), 'required' => true]) !!}
            @error('birth')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! trans('lang.label_info_pet_create_not_Required') !!}
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex items-center justify-between w-full col-span-2">
            <div class="flex flex-col px-2 md:mb-0 mb-2 w-full">
                {!! Form::label('id_fur', trans('lang.fur'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                {!! Form::select('id_fur', $furs, $pet->id_fur, ['placeholder' => '']) !!}
                @error('id_fur')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-3">
                <a data-tooltip-target="tooltip-create-fur" href="{{ route('dashboard.furs.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-logo hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-fur" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{trans('lang.create_new_fur_tooltip')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex flex-col px-2 md:mb-0 mb-2 col-span-2">
            {!! Form::label('characteristic', trans('lang.characteristic'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::textarea('characteristic', old('characteristic'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.characteristic'), 'rows' => 2]) !!}
            @error('characteristic')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- 3 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:space-y-0 space-y-2 mb-2">

        <!-- Pet castrated -->
        <div class="flex flex-col px-2">

            <div class="form-group">
                <p class="font-weight-bold">{{ trans('lang.castrated') }}</p>
                <label>
                    {!! Form::radio('castrated', 0, $pet->castrated ? true : false) !!}
                    {{ trans('lang.nop') }}
                </label>
                <label>
                    {!! Form::radio('castrated', 1, $pet->castrated ? true : false) !!}
                    {{ trans('lang.yep') }}
                </label>
                @error('castrated')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <!-- Pet lost check -->
        <div class="flex flex-col px-2">

            <div class="form-group">
                <p class="font-weight-bold">{{ trans('lang.lost') }}</p>
                <label>
                    {!! Form::radio('lost', 0, $pet->lost ? true : false) !!}
                    {{ trans('lang.nop') }}
                </label>
                <label>
                    {!! Form::radio('lost', 1, $pet->lost ? true : false) !!}
                    {{ trans('lang.yep') }}
                </label>
                @error('lost')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

    </div>

    <!-- 4 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-3 sm:space-y-0 space-y-2">

        <!-- pather -->
        <div class="flex flex-col px-2">
            {!! Form::label('pather', trans('lang.pather'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('pather', $pather, $pet->id_pet_pather, ['placeholder' => '']) !!}
            @error('pather')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- mother -->
        <div class="flex flex-col px-2">
            {!! Form::label('mother', trans('lang.mother'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('mother', $mother, $pet->id_pet_mother, ['placeholder' => '']) !!}
            @error('mother')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <!-- 5 row -->
    <div class="grid grid-cols-1 sm:space-y-0 space-y-2 mb-3">
        <div class="flex flex-col col-span-2 pl-2">

            <!-- childrens -->
            <div x-data="{ open: true }">
                <div class="flex items-start">
                    <div>
                        {!! Form::label('childrens', trans('lang.childrens'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    </div>
                    <div class="ml-2 cursor-pointer">
                        <button @click="open=!open" type="button">
                            <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                            <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                        </button>
                    </div>
                </div>
                <div x-show="open" class="flex items-center">
                    <div class="w-full">
                        {!! Form::select('childrens[]', $childrens, $childrensSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'childrens']) !!}
                        @error('childrens')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="ml-2">
                        <a data-tooltip-target="tooltip-create-pet" href="{{ route('dashboard.pets.create') }}" target="_blank">
                            <i class="fa fa-plus bg-yellow-logo hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                        </a>
                        <div id="tooltip-create-pet" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{trans('lang.create_new_pet_tooltip')}}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 6 row -->
    <!-- CHILDS -->
    <livewire:pets.show-list-childs :currentsPets="$childs" :pet_id="$pet->pet_id" :pet_name="$pet->name" :pet_sex="$pet->sex" :delete="false" />
    @livewireScripts

    <!-- 7 row -->
    <div class="grid grid-cols-1 sm:space-y-0 space-y-2 mb-3 px-2">
        <div class="flex flex-col col-span-2">
            <!-- photos -->
            <div x-data="{ open: true }">
                <div class="flex items-start">
                    <div>
                        {!! Form::label('photo_pet', trans('lang.photo_pet'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
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
                {!! Form::label('user_id', trans('lang.duenio'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                {!! Form::select('user_id', $users, $pet->user_id , ['placeholder' => '']) !!}
                @error('user_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <a data-tooltip-target="tooltip-create-user" href="{{ route('dashboard.users.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-logo hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{trans('lang.create_new_user_tooltip')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>


    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>

</div>
@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $("[name='id_specie']").on('change', function() {
        $('#pather').val(null).trigger('change');
        $('#pather').html('');
        $('#mother').val(null).trigger('change');
        $('#mother').html('');
        $('#childrens').val(null).trigger('change');
        $('#childrens').html('');
    });

    $("[name='sex']").on('change', function() {
        $('#childrens').val(null).trigger('change');
        $('#childrens').html('');
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

    $('#pather').select2({
        width: '100%',
        placeholder: "Digite el identificador del padre",
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
                return "Por favor ingresa al menos dos letras... (identificador o nombre de la mascota)";
            }
        },
        ajax: {
            url: "{{url('dashboard/parents')}}",
            method: "POST",
            data: function(params) {
                var specieValue = $("[name='id_specie']").val();
                var childrensSeleted = $("#childrens").val();
                var query = {
                    search: params.term,
                    specie: specieValue,
                    pet_id: $("[name='pet_id']").val(),
                    childrensSeleted: childrensSeleted,
                    sex: 'M',
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            dataType: "json",
            processResults: function(data) {
                return {
                    results: $.map(data, function(pet) {
                        return {
                            text: pet.name + " - " + pet.pet_id,
                            id: pet.pet_id
                        }
                    })
                };
            }
        }
    });

    $('#mother').select2({
        width: '100%',
        placeholder: "Digite el identificador de la madre",
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
                return "Por favor ingresa al menos dos letras... (identificador o nombre de la mascota)";
            }
        },
        ajax: {
            url: "{{url('dashboard/parents')}}",
            method: "POST",
            data: function(params) {
                var specieValue = $("[name='id_specie']").val();
                var childrensSeleted = $("#childrens").val();
                var query = {
                    search: params.term,
                    specie: specieValue,
                    pet_id: $("[name='pet_id']").val(),
                    childrensSeleted: childrensSeleted,
                    sex: 'F',
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            dataType: "json",
            processResults: function(data) {
                return {
                    results: $.map(data, function(pet) {
                        return {
                            text: pet.name + " - " + pet.pet_id,
                            id: pet.pet_id
                        }
                    })
                };
            }
        }
    });

    $('#user_id').select2({
        width: '100%',
        placeholder: "Digite la cedula o RUC del dueño",
        minimumInputLength: 2,
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
        allowClear: true,
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

    $('#childrens').select2({
        width: '100%',
        placeholder: "Digita los identificadores de las mascotas",
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
                return "Por favor ingresa al menos dos letras... (identificador o nombre de la mascota)";
            }
        },
        ajax: {
            url: "{{url('dashboard/childrens')}}",
            dataType: 'json',
            method: "POST",
            data: function(params) {
                var specieValue = $("[name='id_specie']").val();
                var query = {
                    search: params.term,
                    specie: specieValue,
                    pet_id: $("[name='pet_id']").val(),
                    pather_seleted: $("[name='pather']").val(),
                    mother_seleted: $("[name='mother']").val(),
                    sex: $("[name='sex']").val(),
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            processResults: function(data) {
                data.pets = data.pets.map(function(obj) {
                    return {
                        "text": obj.name + " - " + obj.pet_id,
                        "id": obj.pet_id
                    };
                });
                return {
                    results: data.pets
                };
            },
            cache: true
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

    /*        $(document).ready(() => {


               $.ajax({
                   url: "{{url('dashboard/pet/childrens')}}",
                   dataType: 'json',
                   method: "POST",
                   data: {
                       "_token": "{{csrf_token()}}",
                       pet_id: $('#pet_id').val()
                   },
                   xhr: () => {
                       let xhr = new XMLHttpRequest();
                       xhr.upload.onprogress = (e) => {
                           let percent = (e.loaded / e.total) * 100;
                           percent = percent - 2;
                           document.getElementById('progress_childrens').style.width = percent + '%';
                       };
                       return xhr;
                   },
               }).done(function(data) {
                   console.log(data);
                   document.getElementById('progress_childrens').style.width = '0%';
                   let petsOptions = '';
                   $('#childrens').val(null).trigger('change');
                   $.each(data.pets, function(i, pets) {
                       petsOptions += '<option value="' + pets.pet_id + '">' + pets.pet_id + '</option>';
                   });
                   $('#childrens').html(petsOptions);
               }).fail((xhr, textStatus) => {
                   console.log(xhr);
                   console.log(textStatus)
               });
           }) */
</script>
@endpush