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
            {!! Form::label('species', __('Species') , ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('species[]', $species, $speciesSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'species']) !!}
                <div class="">
                    <button type="button" data-toggle="modal" data-target="#ModalSpecie" data-tooltip-target="tooltip-create-specie">
                        <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
                    </button>
                    <div id="tooltip-create-specie" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{__('Create a specie')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>

            @error('species')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>

@push('scripts_lib')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $('#species').select2({
        width: '100%',
        allowClear: true
    });


    $('.add_specie').click(function(e) {
        e.preventDefault();
        var fur = $('#name_specie').val();
        $('.add_specie').attr('disabled', 'disabled');
        $('.add_specie').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            type: "POST",
            url: "{{url('dashboard/add-specie-modal')}}",
            data: {
                name: fur,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                if (data.error) {
                    $('.error_specie').html(data.error[0]);
                } else {
                    $('#species').append(`<option value="${data.id}" selected>${data.name}</option>`);
                    $('#species').trigger('change');
                    $('#name_specie').val('');
                    $('#ModalSpecie').modal('hide');
                }
                $('.add_specie').removeAttr('disabled');
                $('.add_specie').html('Guardar');
            },
            error: function(data) {
                console.log(data);
            }
        })
    });
</script>
@endpush