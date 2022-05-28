<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class App extends Component
{
    public $products = [];
    public $query = '';
    public $sort = '';

    protected $queryString = [
        'query' => ['except' => '', 'as' => 'search'],
        'sort' => ['except' => ''],
    ];

    protected $listeners = [
        'removeProducts',
        'echo:products,ProductCreated' => 'fetchProducts',
        'echo:products,ProductUpdated' => 'fetchProducts',
        'echo:products,BulkDeletion' => 'fetchProducts',
    ];

    public function mount()
    {
        $this->fetchProducts();
    }

    public function fetchProducts()
    {
        $this->products = Product::query()
            ->when($this->query !== '', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->query . '%');
            })
            ->orderBy('created_at', $this->sort === 'oldest' ? 'asc' : 'desc')
            ->get();
    }

    public function removeProducts($ids)
    {
        Product::whereIn('id', $ids)->delete();

        \App\Events\BulkDeletion::dispatch($ids);
        $this->emit('notify', trans_choice('messages.product_deleted', count($ids)), 'success');
    }

    public function updatedQuery()
    {
        $this->fetchProducts();
    }
    public function updatedSort()
    {
        $this->fetchProducts();
    }

    public function render()
    {
        return view('livewire.app')
            ->extends('layouts.default')
            ->section('content');
    }
}
