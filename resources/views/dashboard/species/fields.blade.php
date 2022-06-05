<div>
    <input name="id_specie" id="id_specie" hidden value="{{$specie->id}}" />
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
            {!! Form::label('id_fur', __('Furs') , ['class' => '']) !!}
            <div class="flex items-center justify-between w-full gap-2">
                {!! Form::select('id_fur[]', $furs, $fursSelected, ['class' => 'select2','multiple'=>'multiple','id'=>'id_fur']) !!}

                @can('dashboard.furs.create')
                <x-button-modal target="fur" />
                @endcan

            </div>

            @error('id_fur')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <!-- 2 row -->
    <div class="px-2 md:mb-0 mb-2">
        <label for="image" class="cursor-pointer flex items-center mb-2 bg-yellow-400 hover:bg-yellow-500 p-2 rounded justify-center md:max-w-xs max-w-none relative">
            {{__('Select a image')}}*
            <li class="fa fa-upload ml-2"></li>
            <input type="file" id="image" accept="image/*" name="image" required class="absolute left-auto top-0 z-0 opacity-0 cursor-pointer" />
        </label>
        <small>{{__('This image will be displayed in app mobile, is required selected one')}}</small>
        <div class="flex-col items-center justify-center @if(!$specie->image) hidden @else flex @endif" id="preview">
            <img class="bg-contain bg-center w-48 h-48 shadow" id="img" src="@if(!$specie->image) # @else {{$specie->image->url}} @endif" />
            <button type="button" id="button" class="bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md mt-2">{{__('Remove photo')}}</button>
        </div>
    </div>

    <x-submit-button-default />

</div>

@push('js')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $('#id_fur').select2({
        width: '100%',
        allowClear: true
    });
</script>

@can('dashboard.furs.create')
<script src="{{ asset('js/flowbite.js') }}"></script>
@endcan

@include('partials.js_modals.fur')
<script>
    const button = document.getElementById('button');
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    let container = new DataTransfer();

    $(document).ready(function() {
        var image = <?php echo json_encode($specie->image) ?>;

        let file = new File([image.url], image.id_image, {
            type: "image/" + image.name.split(".").slice(-1)[0],
            lastModified: new Date().getTime()
        }, 'utf-8');
        container.items.add(file);

        console.log({
            file,
            container,
            image
        });

        input.files = container.files
    });

    image.onchange = evt => {
        const [file] = image.files
        if (file) {
            if (preview.classList.contains('hidden')) {
                preview.classList.remove('hidden')
                preview.classList.add('flex')
            }
            img.src = URL.createObjectURL(file)
        }
    }

    button.addEventListener('click', () => {
        input.value = '';
        preview.classList.add('hidden');
    })
</script>
@endpush