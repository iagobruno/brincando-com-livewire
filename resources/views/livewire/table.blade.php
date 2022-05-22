<div class="overflow-hidden overflow-x-auto rounded border border-gray-300">
    <table class="min-w-[500px]" x-data="tableState">
        <thead>
            <tr class="border-b border-gray-300 bg-gray-100">
                <th class="p-2 pl-3 text-left">
                    <input type="checkbox" class="rounded align-baseline" x-bind="checkAll">
                </th>
                <th class="w-full p-2 text-left"></th>
                <th class="p-2 pr-3 text-left">
                    <x-button
                        class="button button-outlined button-red whitespace-nowrap !px-2 !py-1"
                        x-on:click="removeAllSelectedRows" x-bind:disabled="!hasAtLeastOneRowSelected" disabled>Delete
                        selected</x-button>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <x-table-row :id="$todo->id">
                    <input type="text" value="{{ $todo->text }}"
                        class="w-full border-0 bg-transparent p-0 !outline-none focus:ring-2 focus:ring-blue-400">
                </x-table-row>
            @endforeach
        </tbody>
    </table>

    @if (count($todos) === 0)
        <div class="my-6 px-2 text-center text-lg text-gray-600">Nenhum item encontrado.</div>
    @endif
</div>
