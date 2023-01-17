<?php

namespace App\Http\Livewire;

use App\Http\Livewire\ModalComponent;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditProductModal extends ModalComponent
{
    const modalMaxWidth = '400px';

    use WithFileUploads;

    public $product;
    public $name = '';
    public $price = 0;
    public $thumbnail = null;

    protected function rules()
    {
        return (new \App\Http\Requests\StoreProductRequest())->rules(ignoreProductId: $this->product->id);
    }
    protected function messages()
    {
        return (new \App\Http\Requests\StoreProductRequest())->messages();
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        // $this->thumbnail = $product->thumbnail;
    }

    public function update()
    {
        $data = $this->validate();

        if ($data['thumbnail'] instanceof \Livewire\TemporaryUploadedFile) {
            // Run -> php artisan storage:link
            $filepath = Storage::url(
                $this->thumbnail->store('public/images')
            );
            $data['thumbnail'] = url($filepath);
        } else {
            unset($data['thumbnail']);
        }

        $this->product->update($data);

        $this->emit('notify', __('messages.product_updated'), 'success');
        $this->closeModal();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.edit-product-modal');
    }
}
