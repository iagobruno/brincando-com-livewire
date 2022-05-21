<div
    {{ $attributes->merge([
        'tabindex' => 0,
        'role' => 'button',
        'class' =>
            'min-w-[140px] cursor-pointer whitespace-nowrap bg-transparent px-2 py-1 !outline-none hover:bg-gray-100 focus:ring-2 focus:ring-blue-400',
    ]) }}>
    {{ $slot }}
</div>
