<div>
    <form
        class="flex flex-col justify-start gap-3"
        wire:submit.prevent="store">
        <div class="">
            <x-input
                type="text"
                :value="old('text')"
                class="px-4 py-3"
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
            <span wire:loading wire:target="store">Criando...</span>
        </button>
    </form>
</div>
