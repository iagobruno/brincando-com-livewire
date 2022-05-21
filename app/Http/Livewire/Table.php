<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Table extends Component
{
    public $todos = [];

    protected $listeners = [
        'removeTodos',
    ];

    public function removeTodos($ids)
    {
        Todo::whereIn('id', $ids)->delete();
        $this->fetchTodos();
        $this->emit('todosRemoved', $ids);
    }

    public function mount()
    {
        $this->fetchTodos();
    }

    public function fetchTodos()
    {
        $this->todos = Todo::oldest()->get();
    }

    public function render()
    {
        return view('livewire.table');
    }
}
