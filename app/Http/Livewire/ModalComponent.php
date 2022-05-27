<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class ModalComponent extends Component
{
    const modalMaxWidth = '600px';

    public function openModal(string $name)
    {
        $this->emit('openModal', $name);
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
