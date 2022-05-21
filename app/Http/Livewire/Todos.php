<?php

namespace App\Http\Livewire;

use App\Models\Todo as TodoModel;
use Livewire\Component;

class Todos extends Component
{
    public $todos = [];

    protected $listeners = [
        'todoAdded' => 'handleTodoAdded',
        'removeTodo',
    ];

    public function handleTodoAdded(TodoModel $todo)
    {
        $this->todos[] = $todo;
    }

    function removeTodo(TodoModel $todo)
    {
        $todo->delete();
        $this->emit('todoRemoved', $todo->id);
    }

    public function mount()
    {
        $this->todos = TodoModel::oldest()->get();
    }

    public function render()
    {
        return view('livewire.todos');
    }
}
