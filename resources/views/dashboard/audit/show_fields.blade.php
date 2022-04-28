<div>
    <!-- User data -->
    @if ($user_guilty)
    <div>

        <!-- Head + actions -->
        <div class="flex items-center space-x-2 my-3">
            <p class="text-gray-400 text-sm font-bold uppercase">{{ trans('lang.user_guilty') }}</p>
        </div>

        <!-- rows -->
        <div>

            <!-- 1 ROW -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">

                <!-- User ID -->
                <div>
                    {!! Form::label('tableUserID', trans('lang.tableUserID'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate">{!! $user_guilty->user_id !!}</p>
                    </div>
                </div>

                <!-- Names -->
                <div>
                    {!! Form::label('name_complete', trans('lang.name_complete'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $user_guilty->name !!} {{$user_guilty->last_name1}} {{$user_guilty->last_name2}} </p>
                    </div>
                </div>

                <!-- Phone -->
                <div>
                    {!! Form::label('phone', trans('lang.phone'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $user_guilty->phone !!} </p>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    {!! Form::label('email', trans('lang.email'), ['class' => '']) !!}
                    <div class="px-3 py-2 rounded-md bg-gray-50 shadow-sm">
                        <p class="truncate"> {!! $user_guilty->email !!} </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif

    @push('scripts_lib')
    <script src="//unpkg.com/alpinejs"></script>
    @endpush
</div>