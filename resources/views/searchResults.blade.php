@extends('layouts.app')

@section('content')
    {{-- @dd($categories)
    @dd($videos) --}}
    {{-- <div id="search-result">
        @foreach ($videos as $video)
            <h1>{{$video->title}}</h1>
            <a href="video/{{$video->uuid}}">{{ $video->title }}</a>
        @endforeach
    </div> --}}
    <div id="search">
        <h3>
            Résultats pour {{ Request::get('text') }}
            @if (Request::get('category') != null)
                {{-- TODO la logique dans une vue c'est interdit par les conventions de Genève, débrouille toi pour mettre ça dans le controller --}}
                , Catégorie: {{ $categories->where('id', Request::get('category'))->first()->name }}
            @endif
        </h3>
        <div class="card-group">
            <div class="col">
                @foreach ($videos as $video)
                    {{-- TODO tu repetes le meme code que dans la home, idealement fais un composant qui prend en param $video (et ça te piquera moins les yeux) --}}
                    <div class="card">
                        <a href="{{ '/video/' . $video->uuid }}">
                            <div class="video-wrapper me-auto">
                                @if ($video->processed == true)

                                    <video onmouseover="playVideo(this)" onmouseout="pauseVideo(this)"
                                        id="{{ $video->uuid }}" muted loop
                                        class="video-js vjs-default-skin video-card-player" preload="metadata"
                                        data-setup='{"playbackRates": [0.5, 1, 1.5, 2, 4]}' width="360">

                                        <source
                                            src="{{ asset('storage/transcoded_videos/' . $video->uuid . '/playlist.m3u8') }}"
                                            type="application/x-mpegURL" />

                                        <source src="{{ asset('storage/videos/' . $video->filepath) }}"
                                            type="{{ 'video/' . $video->extension }}">

                                        <source src="{{ asset('storage/videos/' . $video->filepath) }}" type="video/mp4">

                                        {{-- <p class="vjs-no-js">
                                        To view this video please enable JavaScript, and consider upgrading to a
                                        web browser that
                                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                    </p> --}}
                                    </video>
                                    {{-- TODO là tu peux mettre un @else avec un placeholder ou un loader qui tourne, exemple: https://fontawesome.com/v5.15/how-to-use/on-the-web/styling/animating-icons --}}
                                @endif
                            </div>


                            {{-- <div class="card-body"> --}}
                            <div class="card-title">
                                <h6 style="font-size: 1.2rem; margin: 0;">{{ $video->title }}</h6>
                                <p style="font-size: .5rem; text-align: right;">
                                    {{ date('d-m-Y', strtotime($video->created_at)) }}</p> {{-- TODO format possible dans les models pour eviter de répéter le code: https://laravel.com/docs/7.x/eloquent-mutators#date-mutators --}}
                            </div>
                            {{-- <div class="card-text">
                        <p >{{ $video->description }}</p>
                    </div> --}}

                        </a>
                    </div>
                @endforeach
            </div>

        @endsection
