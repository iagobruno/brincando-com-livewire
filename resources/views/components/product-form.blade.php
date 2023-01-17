<form
    {{ $attributes->class(['space-y-4'])->merge()->except(['name', 'price', 'thumbnail']) }}>

    <div class="">
        <label for="name-field"
            class="mb-0.5 block text-base font-medium text-gray-900">{{ __('messages.modal.name') }}:</label>
        <x-input
            type="text"
            id="name-field"
            :value="$name"
            class=""
            wire:model.debounce.500ms="name"
            :invalid="$errors->has('name')"
            autofocus
            autocomplete="off"
            placeholder="{{ __('messages.modal.type_here') }}" />
        @error('name')
            <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div class="">
        <label for="price-field"
            class="mb-0.5 block text-base font-medium text-gray-900">{{ __('messages.modal.price') }}:</label>
        <x-input
            type="number"
            id="price-field"
            :value="$price"
            class=""
            wire:model.debounce.500ms="price"
            :invalid="$errors->has('price', $product->price ?? '')"
            autocomplete="off"
            placeholder="0"
            step="1" />
        @error('price')
            <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <label for="image-field"
            class="mb-0.5 block text-base font-medium text-gray-900">{{ __('messages.modal.image') }}:</label>
        @error('thumbnail')
            <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
        <div x-show="isUploading">
            <div class="mb-0.5 text-sm text-gray-500">{{ __('messages.modal.uploading') }}...</div>
            <div class="h-2 w-full overflow-hidden rounded bg-gray-100">
                <div x-bind:style="{ width: progress + '%' }" class="h-2 bg-blue-500 transition"></div>
            </div>
        </div>
        @if ($thumbnail && !$errors->has('thumbnail'))
            {{-- {{ __('messages.modal.image_preview') }}: --}}
            <img
                src="{{ $thumbnail instanceof \Livewire\TemporaryUploadedFile ? $thumbnail->temporaryUrl() : $thumbnail }}"
                class="block max-h-[200px] max-w-full rounded border border-gray-300 object-cover">
        @endif
        <x-input
            type="file"
            wire:model.debounce.500ms="thumbnail"
            id="image-field"
            :value="$thumbnail"
            class=""
            :invalid="$errors->has('thumbnail')"
            accept=".png,.jpg,.jpeg,.webp"
            autocomplete="off"
            placeholder="0"
            step="1" />
    </div>

    <button type="submit"
        class="button button-green ml-auto w-fit"
        @disabled($errors->isNotEmpty())
        wire:loading.attr="disabled"
        wire:target="store">
        <span wire:loading.remove wire:target="store">{{ __('messages.modal.create') }}</span>
        <span wire:loading wire:target="store">
            <svg class="-ml-1 mr-2.5 inline h-5 w-5 animate-spin align-bottom text-white" aria-hidden="true">
                <use href="#loading" />
            </svg>
            {{ __('messages.modal.creating') }}...</span>
    </button>
</form>
