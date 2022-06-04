<div>
    <a data-tooltip-target="tooltip-create-{{$target}}" href="{{ route('dashboard.'.$target.'s.create') }}" target="_blank">
        <i class="fa fa-plus bg-yellow-300 hover:bg-yellow-500 text-white p-2 text-xs rounded-sm"></i>
    </a>
    <div id="tooltip-create-{{$target}}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{__('A new tab will be open to add a '.$target)}}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>