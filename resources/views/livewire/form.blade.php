<div>
    <form
        class="flex flex-col justify-start gap-3"
        wire:submit.prevent="store">
        <div class="">
            <input
                type="text"
                class="@error('text') border-red-600 focus:border-red-600 focus:ring-red-600 @enderror block w-full rounded focus:ring-2 focus:ring-offset-2"
                wire:model.debounce.500ms="text"
                x-effect="show && $el.focus()">
            <div class="text-gray-600" wire:loading wire:target="text">Validando...</div>
            <div class="text-gray-600" wire:loading wire:target="store">Enviando...</div>
            @error('text')
                <div class="text-red-600" wire:loading.remove>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit"
            class="button button-green ml-auto w-fit"
            @error('text') disabled @enderror
            wire:loading.attr="disabled"
            wire:target="store">Criar</button>
    </form>
</div>
