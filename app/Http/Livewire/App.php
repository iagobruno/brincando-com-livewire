<?php

namespace App\Http\Livewire;

use Livewire\Component;

class App extends Component
{
    public $query = '';

    protected $queryString = [
        'query' => ['except' => '', 'as' => 'search']
    ];

    public function updatedQuery()
    {
        $this->emitTo('table', 'searchQueryUpdated', $this->query);
    }

    public function render()
    {
        return view('livewire.app')
            ->layout('layouts.default', [
                'title' => 'Produtos'
            ]);
    }
}
