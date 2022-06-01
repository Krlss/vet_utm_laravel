<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1">
        <!-- Name specie -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <!-- 2 row -->
    <div class="flex">
        <div class="px-2 md:mb-0 mb-2">
            <input type="file" id="image" accept="image/*" name="image" required hidden />
            <label for="image" class="cursor-pointer flex items-center mb-2">
                {{__('Select a image')}}*
                <li class="fa fa-upload ml-2"></li>
            </label>
            <small>{{__('This image will be displayed in app mobile, is required selected one')}}</small>
            <div class="hidden" id="preview">
                <img class="bg-contain max-w-xs" id="img" src="#" />
                <button type="button" id="button" class="bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md mt-2">{{__('Remove photo')}}</button>
            </div>
        </div>
    </div>

    <button type="submit" class="float-right bg-green-500 hover:bg-green-600 p-2 px-4 mt-2 rounded-md text-whire font-medium text-white">{{__('Save')}}</button>

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