<div>
    @if(session()->has('error'))
    <div>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
    </div>
    @endif
    {{count($images)}}
    <input wire:change="$emit('multiple_file_choosed')" type="file" accept="image/*" multiple id="images" name="images[]" />
    <label for="images" class="flex items-center justify-center space-x-2 p-2 bg-blue-500 hover:bg-blue-600 cursor-pointer text-white w-64 rounded-md">
        <i class="fa fa-upload"></i>
        <div>{{trans('lang.select_images')}}</div>
    </label>
    @if(!empty($images)) <button type="button" wire:click="$emit('confirm_remove_files')" class="btn btn-danger">Remover todas las imagenes</button> @endif
    @if(!empty($validation_errors["images"]))
    @foreach($validation_errors["images"] as $k => $v)
    <label for="" class="error">{{ $v }}</label>
    @endforeach
    @endif
    <div id="container_images" class="w-11/12 relative m-auto flex justify-evenly gap-5 flex-wrap">
        @if($images)
        @foreach ($images as $key => $elem)
        @if(is_array($elem))
        <figure>
            <img src="{{end($elem)}}" />
            <button type="button" wire:click="$emit('confirm_remove_file', {{ $key }})" class="btn btn-danger btn-sm">Eliminar</button>
        </figure>
        @else
        <figure>
            <img src="{{$elem}}" />
            <button type="button" wire:click="$emit('confirm_remove_file', {{ $key }})" class="btn btn-danger btn-sm">Eliminar</button>
        </figure>
        @endif
        @endforeach
        @endif
    </div>
    @error('images')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<style>
    figure {
        width: 15%;
    }

    img {
        width: 100%;
    }
</style>

@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
<script>
    let container = new DataTransfer();

    window.onload = () => {
        var images = <?php echo json_encode($images) ?>;
        preLoadInput(images);

        //Recibir datos desde el servidor
        Livewire.on('get_images', (DATA) => {
            LoadInput(DATA);
        })
    }

    const preLoadInput = (images) => {
        for (i of images) {
            let file = new File([i.url], i.id_image, {
                type: "image/" + i.name.split(".").slice(-1)[0],
                lastModified: new Date().getTime()
            }, 'utf-8');
            container.items.add(file);
        }
        document.getElementById("images").files = container.files;
    }

    const LoadInput = (images) => {
        container.items.clear();
        console.log(images);
        for (i of images) {
            var arr = i.split(','),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n),
                ext = mime.split('/').slice(-1)[0];

            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }

            let file = new File([u8arr], (Math.random() + 1).toString(36).substring(5) + "." + ext, {
                type: mime
            });
            container.items.add(file);
        }
        document.getElementById("images").files = container.files;
    }

    window.livewire.on('multiple_file_choosed', function() {
        try {
            let files = event.target.files;
            let read_files = [];
            let fileInput = document.getElementById('images');
            let extPer = /(image\/png|image\/jpg|image\/jpeg|image\/PNG|image\/JPEG|image\/JPG)$/i;

            let flat = false;

            for (let i = 0; i < fileInput.files.length; i++) {
                if (!extPer.exec(fileInput.files[i].type)) {
                    flat = true;
                    container.items.clear();
                    alert('Solo se pueden elegir imagenes.')
                    return window.livewire.emit('clear_files');
                }
                flat = false;
            }
            if (flat) return false;

            if (files.length > 0 && files.length < 7) {
                for (let index in files) {
                    if (typeof files[index] == "object") {
                        let reader = new FileReader();
                        reader.onloadend = () => {
                            window.livewire.emit('add_file', reader.result);
                        }
                        reader.readAsDataURL(files[index]);
                    }
                }
            } else if (files.length != 0) {
                alert('Solo se pueden seleccionar máximo 6 imagenes');
            }
        } catch (error) {
            console.log(error);
        }

    });

    window.livewire.on('confirm_remove_files', function() {
        let cfn = confirm("Confirm to remove all files");
        if (cfn) {
            return window.livewire.emit('clear_files');
        }
        return false;
    });


    window.livewire.on('confirm_remove_file', function(index) {
        let cfn = confirm("Confirm to remove this file");
        if (cfn) {
            return window.livewire.emit('clear_file', index);
        }
        return false;
    });
</script>
@endpush