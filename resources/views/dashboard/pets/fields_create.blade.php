<div>

    {!! Form::hidden('pet_id', null, null) !!}

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! __('Pet information') !!}
    </h6>

    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 ">
        <!-- Name pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

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

        <!-- race of pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('id_race', __('Race') . '*', ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_race', $races, null, ['class' => 'select2 form-control', 'placeholder' => __('First select a specie'), 'required' => true]) !!}

                @can('dashboard.races.create')
                <x-button-modal target="race" />
                @endcan

            </div>

            @error('id_race')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- 2 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:space-y-0 space-y-2">

        <!-- sex -->
        <div class="flex flex-col px-2">
            {!! Form::label('sex', __('Sex') . '*', ['class' => '']) !!}
            {!! Form::select('sex', ['M' => __('Male pet'), 'F' => __('Female pet')], null, ['class' => 'select2 form-control', 'placeholder' => __('Select a sex'), 'required' => true]) !!}
            @error('sex')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Birth -->
        <div class="flex flex-col px-2">
            {!! Form::label('birth', __('Birth date') . '*', ['class' => '']) !!}
            {!! Form::date('birth', old('birth'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'max' => date('Y-m-d'), 'required' => true]) !!}
            @error('birth')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! __('Pet information not required') !!}
    </h6>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">

        <div class="flex flex-col px-2 md:mb-0 mb-2 col-span-2">
            {!! Form::label('id_fur', __('Fur'), ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_fur', $furs, null, ['class' => 'select2 form-control', 'placeholder' => __('First select a specie')]) !!}

                @can('dashboard.furs.create')
                <x-button-modal target="fur" />
                @endcan

            </div>

            @error('id_fur')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex flex-col px-2 md:mb-0 mb-2 col-span-2">
            {!! Form::label('characteristic', __('Characteristic'), ['class' => '']) !!}
            {!! Form::textarea('characteristic', old('characteristic'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Characteristic'), 'rows' => 2]) !!}
            @error('characteristic')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- 3 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:space-y-0 space-y-2">

        <!-- castr -->
        <div class="flex flex-col px-2">
            <div class="form-group">
                <p class="font-weight-bold">{{ __('Castrated') }}</p>
                <label>
                    {!! Form::radio('castrated', 0, true) !!}
                    {{__('No')}}
                </label>
                <label>
                    {!! Form::radio('castrated', 1) !!}
                    {{__('Yes')}}
                </label>
                @error('castrated')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- lost -->
        <div class="flex flex-col px-2">

            <div class="form-group">
                <p class="font-weight-bold">{{ __('Lost') }}</p>
                <label>
                    {!! Form::radio('lost', 0, true) !!}
                    {{__('No')}}
                </label>
                <label>
                    {!! Form::radio('lost', 1) !!}
                    {{__('Yes')}}
                </label>
                @error('lost')
                <br>
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>
    </div>

    <!-- 4 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-3 sm:space-y-0 space-y-2">

        <!-- pather -->
        <div class="flex flex-col px-2">
            {!! Form::label('pather', __('Pather'), ['class' => '']) !!}
            {!! Form::select('pather', $pather, null, ['placeholder' => '']) !!}
            @error('pather')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- mother -->
        <div class="flex flex-col px-2">
            {!! Form::label('mother', __('Mother'), ['class' => '']) !!}
            {!! Form::select('mother', $mother, null, ['placeholder' => '']) !!}
            @error('mother')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <!-- 5 row -->
    <div class="grid grid-cols-1 sm:space-y-0 space-y-2 mb-3">
        <div class="flex flex-col col-span-2 pl-2">

            <!-- childrens -->
            <div x-data="{ open: true }">
                <div class="flex items-start">
                    <div>
                        {!! Form::label('childrens', __('Childrens'), ['class' => '']) !!}
                    </div>
                    <div class="ml-2 cursor-pointer">
                        <button @click="open=!open" type="button">
                            <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                            <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                        </button>
                    </div>
                </div>
                <div x-show="open" class="flex items-center gap-2">
                    <div class="w-full">
                        {!! Form::select('childrens[]', $childrens, $childrensSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'childrens']) !!}
                        @error('childrens')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @can('dashboard.pets.create')
                    <x-button-new-tab-blank target="pet" />
                    @endcan

                </div>
            </div>
        </div>
    </div>

    <!-- 6 row -->
    <div class="grid grid-cols-1 sm:space-y-0 space-y-2 mb-3">
        <div class="flex flex-col col-span-2 px-2">

            <!-- photo pet -->
            <div x-data="{ open: true }">
                <div class="flex items-start">
                    <div>
                        {!! Form::label('photo_pet', __('Pet photos'), ['class' => '']) !!}
                    </div>
                    <div class="ml-2 cursor-pointer">
                        <button @click="open=!open" type="button">
                            <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                            <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                        </button>
                    </div>
                </div>
                <div x-show="open">
                    @livewire('images-edit' , ['currentFiles' => []])
                    <livewire:scripts :currentFiles="" />
                </div>
            </div>
        </div>
    </div>

    <!-- 7 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 sm:space-y-0 space-y-2 mb-3">
        <!-- owner -->

        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('user_id', __('Owner'), ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('user_id', $users, null, ['placeholder' => '']) !!}

                @can('dashboard.users.create')
                <x-button-new-tab-blank target="user" />
                @endcan

            </div>

            @error('user_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


<button type="submit" class="float-right bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

<style>
    figure {
        width: 15%;
    }

    img {
        width: 100%;
    }
</style>

</div>


@push('js')
<script src="{{ asset('js/alpine.min.js') }}"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script src="{{ asset('js/flowbite.js') }}"></script>
<script>
    $("[name='sex']").on('change', function() {
        $('#childrens').val(null).trigger('change');
        $('#childrens').html('');
    });
</script>

@include('partials.js_select2.pather')
@include('partials.js_select2.mother')
@include('partials.js_select2.childrens')
@include('partials.js_select2.owner')
@include('partials.js_select.changeSpecie')

@include('partials.js_modals.fur')
@include('partials.js_modals.race')
@include('partials.js_modals.specie')

@endpush