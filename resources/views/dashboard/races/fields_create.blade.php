<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

        <!-- specie pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('id_specie', __('Species') . '*', ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_specie', $species, null, ['class' => 'select2 form-control', 'placeholder' => __('Select a specie'), 'required' => true]) !!}

                @can('dashboard.species.create')
                <x-button-modal target="specie" />
                @endcan

            </div>

            @error('id_specie')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Name race -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>

@push('js')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>

@can('dashboard.species.create')
<script src="{{ asset('js/flowbite.js') }}"></script>
@endcan

@include('partials.js_modals.specie')
@endpush