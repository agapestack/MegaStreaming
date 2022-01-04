<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertVideoForStreaming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Categorie;
use App\Models\Video;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    // UPLOAD
    public function uploadVideo(Request $request)
    {
        $video = new Video();

        // TODO SANITIZER validate stuff

        $file = $request->file('file');
        $video->extension = $file->getClientOriginalExtension();
        $video->user_id = Auth::user()->id;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->uuid = Str::uuid();
        $video->size = $request->file('file')->getSize();
        $video->category_id = $request->get('videoCategory');
        $video->filepath = $video->uuid . "." . $video->extension;
        $video->disk = 'local';
        //TODO pour éviter de répeter des lignes: https://laravel.com/docs/7.x/eloquent#mass-assignment
        // exemple: Video::create(['propriété1' => $valeur1, 'propriété2' => $valeur2,])

        $request->file('file')->storeAs(
            'videos',
            $video->filepath,
            $video->disk
        );

        $video->save();

        // Dispatching job: conversion to HLS & video preview creation
        $this->dispatch(new ConvertVideoForStreaming($video));

        return redirect()->back();
    }

    //TODO typer le paramètre uuid
    public function getVideoByUuid(Request $request, $uuid)
    {
        // Log::info($uuid);
        // Log::info(gettype($uuid));

        //TODO comportement lorsque l'uuid en question n'existe pas en BDD: https://laravel.com/docs/7.x/eloquent#retrieving-single-models
        $video = Video::where('uuid', $uuid)->first();

        return view('videoPlayer', ['video' => $video]);
    }

    public function getSearchResults(Request $request)
    {

        // TODO: add category specification

        // TODO inutile, en dessous y'a un if et un else donc la collection est forcément crée
        $videoCollection = new \Illuminate\Database\Eloquent\Collection;

        $search = $request->text;
        $category_id = $request->category;

        // Log::info($text);
        // Log::info($category_id);

        //TODO simplifiable avec une query conditionnelle when(): https://laraveldaily.com/less-know-way-conditional-queries/
        if (isset($category_id)) {
            // Log::info("category specified");
            //TODO pagination, une base pour les resultats de recherche (et pour les listes d'éléments de façon generale)
            $videoCollection =
                Video::where('title', 'ILIKE', '%' . $search . '%')
                ->where('category_id', $category_id)
                ->where('processed', true)
                ->get();
        } else {
            // Log::info("category not specified");
            $videoCollection =
                Video::where('title', 'ILIKE', '%' . $search . '%')
                ->where('processed', true)
                ->get();
        }

        Log::info($videoCollection->toArray());


        return view('searchResults', ['videos' => $videoCollection]);
    }
}
