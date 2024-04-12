<div class="p-10"
     x-data="{
        cropper: null,
        cropRegion: null,
        dispatchCroppedImage() {
            this.cropper.getCroppedCanvas().toBlob(blob => {
                $dispatch('croppedImageReady', [URL.createObjectURL(blob), this.cropRegion])
                @this.closeModal()
            })
        }
    }" x-init="$nextTick(() => {
        cropper = new Cropper($refs.image, {
            autoCropArea: 1,
            viewMode: 1,
            aspectRatio: 1 / 1.5,
            crop (e) {
            cropRegion = {
                x: e.detail.x,
                y: e.detail.y,
                width: e.detail.width,
                height: e.detail.height
                }
            }
        })
    })"
>
    <div>
        <img src="{{ $temporaryUrl }}" x-ref="image" class="w-full max-w-full">
    </div>

    <button type="button"
            class="mt-6 w-full max-w-full items-center px-4 py-2 text-sm text-gray-500
            duration-150 border border-gray-500 rounded-lg cursor-pointer hover:shadow-md hover:-translate-y-0.5"
            x-on:click="dispatchCroppedImage">
        Crop
    </button>
</div>
