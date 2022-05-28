{{-- This component will be inserted inside a modal. --}}
<div>
    <h3 class="text-2xl font-bold">{{ __('messages.edit_product_id', ['id' => $productId]) }}</h3>
    <p class="mb-3 text-gray-500">{{ __('messages.edit_form') }}</p>

    <x-product-form
        wire:submit.prevent="update"
        :name="$name"
        :price="$price"
        :thumbnail="$thumbnail" />
</div>
