<?php

namespace App\Http\Middleware;

use App\Models\Categorie;
use App\Models\ProfilePicture;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class addUserData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info("passing in addUserData middleware");
        if(Auth::check()) {
            view()->composer('*', function($view) {
                $profile_picture = ProfilePicture::where('user_id', '=', Auth::id())->first();
                $view->with(['profile_picture' => $profile_picture]);
            });
        }

        return $next($request);
    }
}
