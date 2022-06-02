<div>

    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

        <!-- specie pet -->
        <div class="px-2 md:mb-0 mb-2 flex items-center justify-between">

            <div class="flex flex-col w-full">
                {!! Form::label('id_specie', __('Species') . '*', ['class' => '']) !!}
                {!! Form::select('id_specie', $species, $race->id_specie, ['class' => 'select2 form-control', 'placeholder' => __('Select a specie'), 'required' => true]) !!}
                @error('id_specie')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4 pl-2">
                <a data-tooltip-target="tooltip-create-specie" href="{{ route('dashboard.species.create') }}" target="_blank">
                    <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                </a>
                <div id="tooltip-create-specie" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{__('A new tab will be open to add a specie')}}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>

        <!-- Name race -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', $race->name, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>