@if(count($pet->images))
<div x-data="{ open: true }">
    <div class="flex items-center">
        <h6 class="text-gray-400 text-sm my-3 font-bold uppercase"> {{ __('Pet photos') }} </h6>
        <div class="ml-2 cursor-pointer">
            <button @click="open=!open" type="button" class="text-gray-400">
                <div x-show="!open"><i class="fa fa-angle-down text-sm"></i></div>
                <div x-show="open"><i class="fa fa-angle-left text-sm"></i></div>
            </button>
        </div>
    </div>
    <div x-show="open" id="container_images" class="w-full relative m-auto flex justify-evenly gap-5 flex-wrap items-end">
        @foreach ($pet->images as $image)
        <div class="bg-cover bg-center h-48 w-64" style="background-image: url('{{$image->url}}')"></div>
        @endforeach
    </div>
</div>
@else
<h6 class="text-yellow-400 text-sm my-3 font-bold uppercase"> {{ __('Pet photos undefined') }} </h6>
@endif