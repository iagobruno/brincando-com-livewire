<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo as TodoModel;

class Form extends Component
{
    public $text = '';

    protected $rules = [
        'text' => ['required', 'string', 'max:255', 'unique:todos,text'],
    ];
    protected $messages = [
        'required' => 'Este campo é obrigatório.',
        'max' => 'Digite no máximo 255 caracteres.',
        'unique' => 'Este item já existe.',
    ];

    public function store()
    {
        $this->validate();

        $todo = TodoModel::create([
            'text' => $this->text,
        ]);

        $this->emit('todoAdded', $todo->id);
        $this->text = '';
    }

    public function updatedText()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.form');
    }
}
