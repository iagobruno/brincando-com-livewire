<div class="modals">
    @foreach ($components as $compName => $props)
        <x-dialog
            wire:key="{{ $compName }}"
            id="{{ $compName }}"
        >
            <x-slot:body
                :style="$props['maxWidth'] ? 'width: ' . $props['maxWidth'] : ''"
            >
                @livewire($compName, $props['attributes'], key($compName))
            </x-slot:body>
        </x-dialog>
    @endforeach
</div>
