<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button bg-gray-700 text-white mt-3 hover:bg-gray-800 border border-transparent active:bg-gray-800 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
