<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
        <!-- Name -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', $parish->name ?? null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Cantons -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('id_canton', __('Cantons') , ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_canton', $cantons, $parish->id_canton ?? null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'id'=>'id_canton', 'placeholder' => $cantons ? null : __('There are no cantons available... :(')]) !!}

                @can('dashboard.cantons.create')
                <x-button-modal target="canton" />
                @endcan

            </div>

            @error('id_canton')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>


@push('js')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>

@can('dashboard.cantons.create')
<script src="{{ asset('js/flowbite.js') }}"></script>
@endcan

@include('partials.js_modals.canton')

@endpush