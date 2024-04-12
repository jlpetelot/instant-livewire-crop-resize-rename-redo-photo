<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class PhotoModal extends ModalComponent
{
    // Declaration of the property $temporaryUrl so that it is available in the Livewire view resources/views/livewire/photo-modal.blade.php.
    public $temporaryUrl;

    // Prevents exiting the modal window before the image cropping process is complete.
    public static function closeModalOnClickAway (): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.photo-modal');
    }
}
