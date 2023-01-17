@section('title')
    {{ __('messages.products') }}
@endsection

<div>
    <div class="mb-4 flex flex-wrap items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold">{{ __('messages.products') }}</h1>
            <p class="text-sm text-gray-500">
                {{ $products->total() . ' ' . trans_choice('Produto|Produtos', $products->total()) }}
                {{ $query ? trans_choice('encontrado|encontrados', $products->total()) : '' }}
            </p>
        </div>
        <x-button wire:click="$emit('openModal', 'create-product-modal')" class="button-blue" data-hotkey="n">
            {{ __('messages.create_product') }}
        </x-button>
    </div>

    <div class="my-4 flex items-center justify-between gap-3">
        <x-input
            type="search"
            class="w-full px-3 py-1"
            placeholder="{{ __('messages.search_products') }}"
            wire:model.debounce.500ms="query"
            data-hotkey="/" />

        <x-dropdown>
            <x-slot:button class="whitespace-nowrap text-sm">
                {{ $sort === 'oldest' ? __('messages.oldest_first') : __('messages.latest_first') }}
            </x-slot:button>
            <x-slot:menu>
                <x-dropdown-item wire:click="$set('sort', 'latest')">{{ __('messages.latest_first') }}
                </x-dropdown-item>
                <x-dropdown-item wire:click="$set('sort', 'oldest')">{{ __('messages.oldest_first') }}
                </x-dropdown-item>
            </x-slot:menu>
        </x-dropdown>
    </div>

    <x-table :products="$products" />
</div>
