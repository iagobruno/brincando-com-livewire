<div class="overflow-hidden overflow-x-auto rounded border border-gray-300">
    <table class="min-w-[500px]" x-data="tableState($el)">
        <thead>
            <tr class="border-b border-gray-300 bg-gray-100 text-left text-sm">
                <th class="p-2 pl-3 text-left">
                    <input type="checkbox" class="rounded align-baseline" x-bind="checkAll">
                </th>
                <th class="p-2"></th>
                <th class="p-2"></th>
                <th class="w-full p-2">{{ __('messages.table.product') }}</th>
                <th class="p-2">{{ __('messages.table.price') }}</th>
                <th class="p-2 pr-3">
                    <x-button
                        class="button button-outlined button-red whitespace-nowrap !px-2 !py-1"
                        x-on:click="removeAllSelectedRows" x-bind:disabled="!hasAtLeastOneRowSelected" disabled>
                        {{ __('messages.delete_selected') }}</x-button>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <x-table-row :product="$product">
                </x-table-row>
            @endforeach
        </tbody>
    </table>

    @if (count($products) === 0)
        <div class="my-6 px-2 text-center text-lg text-gray-600">{{ __('messages.not_found') }}</div>
    @endif
</div>
