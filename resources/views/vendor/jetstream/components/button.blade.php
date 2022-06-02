<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-600 focus:outline-none focus:border-yellow-600 focus:ring focus:ring-yellow-400 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>