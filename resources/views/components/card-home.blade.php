<div class="w-full md:max-w-xs max-w-none">
    <!-- small box -->
    <a href="{{route($route)}}">
        <div class="p-2.5 text-{{$color}} bg-{{$bg}}-500 rounded-sm relative block shadow-sm">
            <div class="flex flex-col gap-3 md:items-start items-center overflow-hidden">
                <h1 class="text-4xl font-bold truncate">{{$value}}</h1>
                <span class="font-medium truncate">{{__($small)}}</span>
            </div>
            <div class="z-0 text-black opacity-20 md:block hidden">
                <i class="{{$icon}} text-7xl absolute top-5 right-3"></i>
            </div>
        </div>
    </a>
</div>