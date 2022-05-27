<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Exception;

class Modals extends Component
{
    public array $components = []; // associative array
    public array $stack = []; // array

    protected $listeners = [
        'openModal',
        'closeModal',
        'closePreviousModal',
    ];

    public function openModal($componentName, $attributes = [])
    {
        $componentClass = app('livewire')->getClass($componentName);
        $requiredInterface = \App\Http\Livewire\ModalComponent::class;

        if (!is_subclass_of($componentClass, $requiredInterface)) {
            throw new Exception("[{$componentClass}] does not implement [{$requiredInterface}] interface.");
        }

        $this->components[$componentName] = [
            'maxWidth' => $componentClass::modalMaxWidth,
            'attributes' => $attributes,
        ];
        $this->stack[] = $componentName;
    }

    public function closeModal($componentName)
    {
        unset($this->components[$componentName]);
        $this->stack = array_filter($this->stack, fn ($item) => $item !== $componentName);
    }

    public function closePreviousModal()
    {
        $index = count($this->stack) - 2;
        if ($index < 0) return;
        $modalName = $this->stack[$index];
        if ($modalName) {
            $this->closeModal($modalName);
        }
    }

    public function render()
    {
        return view('livewire.modals');
    }
}
