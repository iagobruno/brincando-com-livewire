<div class="w-fit" x-data="dialogState">
    <div class="w-fit" x-on:click="openDialog">
        {{ $trigger }}
    </div>

    <div class="fixed inset-0 z-50 grid hidden place-items-center overflow-y-auto px-2 py-6"
        x-bind:class="{ 'hidden': !show }">
        <div class="fixed inset-0 z-10 bg-black/40"
            x-on:click="closeDialog"
            x-on:keydown.window.escape="closeDialog"></div>
        <div
            {{ $body->attributes->merge([
                'class' => 'm-auto w-full max-w-[500px] rounded bg-white p-3 shadow-lg z-20',
            ]) }}>
            {{ $body }}
        </div>
    </div>
</div>
