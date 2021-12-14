<div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        {{-- Name pet --}}
        <div class="flex flex-col px-2">
            {!! Form::label('name', trans('lang.namePet'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.namePet'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- specie pet --}}
        <div class="flex flex-col px-2">
            {!! Form::label('specie', trans('lang.specie'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('specie', ['canine' => trans('lang.canine'), 'feline' => trans('lang.feline')], 'canine', ['class' => 'select2 form-control', 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('specie')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Race of pet --}}
        <div class="flex flex-col px-2">
            {!! Form::label('race', trans('lang.race'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('race', old('race'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.race'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('race')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- lost of pet --}}
        <div class="flex flex-col px-2">

            <div class="form-group">
                <p class="font-weight-bold">{{ trans('lang.lost') }}</p>
                <label>
                    {!! Form::radio('lost', 0, true) !!}
                    No
                </label>
                <label>
                    {!! Form::radio('lost', 1) !!}
                    Si
                </label>
                @error('lost')
                    <br>
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        {{-- Sex --}}
        <div class="flex flex-col px-2">
            {!! Form::label('sex', trans('lang.sexP'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('sex', ['M' => trans('lang.maleP'), 'F' => trans('lang.femaleP')], null, ['class' => 'select2 form-control', 'placeholder' => 'Selecciona el sexo']) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
            </div>
            @error('sex')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Owner --}}
        <div class="flex flex-col px-2">
            {!! Form::label('user_id', trans('lang.duenio'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('user_id', $users, null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.select_owner')]) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.not_required') }}</div>
            </div>
            @error('user_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            <!-- Birth pet -->
            {!! Form::label('birth', trans('lang.birth'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::date('birth', old('birth'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'max' => date('Y-m-d')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.birth') }}
                </div>
            </div>
            @error('birth')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- castrated pet --}}
        <div class="flex flex-col px-2">
            <div class="form-group">
                <p class="font-weight-bold">{{ trans('lang.castrated') }}</p>
                <label>
                    {!! Form::radio('castrated', 0, true) !!}
                    No
                </label>
                <label>
                    {!! Form::radio('castrated', 1) !!}
                    Si
                </label>
                @error('castrated')
                    <br>
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        {{-- parents --}}
        <div class="flex flex-col px-2">
            {!! Form::label('pather', trans('lang.pather'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('pather', $pather, null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.select_pather')]) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.not_required') }}</div>
            </div>
            @error('pather')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('mother', trans('lang.mother'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('mother', $mother, null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.select_mother')]) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.not_required') }}</div>
            </div>
            @error('mother')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <button type="submit"
        class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>
</div>


@push('scripts_lib')
    <script>
        $("[name='specie']").on('change', function() {
            var specieValue = $("[name='specie']").val(); 
            $.ajax({
                method: "GET",
                url: "{{ url('dashboard/parents') }}",
                data: {
                    specie: specieValue
                }
            }).done(function(msg) {
                let pather;
                let mother;
                pather = `<option value='null' >Selecciona un padre</option>`
                mother = `<option value='null' >Selecciona una madre</option>`
                $.each(msg, function(i, parent) {                    
                    console.log(parent);
                    if (parent.sex == 'M') {
                        pather += `<option value=${parent.pet_id}>${parent.pet_id}</option>`;
                    } else {
                        mother += `<option value=${parent.pet_id}>${parent.pet_id}</option>`;
                    }
                });
                $("[name='pather'] option").empty();
                $("[name='pather']").html(pather);
                $("[name='mother'] option").empty();
                $("[name='mother']").html(mother);
            });
        });
    </script>
@endpush
