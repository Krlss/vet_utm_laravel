<li class="{{ Request::is($routeCurrent) ? '' : '' }} md:w-full w-auto">
    <a class="{{ Request::is($routeCurrent) ? 'font-bold cursor-default bg-green-page text-white' : 'hover:bg-gray-100 hover:text-black' }} text-black inline-block py-2 px-4 hover:no-underline w-full" href="{{ (!$isEdit ? route($routeTo) : route($routeTo, $model)) }}">{{$title}}</a>
</li>