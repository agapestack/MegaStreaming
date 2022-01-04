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

    public function getVideoByUuid(Request $request, $uuid)
    {
        // Log::info($uuid);

        $video = Video::where('uuid', $uuid)->first();

        Log::info($video);

        return view('videoPlayer', ['video' => $video]);
    }

    public function getSearchResults(Request $request)
    {

        // TODO: add category specification

        $videoCollection = new \Illuminate\Database\Eloquent\Collection;

        $search = $request->text;
        $category_id = $request->category;

        // Log::info($text);
        // Log::info($category_id);

        if (isset($category_id)) {
            // Log::info("category specified");
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
