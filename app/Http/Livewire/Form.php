<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo as TodoModel;

class Form extends Component
{
    public $newTodo = '';

    protected $rules = [
        'newTodo' => ['required', 'string', 'max:255', 'unique:todos,text'],
    ];

    public function store()
    {
        $this->validate();

        $todo = TodoModel::create([
            'text' => $this->newTodo,
        ]);

        $this->emit('todoAdded', $todo->id);
        $this->newTodo = '';

        session()->flash('message', '✅ Todo adicionado!');
    }

    public function updatedNewTodo()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.form');
    }
}
