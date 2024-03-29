<?php

namespace App\Http\Livewire;

use Livewire\Component;

/**
 * How to open a modal:
 * <button wire:click="$emit('openModal', 'create-product-modal')">Create</button>
 * <button wire:click="$emit('openModal', 'edit-product-modal', { product: {{ $product->id }} })">Edit</button>
 */
abstract class ModalComponent extends Component
{
    const modalMaxWidth = '600px';

    public function openModal(string $name)
    {
        $this->emit('openModal', $name ?? $this->getName());
        return $this;
    }

    public function closeModal(string $name = null)
    {
        $this->emit('closeModal', $name ?? $this->getName());
        return $this;
    }

    public function closePreviousModal()
    {
        $this->emit('closePreviousModal');
        return $this;
    }
}
