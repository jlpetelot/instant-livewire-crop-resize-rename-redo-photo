<?php

namespace App\Livewire;

use App\Models\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Spatie\Image\Image;

class UploadPhotoLivewire extends Component
{
    use WithFileUploads;

    // Property $image
    public $image;

    // Fake image path
    public $pathfake;

    public string $croppedBlob;
    // Upon clicking the crop button event, we retrieve the cropped image.
    #[On('croppedImageReady')]

    public function handleCroppedImage($croppedBlob, $cropRegions)
    {
        // We check which value ratio the width is (which can also be done by height).
        $ratio  = $cropRegions['width'] / 1000;

        // We apply this ratio for the height and width.
        // If this ratio is greater than 1, the image will need to be resized.
        if ($ratio > 1 ) {
            // Si ce ratio est supérieur à 1, on divise la larh-geur et la hauteur des régions recasdrées par le ratio
            $width = $cropRegions['width'] / $ratio;
            $height = $cropRegions['height'] / $ratio;
        }
        // Otherwise, we leave it as it is.
        else
        {
            // We leave it as it is.
            $width = $cropRegions['width'];
            $height = $cropRegions['height'];
        }

        // We modify the image according to this ratio and resize the image.
        Image::load($this->image->getRealPath())
            // We retrieve all parameters from $croppedBlob to pass them to $cropRegions, which will crop the image
            ->manualCrop($cropRegions['width'], $cropRegions['height'], $cropRegions['x'], $cropRegions['y'])
            // We resize the image
            ->resize($width, $height)
            ->save();

        // We display the image in the browser window.
        $this->croppedBlob = $croppedBlob;

        // Calling the store method
        $this->store();

        // We go back to the current page.
        // return redirect()->route('photo');
    }

    /**
     * Method store() to save the image in the correct folder and the URL path of the profile_photo_url column in the photos table
     */
    public function store()
    {
        // We save the image in the correct folder.
        $image = $this->image->store('public/images/products');

        // We check if a photo already exists in the photos table.
        $photoUrl = Photo::where('user_id', auth()->id())->first();

        // If the "url" column of the "photos" table is already filled, we update this URL.
        if ($photoUrl) {
            $photoUrl->url = explode('/', $image)[3];
            // We record
            $photoUrl->save();
        } else {
            // If the URL does not exist, we create a new record of this image in the photos table.
            $photoUrl =  new Photo();
            $photoUrl->url = explode('/', $image)[3];
            $photoUrl->user_id = auth()->id();
            // We record
            $photoUrl->save();
        }
    }

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
