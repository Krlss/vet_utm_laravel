<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
        <!-- Name pet -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', $specie->name, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Furs -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('furs', __('Furs') , ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('furs[]', $furs, $fursSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'furs']) !!}
                <div class="">
                    <button type="button" data-toggle="modal" data-target="#ModalFur" data-tooltip-target="tooltip-create-fur" class="shadow-sm">
                        <i class="fa fa-plus bg-pink-300 hover:bg-pink-500 text-white p-2 text-xs rounded-sm"></i>
                    </button>
                    <div id="tooltip-create-fur" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{__('Create a fur')}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>

            @error('furs')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <!-- 2 row -->
    <div class="flex">
        <div class="px-2 md:mb-0 mb-2">
            <input type="file" id="image" accept="image/*" hidden name="image" required />
            <label for="image" class="cursor-pointer flex items-center mb-2">
                {{__('Select a image')}}*
                <li class="fa fa-upload ml-2"></li>
            </label>
            <small>{{__('This image will be displayed in app mobile, is required selected one')}}</small>
            <div class="@if(!$specie->image) hidden @endif" id="preview">
                <img class="bg-contain max-w-xs" id="img" src="@if(!$specie->image) # @else {{$specie->image->url}} @endif" />
                <button type="button" id="button" class="bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md mt-2">Remover</button>
            </div>
        </div>
    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

</div>

@push('scripts_lib')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    const button = document.getElementById('button');
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    let container = new DataTransfer();

    window.onload = () => {
        var image = <?php echo json_encode($specie->image) ?>;

        let file = new File([image.url], image.id_image, {
            type: "image/" + image.name.split(".").slice(-1)[0],
            lastModified: new Date().getTime()
        }, 'utf-8');
        container.items.add(file);

        input.files = container.files
    }

    image.onchange = evt => {
        const [file] = image.files
        if (file) {
            if (preview.classList.contains('hidden')) preview.classList.remove('hidden')
            img.src = URL.createObjectURL(file)
        }
    }

    button.addEventListener('click', () => {
        input.value = '';
        preview.classList.add('hidden');
    })

    $('#furs').select2({
        width: '100%',
        allowClear: true,
    });

    $('.add_fur').click(function(e) {
        e.preventDefault();
        var fur = $('#name_fur').val();
        $('.add_fur').attr('disabled', 'disabled');
        $('.add_fur').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            type: "POST",
            url: "{{url('dashboard/add-fur-modal')}}",
            data: {
                name: fur,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                if (data.error) {
                    $('.error_fur').html(data.error[0]);
                } else {
                    $('#furs').append(`<option value="${data.id}" selected>${data.name}</option>`);
                    $('#furs').trigger('change');
                    $('#name_fur').val('');
                    $('#ModalFur').modal('hide');
                }
                $('.add_fur').removeAttr('disabled');
                $('.add_fur').html('Guardar');
            },
            error: function(data) {
                console.log(data);
                $('.add_fur').removeAttr('disabled');
                $('.add_fur').html('Guardar');
            }
        })
    });
</script>
@endpush