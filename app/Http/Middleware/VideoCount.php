<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class VideoCount
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
        // WORK IN PROGREE Auth::check() problem

        // Log::info("Passing By VideoCount Middleware");

        // // $user = $request->user()->user_id;
        // Log::info(Auth::user()->user_id);

        if (Auth::check()) {
            // Log::info("User is authenticated");
        //     Log::info("user is logged in");
        //     $videoCount = 0;
        //     $videoCount = DB::table('videos')
        //         ->where('user_id', Auth::id())
        //         ->count();
            
            // Log::info("Nombre de vidéos de " . Auth::id() . " = " . $videoCount);
                
        //     $request->request->add(['videoCount', $videoCount]);
        }

        return $next($request);
    }
}
