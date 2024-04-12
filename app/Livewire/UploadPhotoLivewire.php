<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class UploadPhotoLivewire extends Component
{
    use WithFileUploads;

    // Property $image
    public $image;

    // Fake image path
    public $pathfake;


    public function updatedImage ()
    {
        // We are going to retrieve the extension of the temporary image.
        $temporaryExtension = explode('-.', $this->image->temporaryUrl());

        // We break down this extension.
        $extension = $temporaryExtension[1][0] . $temporaryExtension[1][1] . $temporaryExtension[1][2];

        // If the image has one of the 3 extensions,
        if ($extension == "jpg" || $extension == "jpe" || $extension == "png") {
            // The modal window opens by passing the Livewire view resources/views/livewire/photo-modal.blade.php as a parameter.
            $this->dispatch('openModal', 'photo-modal', [
                // This temporary image comes from the public property $image
                'temporaryUrl' => $this->image->temporaryUrl(),
            ]);
        }
        // Otherwise, we return an error message.
        else
        {
            session()->flash('error',"The image to upload must have a file extension of .jpg, .jpeg, or .png.");
            return redirect()->route('photo');
        }

        return false;
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
