<div x-data="dialog" class="w-fit" role="presentation">
    <div x-bind="trigger" class="w-fit">
        {{ $trigger }}
    </div>

    <div class="fixed inset-0 z-50 grid place-items-center overflow-y-auto px-2 py-6"
        style="display: none;"
        x-show="show">
        <div x-bind="backdrop"
            class="fixed inset-0 z-10 bg-black/40"
            x-show="show"
            x-transition.opacity
            aria-hidden="true"></div>

        <div
            x-bind="dialogEl"
            {{ $body->attributes->merge([
                'class' => 'relative z-20 m-auto w-full max-w-[500px] rounded bg-white py-5 px-6 shadow-lg overflow-hidden',
            ]) }}
            role="dialog"
            aria-modal="true"
            x-show="show"
            x-transition>
            {{ $body }}
            <button class="!absolute right-1.5 top-1.5 p-2" type="button"
                x-on:click="closeDialog">
                <svg class="h-5 w-5 stroke-gray-900" aria-hidden="true">
                    <use href="#close" />
                </svg>
            </button>
        </div>
    </div>
</div>

@once
    @push('svg_icons')
        <symbol id="close" viewBox="0 0 24 24" fill="none" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </symbol>
    @endpush
@endonce
