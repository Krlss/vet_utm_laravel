<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
        <!-- Name specie -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', $canton->name ?? null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- province -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('id_province', __('Province') , ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_province', $provinces, $canton->id_province ?? null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'id'=>'id_province', 'placeholder' => $provinces ? null : __('There are no provinces available... :(')]) !!}

                @can('dashboard.provinces.create')
                @if($lettersAvailable)
                <x-button-modal target="province" />
                @endif
                @endcan

            </div>

            @error('id_province')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>

@push('js')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>

@can('dashboard.provinces.create')
<script src="{{ asset('js/flowbite.js') }}"></script>
@endcan

@if($lettersAvailable)
@include('partials.js_modals.province')
@endif
@endpush