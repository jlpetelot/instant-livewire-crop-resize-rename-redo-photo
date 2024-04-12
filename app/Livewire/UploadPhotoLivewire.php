<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class UploadPhotoLivewire extends Component
{
    use WithFileUploads;

    /**
     * Validation of the image by Livewire
     */
    #[Validate('image|max:1064')]
    // Property $image
    public $image;

    // Fake image path
    public $pathfake;


    public function updatedImage ()
    {
        // The modal window opens by passing the Livewire view resources/views/livewire/photo-modal.blade.php as a parameter.
        $this->dispatch('openModal', 'photo-modal', [
            //This temporary image comes from the public property $image
            'temporaryUrl' => $this->image->temporaryUrl(),
        ]);
    }


    public function mount()
    {
        // Permanent loading of the public pathfake variable
        $this->pathfake = asset('images/fakes');
    }

    public function render()
    {
        return view('livewire.upload-photo-livewire', [
            'pathfake' => $this->pathfake,
        ]);
    }
}
