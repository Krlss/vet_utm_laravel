<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

        {!! Form::hidden('pet_id', old('pet_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'maxlength' => 13, 'required' => true]) !!}

        <div class="flex flex-col px-2">
            {!! Form::label('name', trans('lang.namePet'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('specie', trans('lang.specie'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('specie', ['##########' => 'Indefinido', 'canine' => trans('lang.canine'), 'feline' => trans('lang.feline')], $pet->specie ? $pet->specie : 'canine', ['class' => 'select2 form-control', 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('specie')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('race', trans('lang.race'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('race', old('race'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name2'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('race')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


    </div>

    {{--  --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

        {{-- Sex --}}
        <div class="flex flex-col px-2">
            {!! Form::label('sex', trans('lang.sexP'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('sex', ['##########' => 'Indefinido', 'M' => trans('lang.maleP'), 'F' => trans('lang.femaleP')], $pet->sex, ['class' => 'select2 form-control', 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
            </div>
            @error('sex')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('users', trans('lang.duenio'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('users', $users, $pet->user_id ? $pet->user_id : null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.select_owner')]) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
            </div>
            @error('users')
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

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

        {{-- Castrado --}}
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
        {{-- Perdido --}}
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

        {{-- Publicado --}}
        <div class="flex flex-col px-2">

            <div class="form-group">
                <p class="font-weight-bold">{{ trans('lang.published') }}</p>
                <label>
                    {!! Form::radio('published', 0, $pet->published ? true : false) !!}
                    {{ trans('lang.nop') }}
                </label>
                <label>
                    {!! Form::radio('published', 1, $pet->published ? true : false) !!}
                    {{ trans('lang.yep') }}
                </label>
                @error('published')
                    <br>
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>



        </div>


    </div>

    
</div>
