<div class="">
    <button type="button" data-toggle="modal" data-target="#Modal{{$target}}" data-tooltip-target="tooltip-create-{{$target}}" class="shadow-sm">
        <i class="fa fa-plus bg-red-400 hover:bg-red-600 text-white p-2 text-xs rounded-sm"></i>
    </button>
    <div id="tooltip-create-{{$target}}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{__('Create a ' . $target)}}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>