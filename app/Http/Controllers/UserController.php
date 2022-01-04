<?php

namespace App\Http\Controllers;

use App\Models\ProfilePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        //TODO déporter le middleware au niveau des routes: https://laravel.com/docs/7.x/routing#route-group-middleware
        $this->middleware('auth');
    }

    public function home() {
        return view('userProfile');
    }


    // USER PHOTO UPLOAD
    public function uploadProfilePicture(Request $request) {

        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', //TODO validators comme celui ci dans tous les controllers qui reçoivent un form
        ]);

        // Delete existing profile picture if exist
        //TODO supprimer le fichier stocké aussi (et là, y'a pas besoin d'assigner cette instruction à une variable)
        $pp = ProfilePicture::where('user_id', '=', Auth::id())->delete();

        // Uploading new profile picture
        if($request->hasFile('file')) {
            $path = $request->file('file')->storeAs(    
                'profile_picture', Auth::id()
            );
            //TODO simplifiable avec ProfilePicture::create(data) plutôt que new puis save()
            $profile_picture = new ProfilePicture([
                "user_id" =>  Auth::id(),
                "path" => $path,
            ]);

            // saving to db

            $profile_picture->save();
        }

        return view('userProfile');

    }
}
