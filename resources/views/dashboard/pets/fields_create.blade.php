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
                {!! Form::text('specie', old('specie'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.specie'), 'required' => true]) !!}
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
                {!! Form::select('sex', ['M' => trans('lang.maleP'), 'F' => trans('lang.femaleP')], 'M', ['class' => 'select2 form-control', 'required' => true]) !!}
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
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
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


    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        <!-- Food Id Field -->
        <div class="form-group row ">
            {!! Form::label('id_pet_pather', trans('lang.slide_food_id'), ['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
                {!! Form::select('id_pet_pather', $food, null, ['data-empty' => trans('lang.slide_food_id_placeholder'), 'class' => ' not-required form-control', 'id' => 'food_id']) !!}
                <div class="progress" style="max-height: 2px">
                    <div class="progress-bar" style="max-height: 2px" id="progress_products" role="progressbar"
                        style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="form-text text-muted">{{ trans('lang.slide_food_id_help') }}</div>
            </div>
        </div>
    </div> --}}

    <button type="submit"
        class="float-right bg-blue-500 hover:bg-blue-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>
</div>
