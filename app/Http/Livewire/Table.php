<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Table extends Component
{
    public $products = [];

    protected $listeners = [
        'removeProducts',
        'productAdded',
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

    public function mount()
    {
        $this->fetchProducts();
    }

    public function fetchProducts()
    {
        $this->products = Product::latest()->get();
    }

    public function render()
    {
        return view('livewire.table');
    }
}
