<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        <div class="flex flex-col px-2">
            {!! Form::label('user_id', trans('lang.tableUserID'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('user_id', old('user_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('name', trans('lang.namesUser'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('last_name1', trans('lang.last_name1'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('last_name1', old('last_name1'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name1')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('last_name2', trans('lang.last_name2'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('last_name2', old('last_name2'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name2')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
        </div>
    </div>

    {{--  --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div class="flex flex-col px-2">
            {!! Form::label('email', trans('lang.email'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('email', old('email'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.email')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('address', trans('lang.address'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('address', old('address'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.address')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('phone', trans('lang.phone'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('phone', old('phone'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.phone')]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

        <div class="flex flex-col px-2">
            {!! Form::label('province_id', trans('lang.province'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('province_id', $provinces, null, ['class' => 'select2 form-control']) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
            </div>
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('id_canton', trans('lang.canton'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('id_canton', $cantons, null, ['class' => 'select2 form-control']) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
            </div>
        </div>
    </div>

    <button class="float-right bg-blue-500 hover:bg-blue-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>
</div>

@push('scripts_lib')
    <script>
        $('#province_id').on('change', function() {
            $('#id_canton').html('');
            $("#id_canton").val([]);
            $('#select2-id_canton-container').html('');
            $.ajax({
                method: "GET",
                url: "{{ url('dashboard/provinces/cantons') }}",
                data: {
                    province_id: $('#province_id').val()
                }
            }).done(function(msg) {
                let cantonsOptions;
                if (msg.length <= 0) cantonsOptions = '<option value="0">Sin padre</option>';
                $.each(msg, function(i, canton) {
                    cantonsOptions += '<option value="' + canton.id + '">' + canton.name +
                        '</option>';
                });
                $('#id_canton').html(cantonsOptions);
            });
        });
    </script>
@endpush
