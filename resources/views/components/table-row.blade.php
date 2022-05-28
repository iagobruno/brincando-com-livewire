<tr
    {{ $attributes->except(['product'])->merge(['class' => 'border-b border-gray-300 last:border-b-0 even:bg-gray-100/40']) }}
    x-ref="product{{ $product->id }}"
    id="{{ $product->id }}">
    <td class="p-2 pl-3">
        <input type="checkbox" class="rounded" x-bind="checkRow">
    </td>
    <td class="p-2 text-xs text-gray-600" data-cel="id">#{{ $product->id }}</td>
    <td class="p-2" data-cel="thumb">
        <img src="{{ $product->thumbnail ?? '/default-thumb.png' }}"
            class="block h-[32px] min-h-[32px] w-[32px] min-w-[32px] rounded object-cover">
    </td>
    <td class="w-full p-2" data-cel="name">{{ $product->name }}</td>
    <td class="whitespace-nowrap p-2" data-cel="price">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
    <td class="w-full space-x-1 p-2 pr-3 text-right" data-cel="actions">
        <button class="rounded !outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2"
            wire:click="$emit('openModal', 'edit-product-form', { product: {{ $product->id }} })">
            <svg class="h-5 w-5 stroke-gray-800">
                <use href="#pencil" />
            </svg>
        </button>
        <button class="rounded !outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
            x-on:click="removeOneRow($refs.product{{ $product->id }})">
            <svg class="h-5 w-5 stroke-red-500 hover:stroke-red-600">
                <use href="#trash" />
            </svg>
        </button>
    </td>
</tr>
