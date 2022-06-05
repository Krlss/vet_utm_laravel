<div>

    <div x-data="{ open: true }">

        <div class="flex items-center space-x-2 my-3">
            <p class="text-gray-400 text-sm font-bold uppercase">{{__('Information required')}}</p>
            <div class="cursor-pointer text-gray-400">
                <button @click="open=!open" type="button">
                    <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </div>

        <div x-show="open" class="space-y-2">
            <!-- 1 row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
                <!-- user id -->
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('user_id', __('CI/RUC') . '*', ['class' => '']) !!}

                    {!! Form::input('number', 'user_id', old('user_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('CI/RUC'), 'required' => true]) !!}

                    @error('user_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- names -->
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('name', __('Names') . '*', ['class' => '']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Names'), 'required' => true]) !!}
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- lastnames -->
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('last_name1', __('First last name') . '*', ['class' => '']) !!}
                    {!! Form::text('last_name1', old('last_name1'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('First last name'), 'required' => true]) !!}
                    @error('last_name1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col px-2">
                    {!! Form::label('last_name2', __('Second last name') . '*', ['class' => '']) !!}
                    {!! Form::text('last_name2', old('last_name2'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Second last name'), 'required' => true]) !!}
                    @error('last_name2')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- 3 row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">

                <!-- email -->
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('email', __('Email') . '*', ['class' => '']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Email'), 'required' => true, 'type' => 'email']) !!}
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- role -->
                @can('dashboard.users.role')
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('roles', __('Role') . '*', ['class' => '']) !!}
                    <div class="flex items-center justify-between w-full gap-2">
                        {!! Form::select('roles', $roles, 'Cliente', ['class' => 'select2 form-control', 'required' => true]) !!}

                        @can('dashboard.roles.create')
                        <x-button-modal target="role" />
                        @endcan

                    </div>

                    @error('roles')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endcan
            </div>
        </div>
    </div>

    <div x-data="{ open: true }">

        <div class="flex items-center space-x-2 my-3">
            <p class="text-gray-400 text-sm font-bold uppercase">{{__('Home information required')}}</p>
            <div class="cursor-pointer text-gray-400">
                <button @click="open=!open" type="button">
                    <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </div>

        <div x-show="open">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mb-2">

                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('id_province', __('Province') . '*', ['class' => '']) !!}
                    <div class="flex items-center justify-between w-full gap-2">
                        {!! Form::select('id_province', $provinces, null, ['class' => 'select2 form-control', 'placeholder' => __('Select a province'), 'required' => true]) !!}

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

        </div>



    </div>

    <div x-data="{ open: true }">

        <div class="flex items-center space-x-2 my-3">
            <p class="text-gray-400 text-sm font-bold uppercase">{{__('Home information not required')}}</p>
            <div class="cursor-pointer text-gray-400">
                <button @click="open=!open" type="button">
                    <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </div>

        <div x-show="open">
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 mb-2">

                <!-- cantons -->
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('id_canton', __('Canton'), ['class' => '']) !!}
                    <div class="flex items-center justify-between w-full gap-2">
                        {!! Form::select('id_canton', $cantons, null, ['class' => 'select2 form-control', 'placeholder' => __('First select a province')]) !!}

                        @can('dashboard.cantons.create')
                        <x-button-modal target="canton" />
                        @endcan

                    </div>

                    @error('id_canton')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Parroquias -->
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('id_parish', __('Parish'), ['class' => '']) !!}
                    <div class="flex items-center justify-between w-full gap-2">
                        {!! Form::select('id_parish', $parishes, null, ['class' => 'select2 form-control', 'placeholder' => __('First select a canton')]) !!}

                        @can('dashboard.parishs.create')
                        <x-button-modal target="parish" />
                        @endcan

                    </div>

                    @error('id_parishes')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- phone -->
                <div class="flex flex-col px-2 md:mb-0">
                    {!! Form::label('phone', __('Phone'), ['class' => '']) !!}
                    {!! Form::input('number', 'phone', old('phone'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Phone')]) !!}
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Street and refe -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('main_street', __('Street main'), ['class' => '']) !!}
                    {!! Form::text('main_street', old('main_street'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Street main')]) !!}
                    @error('main_street')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- sec 1 -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('street_1_sec', __('Street secondary one'), ['class' => '']) !!}
                    {!! Form::text('street_1_sec', old('street_1_sec'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Street secondary one')]) !!}
                    @error('street_1_sec')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- sec 2 -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('street_2_sec', __('Street secondary two'), ['class' => '']) !!}
                    {!! Form::text('street_2_sec', old('street_2_sec'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Street secondary two')]) !!}
                    @error('street_2_sec')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- address ref -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
                <div class="flex flex-col col-span-3 px-2">
                    {!! Form::label('address_ref', __('Reference'), ['class' => '']) !!}
                    {!! Form::textarea('address_ref', old('address_ref'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Reference'), 'rows' => 3]) !!}
                    @error('address_ref')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

    </div>


    <div x-data="{open: true}">

        <div class="flex items-center space-x-2 my-3">
            <p class="text-gray-400 text-sm font-bold uppercase">{{__('Pets information not required')}}</p>
            <div class="cursor-pointer text-gray-400">
                <button @click="open=!open" type="button">
                    <div x-show="!open"><i class="fa fa-angle-down text-xs"></i></div>
                    <div x-show="open"><i class="fa fa-angle-left text-xs"></i></div>
                </button>
            </div>
        </div>

        <div x-show="open">
            <div class="grid grid-cols-1 sm:space-y-0 space-y-2 mb-3">
                <!-- pets -->
                <div class="flex flex-col px-2 md:mb-0 mb-2">
                    {!! Form::label('pets', __('Pets'), ['class' => '']) !!}
                    <div class="flex items-center justify-between w-full gap-2">
                        {!! Form::select('pets[]', $pets, $petsSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'pets']) !!}

                        @can('dashboard.pets.create')
                        <x-button-new-tab-blank target="pet" />
                        @endcan

                    </div>

                    @error('pets')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>


    <x-submit-button-default />

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

</div>

@push('js')
<script src="{{ asset('js/alpine.min.js') }}"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script src="{{ asset('js/flowbite.js') }}"></script>
@include('partials.js_select.province')
@include('partials.js_select.canton')

@include('partials.js_select2.petsWithoutOwner')

@include('partials.js_modals.canton_user')

@if($lettersAvailable)
@include('partials.js_modals.province')
@endif

@include('partials.js_modals.role')

@include('partials.js_modals.parish_user')

@endpush