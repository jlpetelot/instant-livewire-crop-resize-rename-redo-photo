<div>
    {{--    <p class="mb-4">--}}
    {{--        L’image à téléverser doit être au plus près de 1 000 px de largeur par 1 500 px de hauteur. Ce qui correspond à--}}
    {{--        un ratio d'image largeur par hauteur à 1 / 1,5. Si votre image présente un ratio différent, en cliquant sur le--}}
    {{--        bouton « Cliquez sur moi pour choisir une photo », vous disposerez d’un outil de recadrement formaté pour ce--}}
    {{--        ratio.--}}
    {{--    </p>--}}

    <p class="mb-4">
        The image to upload must be at most 1,000 pixels wide by 1,500 pixels high, corresponding to an image aspect ratio of width to height of 1:1.5.
        If your image has a different aspect ratio, clicking on the "Click me to choose a photo"
        button will provide you with a cropping tool formatted for this ratio.
    </p>

    <div class="flex items-center justify-start w-full space-x-4">
        <img src="{{ $croppedBlob ? $croppedBlob : ($image ? $image->temporaryUrl() : $pathfake . '/' . '1000x1500.svg') }}" class="h-auto rounded-lg w-80">

        <input type="file" name="photo" id="photo" class="sr-only" wire:model="image">

        <label for="photo" class="p-2 text-sm text-gray-500 duration-150 border border-gray-500 rounded-lg cursor-pointer hover:shadow-md hover:-translate-y-0.5">
            Click me to choose a Photo
        </label>
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
