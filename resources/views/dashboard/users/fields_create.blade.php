<div>

    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! trans('lang.label_info_user_create') !!}
    </h6>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 mb-2">
        <div class="flex flex-col px-2">
            {!! Form::label('user_id', trans('lang.tableUserID'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}

            {!! Form::input('number', 'user_id', old('user_id'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.tableUserID'), 'maxlength' => 13, 'required' => true]) !!}

            @error('user_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('name', trans('lang.namesUser'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.namesUser'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('last_name1', trans('lang.last_name1'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('last_name1', old('last_name1'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name1'), 'required' => true]) !!}
            @error('last_name1')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('last_name2', trans('lang.last_name2'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('last_name2', old('last_name2'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.last_name2'), 'required' => true]) !!}
            @error('last_name2')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-2">
        <div class="flex flex-col px-2">
            {!! Form::label('email', trans('lang.email'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.email'), 'required' => true, 'type' => 'email']) !!}
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        @can('dashboard.users.role')
        <div class="flex flex-col px-2">
            {!! Form::label('roles', trans('lang.role'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('roles', $roles, 'Cliente', ['class' => 'select2 form-control', 'required' => true]) !!}
            @error('roles')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endcan
    </div>
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!! trans('lang.label_info_user_contact') !!}
    </h6>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-2">
        <div class="flex flex-col px-2">
            {!! Form::label('address', trans('lang.address'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('address', old('address'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.address')]) !!}
            @error('address')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col px-2">
            {!! Form::label('phone', trans('lang.phone'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::input('number', 'phone', old('phone'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.phone')]) !!}
            @error('phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 mb-2">

        <div class="flex flex-col px-2">
            {!! Form::label('province_id', trans('lang.province'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('province_id', $provinces, null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.select_province')]) !!}
            @error('province_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col px-2">
            {!! Form::label('id_canton', trans('lang.canton'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('id_canton', $cantons, null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.fist_selected_province')]) !!}
            @error('id_canton')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <!-- Parroquias -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mb-2">

        <div class="flex flex-col col-span-2 px-2">
            {!! Form::label('id_parish', trans('lang.parishe'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::select('id_parish', $parishes, null, ['class' => 'select2 form-control', 'placeholder' => trans('lang.fist_selected_canton')]) !!}
            @error('id_parishes')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">Guardar</button>

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

</div>

@push('scripts_lib')
<script>
    $('#btnSubmit').attr("disabled", false);

    $('#province_id').on('change', function() {
        $('#id_canton').html('');
        $("#id_canton").val([]);
        $('#id_parish').html('');
        $("#id_parish").val([]);
        $('#select2-id_canton-container').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons') }}",
            data: {
                province_id: $('#province_id').val()
            }
        }).done(function(msg) {
            let cantonsOptions;
            if (msg.length <= 0) {
                cantonsOptions = "<option value>Seleccione un canton</option>"
            } else {
                cantonsOptions += "<option value>Seleccione un canton</option>";
                $.each(msg, function(i, canton) {
                    cantonsOptions += '<option value="' + canton.id + '">' + canton.name +
                        '</option>';
                });
            }
            $('#id_canton').html(cantonsOptions);
        });
    });

    $('#id_canton').on('change', function() {
        $('#id_parish').html('');
        $("#id_parish").val([]);
        $('#select2-id_parish-container').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons/parishes') }}",
            data: {
                id_canton: $('#id_canton').val()
            }
        }).done(function(msg) {
            let parishesOptions;
            if (msg.length <= 0) {
                parishesOptions = "<option value>Seleccione una parroquia</option>"
            } else {
                parishesOptions += "<option value>Seleccione una parroquia</option>";
                $.each(msg, function(i, parishes) {
                    parishesOptions += '<option value="' + parishes.id + '">' + parishes.name +
                        '</option>';
                });
            }
            $('#id_parish').html(parishesOptions);
        });
    });
</script>
@endpush