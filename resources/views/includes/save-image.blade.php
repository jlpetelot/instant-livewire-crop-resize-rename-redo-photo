<!-- Save image -->
<!-- If a photo is already present in the photos table for the logged-in user, then we display the form. -->
@if($photo = \App\Models\Photo::where('user_id', auth()->id())->first())
    <form action="{{ route('save-image') }}" method="POST" class="mt-4">
        @csrf

        <label for="nameImage" class="text-xs"><p>Give your image a name and its alt tag (Good for SEO)</p>
            <p class="-mt-0.5"> or leave its default name.</p>
        </label>

        <input type="text"
               name="nameImage"
               placeholder="Your image name"
               class="mt-2 py-1.5 px-4 min-w-80 block border-slate-400 rounded-lg text-sm focus:border-slate-600 focus:ring-slate-600 placeholder-gray-400">
        <button type="submit" class="mt-2 p-2 min-w-80 text-sm text-white duration-150 bg-slate-800 rounded-lg cursor-pointer hover:bg-slate-600">
            Save the photo
        </button>

    </form>
@endif
<!-- Save image -->
