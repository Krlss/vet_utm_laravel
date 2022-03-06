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
    </div>

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! trans('lang.label_info_pet_create_not_Required') !!}
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

        <!-- Birth pet -->
        <div class="flex flex-col px-2">
            {!! Form::label('birth', trans('lang.birth'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::date('birth', old('birth'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'max' => date('Y-m-d')]) !!}
            @error('birth')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

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
            <div class="text-gray-500 text-sm mb-2">
                {{ trans('lang.pather_id_type') }}
            </div>
            @error('pather')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('mother', trans('lang.mother'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('mother', $mother, $pet->id_pet_mother, ['placeholder' => '']) !!}
            <div class="text-gray-500 text-sm mb-2">
                {{ trans('lang.mother_id_type') }}
            </div>
            @error('mother')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Owner --}}
        <div class="flex flex-col px-2">
            {!! Form::label('user_id', trans('lang.duenio'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('user_id', $users, $pet->user_id , ['placeholder' => '']) !!}
            <div class="text-gray-500 text-sm mb-2">
                {{ trans('lang.owner_id_type') }}
            </div>
            @error('user_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>
    </div>

    @push('scripts_lib')
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script>
        $("[name='specie']").on('change', function() {
            $('#pather').val(null).trigger('change');
            $('#pather').html('');
            $('#mother').val(null).trigger('change');
            $('#mother').html('');
        });

        $('#pather').select2({
            ajax: {
                url: "{{url('dashboard/parents')}}",
                method: "POST",
                data: function(params) {
                    var specieValue = $("[name='specie']").val();
                    var query = {
                        search: params.term,
                        specie: specieValue,
                        sex: 'M',
                        "_token": "{{csrf_token()}}"
                    }
                    return query;
                },
                dataType: "json",
                processResults: function(data) {
                    return {
                        results: $.map(data, function(pet) {
                            if (pet.pet_id === $('#pet_id').val()) return {
                                text: null,
                                id: null
                            }
                            else {
                                return {
                                    text: pet.pet_id,
                                    id: pet.pet_id
                                }
                            }
                        })
                    };
                }
            }
        });

        $('#mother').select2({
            ajax: {
                url: "{{url('dashboard/parents')}}",
                method: "POST",
                data: function(params) {
                    var specieValue = $("[name='specie']").val();
                    var query = {
                        search: params.term,
                        specie: specieValue,
                        sex: 'F',
                        "_token": "{{csrf_token()}}"
                    }
                    return query;
                },
                dataType: "json",
                processResults: function(data) {
                    return {
                        results: $.map(data, function(pet) {
                            if (pet.pet_id === $('#pet_id').val()) return {
                                text: null,
                                id: null
                            }
                            else {
                                return {
                                    text: pet.pet_id,
                                    id: pet.pet_id
                                }
                            }
                        })
                    };
                }
            }
        });

        $('#user_id').select2({
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
                                text: user.user_id,
                                id: user.user_id
                            }
                        })
                    };
                }
            }
        });
    </script>
    @endpush