<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1">
        <!-- Name pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', trans('lang.name'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('name', $specie->name, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{trans('lang.save')}}</button>

</div>