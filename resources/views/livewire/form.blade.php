<div>
    <form
        class="flex flex-col justify-start gap-3"
        wire:submit.prevent="store">

        <div class="">
            <label for="name-field" class="mb-1 block text-base font-medium text-gray-900">Nome do produto:</label>
            <x-input
                type="text"
                id="name-field"
                :value="old('name')"
                class=""
                wire:model.debounce.500ms="name"
                :invalid="$errors->has('name')"
                x-effect="show && $el.focus()"
                autocomplete="off"
                placeholder="Digite aqui..." />
            <div class="text-sm text-red-600">
                @error('name')
                    {{ $message }}
                @else
                    <span class="invisible">l</span>
                @enderror
            </div>
        </div>

        <div class="">
            <label for="price-field" class="mb-1 block text-base font-medium text-gray-900">Preço:</label>
            <x-input
                type="number"
                id="price-field"
                :value="old('price')"
                class=""
                wire:model.debounce.500ms="price"
                :invalid="$errors->has('price')"
                autocomplete="off"
                placeholder="0"
                step="1" />
            <div class="text-sm text-red-600">
                @error('price')
                    {{ $message }}
                @else
                    <span class="invisible">l</span>
                @enderror
            </div>
        </div>

        <div class="">
            <label for="image-field" class="mb-1 block text-base font-medium text-gray-900">Imagem do produto:</label>
            <x-input
                type="file"
                id="image-field"
                :value="old('thumbnail')"
                class=""
                wire:model.debounce.500ms="thumbnail"
                :invalid="$errors->has('thumbnail')"
                autocomplete="off"
                placeholder="0"
                step="1" />
            <div class="text-sm text-red-600">
                @error('thumbnail')
                    {{ $message }}
                @else
                    <span class="invisible">l</span>
                @enderror
            </div>
            @if ($thumbnail)
                Image Preview:
                <img src="{{ $thumbnail->temporaryUrl() }}"
                    class="block max-h-[200px] max-w-full rounded border border-gray-300 object-cover">
            @endif
        </div>


        <button type="submit"
            class="button button-green ml-auto w-fit"
            @disabled($errors->isNotEmpty())
            wire:loading.attr="disabled"
            wire:target="store">
            <span wire:loading.remove wire:target="store">Criar</span>
            <span wire:loading wire:target="store">
                <svg class="-ml-1 mr-2.5 inline h-5 w-5 animate-spin align-bottom text-white" aria-hidden="true">
                    <use href="#loading" />
                </svg>
                Criando...</span>
        </button>
    </form>
</div>

@push('svg_icons')
    <symbol id="loading" viewBox="0 0 24 24" fill="none">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
        </path>
    </symbol>
@endpush
