<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
     /**
          * Method index() which displays the view resources/views/photos/index.blade.php
      **/
    public function index ()
    {
        // If not logged in, deny access.
        if (!auth()->user()) {
            abort(403);
        }

        return view('photos.index');
    }
}
