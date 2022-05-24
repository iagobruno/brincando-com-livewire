<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $name = '';
    public $price = '';
    public $thumbnail = null;

    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'unique:products,name'],
        'price' => ['required', 'numeric', 'integer', 'min:0'],
        'thumbnail' => ['sometimes', 'image', 'max:1024'],
    ];
    protected $messages = [
        'required' => 'Este campo é obrigatório.',
        'name.max' => 'Digite no máximo 255 caracteres.',
        'name.unique' => 'Este produto já foi criado.',
        'price.numeric' => 'Digite apenas números.',
        'price.integer' => 'Digite um número inteiro sem casas decimais.',
        'price.min' => 'Digite um preço maior que 0.',
        'thumbnail.image' => 'O arquivo precisa ser uma imagem.',
        'thumbnail.max' => 'Arquivo muito grande.',
    ];

    public function store()
    {
        $data = $this->validate();

        // Run php artisan storage:link
        $filepath = Storage::url(
            $this->thumbnail->store('public/images')
        );
        $data['thumbnail'] = url($filepath);

        $product = Product::create($data);

        $this->emit('productAdded', $product->id);
        $this->emit('notify', 'Produto criado com sucesso!', 'success');
        $this->reset(['name', 'price', 'thumbnail']);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.form');
    }
}
