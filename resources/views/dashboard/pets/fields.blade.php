    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! trans('lang.label_info_pet_create') !!}
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mb-2">

        <!-- Pet_id -->
        <div class="flex flex-col px-2">
            {!! Form::label('pet_id', trans('lang.pet_id'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('pet_id', old('user_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'maxlength' => 13, 'required' => true]) !!}
            @error('pet_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pet name -->
        <div class="flex flex-col px-2">
            {!! Form::label('name', trans('lang.namePet'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pet Specie -->
        <div class="flex flex-col px-2">
            {!! Form::label('specie', trans('lang.specie'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('specie', ['canine' => trans('lang.canine'), 'feline' => trans('lang.feline')], $pet->specie ? $pet->specie : 'canine', ['class' => 'select2 form-control', 'required' => true]) !!}
            @error('specie')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pet Race -->
        <div class="flex flex-col px-2">
            {!! Form::label('race', trans('lang.race'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('race', old('race'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name2'), 'required' => true]) !!}
            @error('race')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mb-2">
        {{-- Sex --}}
        <div class="flex flex-col px-2">
            {!! Form::label('sex', trans('lang.sexP'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('sex', ['M' => trans('lang.maleP'), 'F' => trans('lang.femaleP')], $pet->sex, ['class' => 'select2 form-control', 'placeholder' => 'Selecciona el sexo']) !!}
            @error('sex')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Birth pet -->
        <div class="flex flex-col px-2">
            {!! Form::label('birth', trans('lang.birth'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::date('birth', old('birth'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'max' => date('Y-m-d')]) !!}
            @error('birth')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! trans('lang.label_info_pet_create_not_Required') !!}
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-4">
        {{-- parents --}}
        <div class="flex flex-col px-2">
            {!! Form::label('pather', trans('lang.pather'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('pather', $pather, $pet->id_pet_pather, ['placeholder' => '']) !!}

            @error('pather')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('mother', trans('lang.mother'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('mother', $mother, $pet->id_pet_mother, ['placeholder' => '']) !!}

            @error('mother')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="grid grid-cols-1  mb-4">
        <div class="flex flex-col col-span-2 px-2">
            {{-- childres --}}
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
                <div x-show="open">
                    {!! Form::select('childrens[]', $childrens, $childrensSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'childrens']) !!}
                    @error('pather')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1  mb-4">
        <div class="flex flex-col col-span-2 px-2">
            {{-- photos pet --}}
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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-4">
        {{-- Owner --}}
        <div class="flex flex-col px-2">
            {!! Form::label('user_id', trans('lang.duenio'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('user_id', $users, $pet->user_id , ['placeholder' => '']) !!}
            @error('user_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>

    </div>

    @push('scripts_lib')

    <script src="//unpkg.com/alpinejs"></script>
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script>
        $("[name='specie']").on('change', function() {
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
                    var specieValue = $("[name='specie']").val();
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
                    var specieValue = $("[name='specie']").val();
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
                    var specieValue = $("[name='specie']").val();
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