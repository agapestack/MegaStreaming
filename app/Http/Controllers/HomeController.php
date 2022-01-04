<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// MODELS
use App\Models\Categorie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO déporter le middleware au niveau des routes: https://laravel.com/docs/7.x/routing#route-group-middleware
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // HOMEPAGE SEND CATEGORY && RECOMMENDATIONS DATA
        $categories = Categorie::all();

        return view('home', ['categories' => $categories]);
    }

    public function getUserVideos(Request $request)
    {
        //TODO il existe un helper Auth::id() direct
        $user_id = Auth::user()->id;
        //TODO utiliser eloquent ou un paginator si il y a beaucoup de vidéos: Video::where(conditions en tout genre)->paginate(nombre d'elements par page)
        // ref: https://laravel.com/docs/7.x/pagination#paginating-eloquent-results
        $user_uploads = DB::table('videos')->where('user_id', $user_id)->get();

        return view('userVideos', ['user_uploads' => $user_uploads]);
    }

    public function getLatestVideos(Request $request)
    {
        //TODO inutile
        $videoCollection = new \Illuminate\Database\Eloquent\Collection;

        //TODO utiliser eloquent comme proposé au dessus sinon créer un model ne sert à rien
        $videoCollection = DB::table('videos')->where('processed', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->distinct() //TODO inutile car pas de doublons si tu ne specifies pas la/les colonne(s) en particulier que tu vises: les id sont uniques
            ->get();


        // Log::info($videoCollection);

        return view('home', ['videos' => $videoCollection]);
    }

    public function getLatestVideosByCategory(Request $request, $category_name)
    {
        //TODO inutile
        $videoCollection = new \Illuminate\Database\Eloquent\Collection;
        //TODO eloquent
        $category = DB::table('categories')->where('name', $category_name)->first();

        Log::info($category->name . "\t" . $category->id);

        //TODO eloquent
        $videoCollection = DB::table('videos')->where('processed', true)
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->distinct()
            ->get();

        return view('home', ['videos' => $videoCollection, 'category_name' => $category_name]);
    }
}
