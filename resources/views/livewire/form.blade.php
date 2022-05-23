<div>
    <form
        class="flex flex-col justify-start gap-3"
        wire:submit.prevent="store">
        <div class="">
            <x-input
                type="text"
                :value="old('text')"
                class="border-2 px-4 py-3"
                wire:model.debounce.500ms="text"
                :invalid="$errors->has('text')"
                x-effect="show && $el.focus()"
                autocomplete="off"
                placeholder="Digite aqui..." />
            <div class="mt-1 text-sm text-red-600">
                @error('text')
                    {{ $message }}
                @else
                    <span class="invisible">l</span>
                @enderror
            </div>
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
