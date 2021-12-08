<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        <div class="flex flex-col px-2">
            {!! Form::label('user_id', trans('lang.tableUserID'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::input('number', 'user_id', old('user_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'maxlength' => 13, 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('user_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('name', trans('lang.namesUser'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('last_name1', trans('lang.last_name1'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('last_name1', old('last_name1'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name1'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('last_name1')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('last_name2', trans('lang.last_name2'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('last_name2', old('last_name2'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name2'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('last_name2')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{--  --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div class="flex flex-col px-2">
            {!! Form::label('email', trans('lang.email'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::email('email', old('email'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.email'), 'required' => true, 'type' => 'email']) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('address', trans('lang.address'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::text('address', old('address'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.address'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('phone', trans('lang.phone'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::input('number', 'phone', old('phone'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.phone'), 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">
                    {{ trans('lang.required') }}
                </div>
            </div>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

        <div class="flex flex-col px-2">
            {!! Form::label('province_id', trans('lang.province'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('province_id', $provinces, $province ? $province->id : null, ['class' => 'select2 form-control', 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
            </div>
            @error('province_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('id_canton', trans('lang.canton'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            <div class="">
                {!! Form::select('id_canton', $cantons, $canton ? $canton->id : null, ['class' => 'select2 form-control', 'required' => true]) !!}
                <div class="text-gray-500 text-sm mb-2">{{ trans('lang.required') }}</div>
            </div>
            @error('id_canton')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit"
        class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>
</div>

@push('scripts_lib')
    <script>
        $(document).ready(function() {
            if (<?php echo $canton; ?>) {
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
                        if ($('#id_canton').val() !== [])
                            <?php echo $canton->id; ?> === canton.id ? cantonsOptions +=
                            '<option selected value="' +
                            canton.id + '">' + canton.name +
                            '</option>' :
                            cantonsOptions += '<option value="' + canton.id + '">' +
                            canton.name +
                            '</option>'
                    });
                    $('#id_canton').html(cantonsOptions);
                });
            }
        });
    </script>

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
                if (msg.length <= 0) {
                    cantonsOptions = '<option value="0">Sin padre</option>'
                } else {
                    $.each(msg, function(i, canton) {
                        cantonsOptions += '<option value="' + canton.id + '">' + canton.name +
                            '</option>';
                    });
                }
                $('#id_canton').html(cantonsOptions);
            });
        });
    </script>
@endpush
