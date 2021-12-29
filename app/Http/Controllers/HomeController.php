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
        $user_id = Auth::user()->id;
        $user_uploads = DB::table('videos')->where('user_id', $user_id)->get();

        return view('userVideos', ['user_uploads' => $user_uploads]);
    }

    public function getLatestVideos(Request $request)
    {
        $videoCollection = new \Illuminate\Database\Eloquent\Collection;

        $videoCollection = DB::table('videos')->where('processed', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->distinct()
            ->get();


        // Log::info($videoCollection);

        return view('home', ['videos' => $videoCollection]);
    }

    public function getLatestVideosByCategory(Request $request, $category_name)
    {
        $videoCollection = new \Illuminate\Database\Eloquent\Collection;
        $category = DB::table('categories')->where('name', $category_name)->first();

        Log::info($category->name . "\t" . $category->id);

        $videoCollection = DB::table('videos')->where('processed', true)
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->distinct()
            ->get();

        return view('home', ['videos' => $videoCollection, 'category_name' => $category_name]);
    }
}
