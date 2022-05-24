<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Table extends Component
{
    public $products = [];
    public $searchQuery = '';

    protected $listeners = [
        'removeProducts',
        'productAdded',
        'searchQueryUpdated',
    ];

    public function removeProducts($ids)
    {
        Product::whereIn('id', $ids)->delete();
        $this->fetchProducts();

        $plural = count($ids) > 1 ? 's' : '';
        $this->emit('notify', "Produto$plural removido$plural do catálogo!", 'success');
        $this->emit('productsRemoved', $ids);
    }

    public function productAdded()
    {
        $this->fetchProducts();
    }

    public function searchQueryUpdated($value)
    {
        $this->searchQuery = $value;
        $this->fetchProducts();
    }

    public function mount()
    {
        $this->fetchProducts();
    }

    public function fetchProducts()
    {
        $this->products = Product::latest()
            ->when($this->searchQuery !== '', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->searchQuery . '%');
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.table');
    }
}
