@props([
    'invalid' => false,
])

<input
    {{ $attributes->merge([
            'type' => 'text',
        ])->class([
            'block px-2.5 py-1.5 border border-gray-400 w-full rounded focus:ring-2 focus:ring-sky-500 focus:ring-offset-2',
            '!border-red-600 focus:!ring-red-600' => $invalid,
        ]) }}>
