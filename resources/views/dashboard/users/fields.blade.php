<div>

    <div x-data="{ open: true }">
        <h6 class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center">
            {!! trans('lang.label_info_user_create') !!}
            <div class="ml-2 cursor-pointer">
                <button @click="open=!open" type="button">
                    <div x-show="!open" class="text-gray-400"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open" class="text-gray-400"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </h6>
        <div x-show="open">
            <!-- user_id, name, lastnames -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col px-2">
                    {!! Form::label('user_id', trans('lang.tableUserID'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::input('number', 'user_id', old('user_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'maxlength' => 13, 'required' => true]) !!}
                    @error('user_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col px-2">
                    {!! Form::label('name', trans('lang.namesUser'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'required' => true]) !!}
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col px-2">
                    {!! Form::label('last_name1', trans('lang.last_name1'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::text('last_name1', old('last_name1'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name1'), 'required' => true]) !!}
                    @error('last_name1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col px-2">
                    {!! Form::label('last_name2', trans('lang.last_name2'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::text('last_name2', old('last_name2'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name2'), 'required' => true]) !!}
                </div>
                @error('last_name2')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            {{-- email, phone, role --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-2">
                <div class="flex flex-col px-2">
                    {!! Form::label('email', trans('lang.email'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.email'), 'required' => true, 'type' => 'email']) !!}
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col px-2">
                    {!! Form::label('phone', trans('lang.phone'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::input('number', 'phone', old('phone'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.phone')]) !!}
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @can('dashboard.users.role')
                <div class="flex flex-col px-2">
                    {!! Form::label('roles', trans('lang.role'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::select('roles', $roles, count($user->roles) ? $user->roles[0]->id : null, ['class' => 'select2 form-control', 'required' => true]) !!}
                    @error('roles')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endcan
            </div>
        </div>
    </div>

    <div x-data="{ open: true }">
        <h6 class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center">
            {!!trans('lang.label_info_user_contact')!!}
            <div class="ml-2 cursor-pointer">
                <button @click="open=!open" type="button">
                    <div x-show="!open" class="text-gray-400"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open" class="text-gray-400"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </h6>

        <div x-show="open">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-2">

                <div class="flex flex-col px-2">
                    {!! Form::label('id_province', trans('lang.province'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::select('id_province', $provinces, $province ? $province->id : null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.select_province')]) !!}
                    @error('id_province')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col px-2">
                    {!! Form::label('id_canton', trans('lang.canton'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::select('id_canton', $cantons, $canton ? $canton->id : null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.select_canton')]) !!}
                    @error('id_canton')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Parroquias -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mb-2">

                <div class="flex flex-col col-span-2 px-2">
                    {!! Form::label('id_parish', trans('lang.parishe'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::select('id_parish', $parishes, $parish ? $parish->id : null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.fist_selected_canton')]) !!}
                    @error('id_parishes')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            <!-- Street and refe -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('main_street', trans('lang.main_street'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::text('main_street', old('main_street'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.main_street')]) !!}
                    @error('main_street')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- sec 1 -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('street_1_sec', trans('lang.street_1_sec'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::text('street_1_sec', old('street_1_sec'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.street_1_sec')]) !!}
                    @error('street_1_sec')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- sec 2 -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('street_2_sec', trans('lang.street_2_sec'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::text('street_2_sec', old('street_2_sec'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.street_2_sec')]) !!}
                    @error('street_2_sec')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- address ref -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('address_ref', trans('lang.address_ref'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::textarea('address_ref', old('address_ref'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.address_ref'), 'rows' => 3]) !!}
                    @error('address_ref')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div x-data="{open: true}">
        <h6 class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center">
            {!! trans('lang.label_info_user_pets') !!}
            <div class="ml-2 cursor-pointer">
                <button @click="open=!open" type="button">
                    <div x-show="!open" class="text-gray-400"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open" class="text-gray-400"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </h6>

        <div x-show="open">
            <div class="grid grid-cols-1 mb-2">
                <div class="flex flex-col col-span-2 px-2">
                    {{-- pets --}}

                    {!! Form::label('pets_array', trans('lang.pets'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
                    {!! Form::select('pets_array[]', $pets_array, $petsSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'pets_array']) !!}
                    @error('pets_array')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
            </div>

            <div class="px-2 mt-4">
                <a data-tooltip-target="tooltip-create-pet" href="{{ route('dashboard.pets.create') }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md font-semibold px-4 hover:underline">Crear una nueva mascota</a>
                <div id="tooltip-create-pet" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{trans('lang.create_new_pet_tooltip')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>

    <livewire:users.show-list-pets :currentsPets="$pets" :user_id="$user->user_id" :delete="false" />
    @livewireScripts

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-4 mb-2 rounded-md text-whire font-medium text-white">Guardar</button>

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</div>

@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        var cantoncurrent = "<?php echo $canton ? $canton->id : null; ?>";
        var parishecurrent = "<?php echo $parish ? $parish->id : null; ?>";
        var provincecurrent = "<?php echo $province ? $province->id : null; ?>";
        $('#id_canton').val(null);
        $('#id_canton').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons') }}",
            data: {
                id_province: provincecurrent
            }
        }).done(function(msg) {
            let cantonsOptions;
            if (msg.length <= 0) {
                cantonsOptions = "<option value>Primero selecciona una provincia</option>";
            } else {
                cantonsOptions = "<option value>Selecciona un canton</option>";
            }
            $.each(msg, function(i, canton) {
                if (cantoncurrent == canton.id) {
                    cantonsOptions += '<option selected="selected" value="' + canton.id + '">' + canton.name + '</option>';
                } else {
                    cantonsOptions += '<option value="' + canton.id + '">' + canton.name + '</option>';
                }
            });
            $('#id_canton').html(cantonsOptions);
        });

        $('#id_parish').val(null);
        $('#id_parish').html('');
        /* Parroquias.. */
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons/parishes') }}",
            data: {
                id_canton: cantoncurrent
            }
        }).done(function(msg) {
            let parishesOptions;
            if (msg.length <= 0) {
                parishesOptions = "<option value>Primero selecciona un cantón</option>"
            } else {
                parishesOptions = "<option value>Seleccione una parroquia</option>";
            }
            $.each(msg, function(i, parishe) {
                if (parishecurrent == parishe.id) {
                    parishesOptions += '<option selected="selected" value="' + parishe.id + '">' + parishe.name + '</option>';
                } else {
                    parishesOptions += '<option value="' + parishe.id + '">' + parishe.name + '</option>';
                }
            });
            $('#id_parish').html(parishesOptions);
        });
    });
</script>

<script>
    $('#id_province').on('change', function() {
        $('#id_canton').html('');
        $("#id_canton").val([]);
        $('#id_parish').html('');
        $("#id_parish").val([]);
        $('#select2-id_canton-container').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons') }}",
            data: {
                id_province: $('#id_province').val()
            }
        }).done(function(msg) {
            let cantonsOptions;
            $('#id_parish').html("<option value>Primero selecciona un cantón</option>");
            if (msg.length <= 0) {
                cantonsOptions = '<option value>Primero selecciona una provincia</option>'
            } else {
                cantonsOptions = "<option value>Selecciona un canton</option>";
                $.each(msg, function(i, canton) {
                    cantonsOptions += '<option value="' + canton.id + '">' + canton.name + '</option>';
                });
            }
            $('#id_canton').html(cantonsOptions);
        });
    });

    $('#id_canton').on('change', function() {
        $('#id_parish').html('');
        $("#id_parish").val([]);
        $('#select2-id_parish-container').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons/parishes') }}",
            data: {
                id_canton: $('#id_canton').val()
            }
        }).done(function(msg) {
            let parishesOptions;
            if (msg.length <= 0) {
                parishesOptions = "<option value>Primero selecciona un cantón</option>"
            } else {
                parishesOptions = "<option value>Seleccione una parroquia</option>";
                $.each(msg, function(i, parishes) {
                    parishesOptions += '<option value="' + parishes.id + '">' + parishes.name + '</option>';
                });
            }
            $('#id_parish').html(parishesOptions);
        });
    });

    $('#pets_array').select2({
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
            url: "{{url('dashboard/PetsWithoutOwner')}}",
            dataType: 'json',
            method: "POST",
            data: function(params) {
                var query = {
                    search: params.term,
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
@endpush