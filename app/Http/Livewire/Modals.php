<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Exception;

class Modals extends Component
{
    public array $components = [];

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

        $this->components[] = [
            'component' => $componentName,
            'maxWidth' => $componentClass::modalMaxWidth,
            'attributes' => $attributes,
        ];
    }

    public function closeModal($componentName)
    {
        $this->components = array_filter(
            $this->components,
            fn ($item) => $item['component'] !== $componentName
        );
    }

    public function closePreviousModal()
    {
        $index = count($this->components) - 2;
        if ($index < 0) return;
        $component = $this->components[$index]['component'];
        if ($component) {
            $this->closeModal($component);
        }
    }

    public function render()
    {
        return <<<'blade'
            <div class="modals">
                @foreach ($components as $modal)
                    <x-dialog
                        wire:key="{{ $modal['component'] }}"
                        id="{{ $modal['component'] }}"
                    >
                        <x-slot:body
                            :style="$modal['maxWidth'] ? 'width: ' . $modal['maxWidth'] : ''"
                        >
                            @livewire($modal['component'], $modal['attributes'], key($modal['component']))
                        </x-slot:body>
                    </x-dialog>
                @endforeach
            </div>
        blade;
    }
}
