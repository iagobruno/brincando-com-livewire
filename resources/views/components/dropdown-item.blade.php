<button
    x-bind="menuItem"
    {{ $attributes->merge([
        'type' => 'button',
        'class' =>
            'cursor-pointer bg-transparent w-full px-3 py-1.5 !outline-none text-left whitespace-nowrap hover:bg-gray-200/70 focus:ring-2 focus:ring-blue-400',
    ]) }}
    role="menuitem">
    {{ $slot }}
</button>
