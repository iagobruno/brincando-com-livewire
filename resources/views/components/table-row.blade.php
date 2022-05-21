<tr
    {{ $attributes->merge(['class' => 'border-b border-gray-300 last:border-b-0 even:bg-gray-100/40']) }}
    x-ref="todo{{ $id }}">
    <td class="p-2 pl-3">
        <input type="checkbox" class="rounded" x-bind="checkRow">
    </td>
    <td class="w-full p-2">
        {{ $slot }}
    </td>
    <td class="w-full p-2 pr-3 text-right">
        <button class="rounded !outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
            x-on:click="removeOneRow($refs.todo{{ $id }})">
            <svg class="h-5 w-5 stroke-red-500 hover:stroke-red-600">
                <use href="#trash" />
            </svg>
        </button>
    </td>
</tr>

@once
    @push('svg_icons')
        <symbol id="trash" viewBox="0 0 24 24" fill="none" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </symbol>
    @endpush
@endonce
