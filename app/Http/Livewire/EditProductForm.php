<?php

namespace App\Http\Livewire;

use App\Http\Livewire\ModalComponent;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditProductForm extends ModalComponent
{
    const modalMaxWidth = '400px';

    use WithFileUploads;

    public $name = '';
    public $price = 0;
    public $thumbnail = null;
    public $productId = '';

    protected function rules()
    {
        return (new \App\Http\Requests\StoreProductRequest())->rules(ignoreProductId: $this->productId);
    }
    protected function messages()
    {
        return (new \App\Http\Requests\StoreProductRequest())->messages();
    }

    public function update()
    {
        $data = $this->validate();

        if ($data['thumbnail'] !== null) {
            // Run -> php artisan storage:link
            $filepath = Storage::url(
                $this->thumbnail->store('public/images')
            );
            $data['thumbnail'] = url($filepath);
        } else {
            unset($data['thumbnail']);
        }

        $product = Product::findOrFail($this->productId);
        $product->update($data);

        $this->closeModal();
        \App\Events\ProductUpdated::dispatch($product);
        $this->emit('notify', __('messages.product_updated'), 'success');
        $this->reset(['name', 'price', 'thumbnail']);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function mount(Product $product)
    {
        $this->name = $product->name;
        $this->price = $product->price;
        // $this->thumbnail = $product->thumbnail;
        $this->productId = $product->id;
    }

    public function render()
    {
        return view('livewire.edit-product-form');
    }
}
