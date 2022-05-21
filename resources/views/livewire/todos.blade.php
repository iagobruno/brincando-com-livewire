<ul class="list">
    @foreach ($todos as $todo)
        <li id="todo-{{ $todo->id }}"
            data-id="{{ $todo->id }}">{{ $todo->text }}</li>
    @endforeach
</ul>

@push('extra_body')
    <script>
        document.querySelector('ul.list').addEventListener('click', (evt) => {
            const element = evt.target.closest('li[id^="todo-"]');
            if (element) {
                element.textContent += ' (Removendo...)'
                element.style.opacity = 0.6;
                element.style.pointerEvents = 'none';
                Livewire.emit('removeTodo', element.dataset.id);
            }
        });

        Livewire.on('todoRemoved', (todoId) => {
            document.getElementById(`todo-${todoId}`).remove()
        })
    </script>
@endpush
