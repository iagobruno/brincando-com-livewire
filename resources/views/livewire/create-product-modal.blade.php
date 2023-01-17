{{-- This component will be inserted inside a modal. --}}
<div>
    <h3 class="text-2xl font-bold">{{ __('messages.create_new_product') }}</h3>
    <p class="mb-3 text-gray-500">{{ __('messages.fill_form') }}</p>

    <x-product-form
        wire:submit.prevent="store"
        :name="$name"
        :price="$price"
        :thumbnail="$thumbnail" />
</div>
