<div>
    @php
        // We fetch the URL of the last saved photo by the user.
        $photo = \App\Models\Photo::where('user_id', auth()->id())->first();
    @endphp

    <p class="mb-4">
        The image to upload must be at most 1,000 pixels wide by 1,500 pixels high, corresponding to an image aspect ratio of width to height of 1:1.5.
        If your image has a different aspect ratio, clicking on the "Click me to choose a photo"
        button will provide you with a cropping tool formatted for this ratio.
    </p>

    <!-- If this image exists, then we display it; otherwise, we display the temporary image or the fake image if we haven't cropped any image. -->
    <div class="flex items-center justify-start w-full space-x-4">
        @if(!empty($photo))
            <img src="{{ asset('/storage/images/products').'/'.$photo->url }}" class="h-auto rounded-lg w-80" alt="{{ $photo->title }}">

            <button type="button"
                    class="p-2 text-sm text-gray-500 duration-150 border border-gray-500 rounded-lg cursor-pointer hover:shadow-md hover:-translate-y-0.5"
                    wire:click="startagain">
                Start Again
            </button>
        @endif
        @if(empty($photo))
            <img src="{{ $croppedBlob ? $croppedBlob : ($image ? $image->temporaryUrl() : $pathfake . '/' . '1000x1500.svg') }}" class="h-auto rounded-lg w-80">

            <input type="file" name="photo" id="photo" class="sr-only" wire:model="image">

            <label for="photo" class="p-2 text-sm text-gray-500 duration-150 border border-gray-500 rounded-lg cursor-pointer hover:shadow-md hover:-translate-y-0.5">
                Click me to choose a Photo
            </label>
        @endif
    </div>

    <!-- Error message -->
    @if (session()->has('error'))
        <div
            x-data="{ isOpen: true }"
            x-show="isOpen"
            x-init="setTimeout(() => {
                isOpen = false
            }, 7000)"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform"
            x-transition:leave-end="opacity-0 transform"
            class="mt-4 -mb-2 text-pink-600 border border-pink-600 rounded-lg px-2 py-1 text-center">
            {{ session('error') }}
        </div>
    @endif
    <!-- ../Error message -->
</div>
