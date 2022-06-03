<div>

    {!! Form::hidden('pet_id', 'without', null) !!}

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! __('Pet information') !!}
    </h6>

    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 ">
        <!-- Name pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- specie pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('id_specie', __('Species') . '*', ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_specie', $species, null, ['class' => 'select2 form-control', 'placeholder' => __('Select a specie'), 'required' => true]) !!}
                <div class="">
                    <button type="button" data-toggle="modal" data-target="#ModalSpecie" data-tooltip-target="tooltip-create-specie" class="shadow-sm">
                        <i class="fa fa-plus bg-pink-300 hover:bg-pink-500 text-white p-2 text-xs rounded-sm"></i>
                    </button>
                    <div id="tooltip-create-specie" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{__('Create a specie')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>

            @error('id_specie')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- race of pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('id_race', __('Race') . '*', ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_race', $races, null, ['class' => 'select2 form-control', 'placeholder' => __('First select a specie'), 'required' => true]) !!}
                <div class="">
                    <button type="button" data-toggle="modal" data-target="#ModalRace" data-tooltip-target="tooltip-create-race" class="shadow-sm">
                        <i class="fa fa-plus bg-pink-300 hover:bg-pink-500 text-white p-2 text-xs rounded-sm"></i>
                    </button>
                    <div id="tooltip-create-race" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{__('Create a race')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>

            @error('id_race')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- 2 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:space-y-0 space-y-2">

        <!-- sex -->
        <div class="flex flex-col px-2">
            {!! Form::label('sex', __('Sex') . '*', ['class' => '']) !!}
            {!! Form::select('sex', ['M' => __('Male pet'), 'F' => __('Female pet')], null, ['class' => 'select2 form-control', 'placeholder' => __('Select a sex'), 'required' => true]) !!}
            @error('sex')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Birth -->
        <div class="flex flex-col px-2">
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

        <div class="flex flex-col px-2 md:mb-0 mb-2 col-span-2">
            {!! Form::label('id_fur', __('Fur'), ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_fur', $furs, null, ['class' => 'select2 form-control', 'placeholder' => __('First select a specie')]) !!}
                <div class="">
                    <button type="button" data-toggle="modal" data-target="#ModalFur" data-tooltip-target="tooltip-create-fur" class="shadow-sm">
                        <i class="fa fa-plus bg-pink-300 hover:bg-pink-500 text-white p-2 text-xs rounded-sm"></i>
                    </button>
                    <div id="tooltip-create-fur" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{__('Create a fur')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>

            @error('id_fur')
            <span class="text-danger">{{ $message }}</span>
            @enderror
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

    <!-- 3 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:space-y-0 space-y-2">

        <!-- castr -->
        <div class="flex flex-col px-2">
            <div class="form-group">
                <p class="font-weight-bold">{{ __('Castrated') }}</p>
                <label>
                    {!! Form::radio('castrated', 0, true) !!}
                    {{__('No')}}
                </label>
                <label>
                    {!! Form::radio('castrated', 1) !!}
                    {{__('Yes')}}
                </label>
                @error('castrated')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- lost -->
        <div class="flex flex-col px-2">

            <div class="form-group">
                <p class="font-weight-bold">{{ __('Lost') }}</p>
                <label>
                    {!! Form::radio('lost', 0, true) !!}
                    {{__('No')}}
                </label>
                <label>
                    {!! Form::radio('lost', 1) !!}
                    {{__('Yes')}}
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
            {!! Form::label('pather', __('Pather'), ['class' => '']) !!}
            {!! Form::select('pather', $pather, null, ['placeholder' => '']) !!}
            @error('pather')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- mother -->
        <div class="flex flex-col px-2">
            {!! Form::label('mother', __('Mother'), ['class' => '']) !!}
            {!! Form::select('mother', $mother, null, ['placeholder' => '']) !!}
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
                        {!! Form::label('childrens', __('Childrens'), ['class' => '']) !!}
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
                            <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                        </a>
                        <div id="tooltip-create-pet" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{__('A new tab will be open to add a pet')}}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 6 row -->
    <div class="grid grid-cols-1 sm:space-y-0 space-y-2 mb-3">
        <div class="flex flex-col col-span-2 px-2">

            <!-- photo pet -->
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
                    @livewire('images-edit' , ['currentFiles' => []])
                    <livewire:scripts :currentFiles="" />
                </div>
            </div>
        </div>
    </div>

    <!-- 7 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 sm:space-y-0 space-y-2 mb-3">
        <!-- owner -->

        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('user_id', __('Owner'), ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('user_id', $users, null, ['placeholder' => '']) !!}
                <div class="">
                    <a data-tooltip-target="tooltip-create-user" href="{{ route('dashboard.users.create') }}" target="_blank">
                        <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                    </a>
                    <div id="tooltip-create-user" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{__('A new tab will be open to add a user')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>

            @error('user_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


<button type="submit" class="float-right bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

<style>
    figure {
        width: 15%;
    }

    img {
        width: 100%;
    }
</style>

</div>


@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    window.onload = () => {
        document.querySelector("html").style.overflowX = "hidden";
    }
    $("[name='id_specie']").on('change', function() {

    });

    $("[name='sex']").on('change', function() {
        $('#childrens').val(null).trigger('change');
        $('#childrens').html('');
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
                    raceOptions = "<option selected value>Primero seleccione una especie</option>"
                else
                    raceOptions = "<option selected value>No hay razas para esa especie</option>"
            } else {
                raceOptions = "<option selected value>Seleccione una raza</option>";
                $.each(msg, function(i, races) {
                    raceOptions += '<option value="' + races.id + '">' + races.name + '</option>';
                });
            }
            $('#id_race').html(raceOptions);
            $('#id_race').trigger('change')
        });

        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{url('dashboard/getFursToSpeciesAjax')}}",
            data: {
                id_specie: $('#id_specie').val()
            }
        }).done(function(msg) {
            let furOptions;
            if (msg.length <= 0) {
                if (!$("#id_specie").val())
                    furOptions = "<option selected value>Primero seleccione una especie</option>"
                else
                    furOptions = "<option selected value>No hay pelajes para esa especie</option>"
            } else {
                furOptions = "<option selected value>Seleccione un pelaje</option>";
                $.each(msg, function(i, furs) {
                    furOptions += '<option value="' + furs.id + '">' + furs.name + '</option>';
                });
            }
            $('#id_fur').html(furOptions);
            $('#id_fur').trigger('change')
        });
    });

    $('#pather').select2({
        width: '100%',
        placeholder: "Digite el identificador del padre",
        minimumInputLength: 2,
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
        allowClear: true,
        ajax: {
            url: "{{url('dashboard/parents')}}",
            method: "POST",
            data: function(params) {
                var specieValue = $("[name='id_specie']").val();
                var childrensSeleted = $("#childrens").val();
                var query = {
                    search: params.term,
                    specie: specieValue,
                    pet_id: null,
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
                    pet_id: null,
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
                    pet_id: null,
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
</script>
<script>
    $('.add_specie').click(function(e) {
        e.preventDefault();
        var fur = $('#name_specie').val();
        $('.add_specie').attr('disabled', 'disabled');
        $('.add_specie').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            type: "POST",
            url: "{{url('dashboard/add-specie-modal')}}",
            data: {
                name: fur,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                if (data.error) {
                    $('.error_specie').html(data.error[0]);
                } else {
                    $('#id_specie').append(`<option value="${data.id}" selected>${data.name}</option>`);
                    $('#id_specie').trigger('change');
                    $('#name_specie').val('');
                    $('#ModalSpecie').modal('hide');
                }
                $('.add_specie').removeAttr('disabled');
                $('.add_specie').html('Guardar');
            },
            error: function(data) {
                console.log(data);
                $('.add_specie').removeAttr('disabled');
                $('.add_specie').html('Guardar');
            }
        })
    });
</script>

<script>
    $('.add_fur').click(function(e) {
        e.preventDefault();
        $('.add_fur').attr('disabled', 'disabled');
        $('.add_fur').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

        var fur = $('#name_fur').val();
        var id_specie = $('#id_specie').val();
        if (id_specie) {
            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-fur-modal')}}",
                data: {
                    name: fur,
                    id_specie,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_fur').html(data.error[0]);
                    } else {
                        $('#id_fur').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('#id_fur').trigger('change');
                        $('#name_fur').val('');
                        $('#ModalFur').modal('hide');
                    }
                    $('.add_fur').removeAttr('disabled');
                    $('.add_fur').html('Guardar');
                },
                error: function(data) {
                    console.log(data);
                    $('.add_fur').removeAttr('disabled');
                    $('.add_fur').html('Guardar');
                }
            })
        }
    });
    $('#ModalFur').on('show.bs.modal', function(event) {
        var modal = $(this)
        if (!$('#id_specie').val())
            modal.find('.header-error').text('Primero debes seleccionar una especie');
        else
            modal.find('.header-error').text('');
    })
</script>

<script>
    $('#id_race').select2({
        width: '100%'
    });

    $('.add_race').click(function(e) {
        e.preventDefault();
        var race = $('#name_race').val();
        var id_specie = $('#id_specie').val();

        if (id_specie) {
            $('.add_race').attr('disabled', 'disabled');
            $('.add_race').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-race-modal')}}",
                data: {
                    name: race,
                    id_specie,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_race').html(data.error[0]);
                    } else {
                        $('#id_race').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('#id_race').trigger('change');
                        $('#name_race').val('');
                        $('#ModalRace').modal('hide');
                    }
                    $('.add_race').removeAttr('disabled');
                    $('.add_race').html('Guardar');
                },
                error: function(data) {
                    console.log(data);
                    $('.add_race').removeAttr('disabled');
                    $('.add_race').html('Guardar');
                }
            })
        }
    });

    $('#ModalRace').on('show.bs.modal', function(event) {
        var modal = $(this)
        if (!$('#id_specie').val())
            modal.find('.header-error').text('Primero debes seleccionar una especie');
        else
            modal.find('.header-error').text('');
    })
</script>
@endpush