<div>
    @if(session()->has('error'))
    <div>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
    </div>
    @endif
    <input wire:change="$emit('multiple_file_choosed')" type="file" hidden multiple accept="image/*" id="images" name="images[]" />
    <label for="images" class="flex items-center justify-center space-x-2 p-2 bg-blue-500 hover:bg-blue-600 cursor-pointer text-white md:w-64 rounded-md">
        <i class="fa fa-upload"></i>
        <div>{{trans('lang.select_images')}}</div>
    </label>

    <div wire:loading class="w-full md:w-64 text-center mb-2 text-lg hidden">
        <i class="fa fa-spinner animate-spin"></i>
    </div>
    @error('images')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    @if(!empty($images)) <button type="button" wire:click="$emit('confirm_remove_files')" class="bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md float-right mb-4 w-full md:w-auto">Remover todas las {{count($images)}} imagenes</button> @endif

    <div id="container_images" class="w-full relative m-auto flex justify-evenly gap-5 flex-wrap items-end">
        @if($images)
        @foreach ($images as $key => $elem)
        @if(is_array($elem))
        <figure class="w-64">
            <div class="bg-cover bg-center h-48 w-64 mb-2" style="background-image: url('{{end($elem)}}')"></div>
            <button type="button" wire:click="$emit('confirm_remove_file', {{ $key }})" class="w-full bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md">Remover</button>
        </figure>
        @else
        <figure class="w-64">
            <div class="bg-cover bg-center h-48 w-64 mb-2" style="background-image: url('{{$elem}}')"></div>
            <button type="button" wire:click="$emit('confirm_remove_file', {{ $key }})" class="w-full bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md">Remover</button>
        </figure>
        @endif
        @endforeach
        @endif
    </div>
    @error('images')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
<script>
    let container = new DataTransfer();

    window.onload = () => {
        var images = <?php echo json_encode($images) ?>;

        for (e of images) preLoadInput(e);
        document.getElementById("images").files = container.files;

        //Recibir datos desde el servidor
        window.livewire.on('get_images', (DATA) => {
            container.items.clear();
            if (typeof DATA === "object") {
                const arrOb = Object.values(DATA);
                for (e of arrOb) {
                    if (typeof e === "object") {
                        preLoadInput(e);
                    } else {
                        LoadInput(e);
                    }
                }
                document.getElementById("images").files = container.files;
            }
        })
    }

    const preLoadInput = (i) => {
        let file = new File([i.url], i.id_image, {
            type: "image/" + i.name.split(".").slice(-1)[0],
            lastModified: new Date().getTime()
        }, 'utf-8');
        container.items.add(file);
    }

    const LoadInput = (url) => {
        var arr = url.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            ext = mime.split('/').slice(-1)[0],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        let file = new File([u8arr], ((Math.random() + 1).toString(36).substring(5) + "." + ext), {
            type: mime
        });
        container.items.add(file);
    }

    window.livewire.on('multiple_file_choosed', function() {
        try {
            let files = event.target.files;
            container.items.clear();

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
                container.items.clear();
                document.getElementById("images").files = container.files;
                alert('Solo se pueden seleccionar máximo 6 imagenes.');
                return window.livewire.emit('clear_files');
            }
        } catch (error) {
            console.log(error);
        }

    });

    window.livewire.on('confirm_remove_files', function() {
        let cfn = confirm("Confirmar para remover todas las imagenes.");
        if (cfn) {
            return window.livewire.emit('clear_files');
        }
        return false;
    });


    window.livewire.on('confirm_remove_file', function(index) {
        let cfn = confirm("Confirmar para remover la imagen seleccionada.");
        if (cfn) {
            return window.livewire.emit('clear_file', index);
        }
        return false;
    });
</script>
@endpush