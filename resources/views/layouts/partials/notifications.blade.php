<div x-data
    class="pointer-events-none fixed bottom-0 right-0 z-50 flex max-w-[min(400px,100vw)] flex-col items-end gap-2.5 px-3 pb-3"
    role="status"
    aria-live="polite">
    <template x-for="notification in $store.notifications.notifications" :key="notification.id">

        <div x-data="notificationState"
            class="max-w-inherit pointer-events-auto relative flex flex-row items-center gap-1.5 rounded border border-gray-200 bg-white py-2.5 px-3 pr-2 shadow-md"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-full"
            x-transition:enter-end="opacity-1 translate-y-0"
            x-transition:leave="transition ease-in duration-400"
            x-transition:leave-start="opacity-1"
            x-transition:leave-end="opacity-0">
            <svg class="mr-0.5 h-[20px] w-[20px] min-w-[20px]" role="img"
                x-bind:class="{
                    'success': 'fill-emerald-600',
                    'error': 'fill-rose-600',
                    'alert': 'fill-amber-500',
                    'info': 'fill-blue-500',
                } [notification.type]"
                aria-hidden="true">
                <use
                    x-bind:href="{
                        'success': '#check-circle-fill',
                        'error': '#exclamation-triangle-fill',
                        'alert': '#exclamation-triangle-fill',
                        'info': '#info-fill',
                    } [notification.type]" />
            </svg>
            <div x-text="notification.text" class="leading-6" x-transition.duration.500ms></div>
            <button class="min-w-[24px] cursor-pointer py-1.5 px-1" type="button"
                aria-label="Close notification"
                x-on:click="fadeOut(notification.id)">
                <svg class="h-3.5 w-3.5 stroke-gray-900" aria-hidden="true">
                    <use href="#close" />
                </svg>
            </button>
        </div>

    </template>
</div>

@push('svg_icons')
    <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
@endpush
