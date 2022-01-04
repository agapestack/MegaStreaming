@extends('layouts.app')

@section('content')
    {{-- @dd($user_uploads) --}}

    <div id="user-videos">
        <div class="section-header">
            <h1>Mes Vidéos</h1>
        </div>

        <div class="card-group">
            <div class="row">
                @foreach ($user_uploads as $upload)
                    <div class="card" id="cardWrapper">
                        <a href="{{ '/video/' . $upload->uuid }}">

                            <div class="video-wrapper me-auto">
                                @if ($upload->processed == true)
                                    <video onmouseover="playVideo(this)" onmouseout="pauseVideo(this)"
                                        id="{{ $upload->uuid }}" muted loop
                                        class="video-js vjs-default-skin video-card-player" preload="metadata"
                                        data-setup='{"playbackRates": [0.5, 1, 1.5, 2, 4]}' width="360">

                                        <source src="{{ asset('storage/preview_videos/' . $upload->filepath) }}"
                                            type="video/mp4" />

                                        <source
                                            src="{{ asset('storage/transcoded_videos/' . $upload->uuid . '/playlist.m3u8') }}"
                                            type="application/x-mpegURL" />

                                            <source src="{{ asset('storage/videos/' . $upload->filepath) }}" type="{{ 'video/' . $upload->extension }}">

                                        <source src="{{ asset('storage/videos/' . $upload->filepath) }}" type="video/mp4">

                                        {{-- <p class="vjs-no-js">
                                                To view this video please enable JavaScript, and consider upgrading to a
                                                web browser that
                                                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                            </p> --}}
                                    </video>
                                @else
                                    {{-- La vidéo est en train d'être traité côté serveur ou cela a échoué... --}}
                                    <div class="spinner"
                                        style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 360px; height: 140px">
                                        <div class="spinner-border text-success" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="p">Traitement de la vidéo</div>
                                    </div>

                                @endif

                                <div class="card-body">
                                    <div class="card-title">
                                        <h6 style="font-size: 1.2rem; margin: 0;">{{ $upload->title }}</h6>
                                        <p style="font-size: .5rem; text-align: right;">
                                            {{ date('d-m-Y', strtotime($upload->created_at)) }}</p>
                                    </div>
                                    {{-- <div class="card-text"> --}}
                                    {{-- <p>{{ $upload->description }}</p> --}}
                                </div> 
                            </div>


                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
