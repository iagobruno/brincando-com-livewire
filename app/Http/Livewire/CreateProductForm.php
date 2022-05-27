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
    public $price = '';
    public $thumbnail = null;

    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'unique:products,name'],
        'price' => ['required', 'numeric', 'integer', 'min:0'],
        'thumbnail' => ['sometimes', 'nullable', 'image', 'max:1024'],
    ];
    public function messages()
    {
        return [
            'required' => __('messages.validations.required'),
            'name.max' => __('messages.validations.max_char', ['max' => 255]),
            'name.unique' => __('messages.validations.product_already_created'),
            'price.numeric' => __('messages.validations.only_numbers'),
            'price.integer' => __('messages.validations.integer'),
            'price.min' => __('messages.validations.price_min_zero'),
            'thumbnail.image' => __('messages.validations.only_images'),
            'thumbnail.max' => __('messages.validations.big_file'),
        ];
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
        $this->emit('productAdded', $product->id);
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
