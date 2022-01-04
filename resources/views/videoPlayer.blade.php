@extends('layouts.app')

@section('content')
    <div id="video-player">
        {{-- @dd($video) --}}
        @if(isset($video))
        <div class="video-container">
            <video id="videoPlayer" class="video-js" controls preload="auto"
                data-setup='{"responsive": true, "fluid": true}'>

                <source src="{{ asset('storage/transcoded_videos/' . $video->uuid . '/playlist.m3u8') }}"
                    type="application/x-mpegURL" />
            </video>
        </div>

        <p id="videoTitle">{{ $video->title }}</p>
        @else
            <h1>Error 404 Video not found</h1>
        @endif
    </div>
@endsection
