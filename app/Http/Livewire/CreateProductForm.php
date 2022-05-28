<?php

namespace App\Http\Livewire;

use \App\Http\Livewire\ModalComponent;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CreateProductForm extends ModalComponent
{
    const modalMaxWidth = '440px';

    use WithFileUploads;

    public $name = '';
    public $price = 0;
    public $thumbnail = null;

    protected function rules()
    {
        return (new \App\Http\Requests\StoreProductRequest())->rules();
    }
    protected function messages()
    {
        return (new \App\Http\Requests\StoreProductRequest())->messages();
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->thumbnail) {
            // Run -> php artisan storage:link
            $filepath = Storage::url(
                $this->thumbnail->store('public/images')
            );
            $data['thumbnail'] = url($filepath);
        }

        $product = Product::create($data);

        $this->closeModal();
        \App\Events\ProductCreated::dispatch($product);
        $this->emit('notify', __('messages.product_created'), 'success');
        $this->reset(['name', 'price', 'thumbnail']);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.create-product-form');
    }
}
