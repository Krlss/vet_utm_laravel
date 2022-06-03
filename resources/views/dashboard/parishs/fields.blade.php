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

                @can('dashboard.provinces.create')
                <div class="">
                    <button type="button" data-toggle="modal" data-target="#ModalCanton" data-tooltip-target="tooltip-create-canton" class="shadow-sm">
                        <i class="fa fa-plus bg-pink-300 hover:bg-pink-500 text-white p-2 text-xs rounded-sm"></i>
                    </button>
                    <div id="tooltip-create-canton" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{__('Create a canton')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                @endcan

            </div>

            @error('id_canton')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>


@push('scripts_lib')
@can('dashboard.provinces.create')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $('#id_canton').select2({
        width: '100%',
    });

    $('#id_province').select2({
        width: '100%',
        dropdownParent: $('#ModalCanton')
    });

    $('.add_canton').click(function(e) {
        e.preventDefault();
        var canton = $('#name_canton').val();
        var province = $('#id_province').val();

        $('.add_canton').attr('disabled', 'disabled');
        $('.add_canton').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            type: "POST",
            url: "{{url('dashboard/add-canton-modal')}}",
            data: {
                name: canton,
                id_province: province,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                if (data.error) {
                    $('.error_canton').html(data.error[0]);
                } else {
                    $('#id_canton').append(`<option value="${data.id}" selected>${data.name}</option>`);
                    $('#id_canton').trigger('change');
                    $('#name_canton').val('');
                    $('#ModalCanton').modal('hide');
                }
                $('.add_canton').removeAttr('disabled');
                $('.add_canton').html('Guardar');
            },
            error: function(data) {
                console.log(data);
                $('.add_canton').removeAttr('disabled');
                $('.add_canton').html('Guardar');
            }
        })
    });
</script>
@endcan
@endpush