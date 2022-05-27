@section('title')
    {{ __('messages.products') }}
@endsection

<div>
    <div class="mb-4 flex flex-wrap items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold">{{ __('messages.products') }}</h1>
            <p class="text-sm text-gray-500">
                {{ $products->count() . ' ' . trans_choice('Produto|Produtos', $products->count()) }}
                {{ $query ? trans_choice('encontrado|encontrados', $products->count()) : '' }}
            </p>
        </div>
        <x-dialog>
            <x-slot:trigger>
                <x-button class="button-blue">{{ __('messages.create_product') }}</x-button>
            </x-slot:trigger>
            <x-slot:body class="tablet:!w-[400px]">
                <h3 class="text-2xl font-medium">{{ __('messages.create_new_product') }}</h3>
                <p class="mb-3 text-gray-500">{{ __('messages.fill_form') }}</p>
                <livewire:form />
            </x-slot:body>
        </x-dialog>
    </div>

    <div class="my-4 flex items-center justify-between gap-3">
        <x-input
            type="search"
            class="w-full px-3 py-1"
            placeholder="{{ __('messages.search_products') }}"
            wire:model.debounce.500ms="query" />

        <x-dropdown>
            <x-slot:button class="whitespace-nowrap text-sm">
                {{ $sort === 'latest' ? __('messages.latest_first') : __('messages.oldest_first') }}
            </x-slot:button>
            <x-slot:menu>
                <x-dropdown-item wire:click="$set('sort', 'latest')">{{ __('messages.latest_first') }}</x-dropdown-item>
                <x-dropdown-item wire:click="$set('sort', 'oldest')">{{ __('messages.oldest_first') }}
                </x-dropdown-item>
            </x-slot:menu>
        </x-dropdown>
    </div>

    <x-table :products="$products" />
</div>
