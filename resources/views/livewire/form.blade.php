<div>
    <form wire:submit.prevent="store">
        <input type="text" wire:model.debounce.500ms="newTodo">
        <button type="submit"
            @error('newTodo') disabled @enderror
            wire:loading.attr="disabled"
            wire:target="store">Criar</button>
    </form>
    <div wire:loading wire:target="newTodo">Validando...</div>
    <div wire:loading wire:target="store">Enviando...</div>
    @error('newTodo')
        <div style="color:red" wire:loading.remove>{{ $message }}</div>
    @enderror
    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>
