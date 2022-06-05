<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
        <!-- 1 row -->
        <div class="grid grid-cols-1">
            <!-- Name pet -->
            <div class="flex flex-col px-2 md:mb-0 mb-2">
                {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
                {!! Form::text('name', $fur->name, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('id_specie', __('Species') , ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_specie[]', $species, $speciesSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'id_specie']) !!}

                @can('dashboard.species.create')
                <x-button-modal target="specie" />
                @endcan

            </div>

            @error('id_specie')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <x-submit-button-default />

</div>

@push('js')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $('#id_specie').select2({
        width: '100%'
    });
</script>

@can('dashboard.species.create')
<script src="{{ asset('js/flowbite.js') }}"></script>
@endcan

@include('partials.js_modals.specie')
@endpush