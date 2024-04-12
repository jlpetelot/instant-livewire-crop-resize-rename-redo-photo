<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NameImageController extends Controller
{
    // Public property "pathproducts" for path product images.
    public $pathproducts;

    public function __construct ()
    {
        // We are building the product path for the images.
        $this->pathproducts = 'public/images/products/';
    }

    /**
     * Method saveimage() to save and/or rename an image
     *
     * @param Request $request
     **/
    public function saveimage (Request $request)
    {
        // If the person is not logged in, we forbid.
        if (!auth()->check()) {
            abort(403);
        }

        // We retrieve the image name sent by the user passed through the "transformthestring()" method.
        $givenName = $this->transformthestring($request->nameImage);

        // If the variable $givenName exists
        if ($givenName) {
            // We retrieve the image name from the "photos" table in the database.
            $image = Photo::where('user_id', auth()->id())->first()->url;

            // We retrieve the image name without the extension.
            $imageName = explode('.', $image)[0];
            // We retrieve the image extension.
            $ext = explode('.', $image)[1];

            // We change the image name using the Laravel Storage facade.
            Storage::move($this->pathproducts.$imageName.'.'.$ext, $this->pathproducts.$givenName.'.'.$ext);

            // We save both this new name and "alt" tag in the "photos" table of the database.
            $photo = Photo::where('user_id', auth()->id())->first();
            $photo->url = $givenName.'.'.$ext;
            $photo->title = $request->nameImage;
            $photo->alt = $request->nameImage;
            $photo->save();

            // We return to the previous view with a success message.
            return redirect()->route('photo')->with('successone', "Your photo and its new name, $request->nameImage, have been successfully saved!");
        }
        // If this variable does not exist
        else
        {
            // We retrieve the default image name and save it in the alt tag of the image.
            $photo = Photo::where('user_id', auth()->id())->first();
            $photo->title = $request->nameImage;
            $photo->alt = $request->nameImage;
            $photo->save();

            // We return to the previous view with a success message.
            return redirect()->route('photo')->with('successtwo', "Your photo has been successfully saved!");
        }
    }

    /**
     * The method transformthestring() returns a string in lowercase, without accents, and with words connected by a hyphen.
     * © Jean-Luc Petelot 2024
     *
     * @param $text
     */
    public function transformthestring ($text) {
        $chars = [
            'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'À' => 'a', 'ä' => 'a', '@' => 'a',
            'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', '€' => 'e',
            'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
            'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'µ' => 'u',
            'Œ' => 'oe', 'œ' => 'oe', 'ç' => 'c', '$' => 's', '&' => 'et', 'Ÿ' => 'y', "'" => ''
        ];
        $text = strtr($text, $chars);
        $text = preg_replace('#[^A-Za-z0-9]+#', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);

        return $text;
    }
}



