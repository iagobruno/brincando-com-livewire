<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class App extends Component
{
    use WithPagination;

    public $query = '';
    public $sort = '';

    protected $queryString = [
        'query' => ['except' => '', 'as' => 'search'],
        'sort' => ['except' => ''],
    ];

    protected $listeners = [
        'removeProducts',
        'echo:products,ProductCreated' => '$refresh',
        'echo:products,ProductUpdated' => '$refresh',
        'echo:products,BulkDeletion' => '$refresh',
    ];

    public function removeProducts($ids)
    {
        Product::whereIn('id', $ids)->delete();

        \App\Events\BulkDeletion::dispatch($ids);
        $this->emit('notify', trans_choice('messages.product_deleted', count($ids)), 'success');
    }

    public function updated($field)
    {
        if ($field === 'query' || $field === 'sort') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->query !== '', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->query . '%');
            })
            ->orderBy('created_at', $this->sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(page: $this->page, perPage: 20);

        return view('livewire.app', [
            'products' => $products,
        ])
            ->extends('layouts.default')
            ->section('content');
    }
}
