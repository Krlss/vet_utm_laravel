<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1">
        <!-- Name specie -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', trans('lang.name'), ['class' => 'uppercase text-xs font-bold mb-2']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => trans('lang.name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <!-- 2 row -->
    <div class="px-2 md:mb-0 mb-2 w-52">
        <input type="file" id="image" accept="image/*" hidden name="image" />
        <label for="image" class="cursor-pointer uppercase text-xs font-bold flex items-center mb-2">
            Seleccione una imagen
            <li class="fa fa-upload ml-2"></li>
        </label>
        <div class="hidden" id="preview">
            <img class="bg-contain bg-center h-48 w-48" id="img" src="#" />
            <button type="button" id="button" class="w-full bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md mt-2">Remover</button>
        </div>
    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{trans('lang.save')}}</button>

</div>

@push('scripts_lib')
<script>
    const preview = document.getElementById('preview');

    image.onchange = evt => {
        const [file] = image.files
        if (file) {
            if (preview.classList.contains('hidden')) preview.classList.remove('hidden')
            img.src = URL.createObjectURL(file)
        }
    }

    const button = document.getElementById('button');
    const input = document.getElementById('image');

    button.addEventListener('click', () => {
        input.value = '';
        preview.classList.add('hidden');
    })
</script>
@endpush