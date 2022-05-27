<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class App extends Component
{
    public $products = [];
    public $query = '';
    public $sort = 'latest';

    protected $queryString = [
        'query' => ['except' => '', 'as' => 'search'],
        'sort' => ['except' => ''],
    ];

    protected $listeners = [
        'removeProducts',
        'productAdded',
    ];

    public function mount()
    {
        $this->fetchProducts();
    }

    public function removeProducts($ids)
    {
        Product::whereIn('id', $ids)->delete();
        $this->fetchProducts();

        $this->emit('notify', trans_choice('Produto removido|Produtos removidos', count($ids)) . ' do catálogo!', 'success');
        $this->emit('productsRemoved', $ids);
    }

    public function productAdded()
    {
        $this->fetchProducts();
    }

    public function updatedQuery()
    {
        $this->fetchProducts();
    }
    public function updatedSort()
    {
        $this->fetchProducts();
    }

    public function fetchProducts()
    {
        $this->products = Product::query()
            ->when($this->query !== '', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->query . '%');
            })
            ->orderBy('created_at', $this->sort === 'latest' ? 'desc' : 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.app')
            ->extends('layouts.default')
            ->section('content');
    }
}
