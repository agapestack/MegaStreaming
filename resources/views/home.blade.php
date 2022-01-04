@extends('layouts.app')

@section('content')
    {{-- @dd($categories) --}}
    <div id="home">
        <div class="section-header">
            {{-- @if (Request::get('category_name')) --}}
            @if (isset($category_name))
                <div class="category-wrapper">
                    {{-- TODO y'a des helpers pour faire ça (https://laravel.com/docs/7.x/helpers#method-str-upper) --}}
                    {{-- TODO mais y'a surtout une propriété CSS mdr, text-transform (bien plus léger) --}}
                    <h1>{{ mb_strtoupper($category_name) }}</h1>
                    <a href="/home">
                        <i class="fas fa-home"></i>
                    </a>
                </div>
                <div class="category_bar"></div>
            @else
                <div class="categories-navbar">
                    @foreach ($categories as $category)
                        <div class="category-link btn btn-light">
                            <i class="{{ $category->fa_class }}"></i>
                            <a href="/home/{{ $category->name }}">{{ $category->name }}</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="card-group">
            <div class="row">
                @foreach ($videos as $upload)
                    <div class="card">
                        <a href="{{ '/video/' . $upload->uuid }}">

                            <div class="video-wrapper me-auto">
                                {{-- TODO pour les booléens, pas besoin de mettre d'égalité, ils parlent d'eux même: if($upload->processed) --}}
                                @if ($upload->processed == true)
                                    {{-- TODO alors ça c'est la dinguerie perso j'aurais généré un gif ou juste enchaîné 3-4 miniatures photo mdrrrr --}}
                                    <video onmouseover="playVideo(this)" onmouseout="pauseVideo(this)"
                                        id="{{ $upload->uuid }}" muted loop
                                        class="video-js vjs-default-skin video-card-player" preload="metadata"
                                        data-setup='{"playbackRates": [0.5, 1, 1.5, 2, 4]}' width="360">

                                        <source src="{{ asset('storage/preview_videos/' . $upload->filepath) }}"
                                            type="video/mp4" />

                                        <source
                                            src="{{ asset('storage/transcoded_videos/' . $upload->uuid . '/playlist.m3u8') }}"
                                            type="application/x-mpegURL" />

                                        <source src="{{ asset('storage/videos/' . $upload->filepath) }}"
                                            type="{{ 'video/' . $upload->extension }}">

                                        <source src="{{ asset('storage/videos/' . $upload->filepath) }}" type="video/mp4">

                                    </video>
                                    {{-- TODO là tu peux mettre un @else avec un placeholder ou un loader qui tourne, exemple: https://fontawesome.com/v5.15/how-to-use/on-the-web/styling/animating-icons --}}
                                @endif
                                <div class="card-body">
                                    <div class="card-title">
                                        <h6 style="font-size: 1.2rem; margin: 0;">{{ $upload->title }}</h6>
                                        <p style="font-size: .5rem; text-align: right;">
                                            {{ date('d-m-Y', strtotime($upload->created_at)) }}</p> {{-- TODO format possible dans les models pour eviter de répéter le code: https://laravel.com/docs/7.x/eloquent-mutators#date-mutators --}}
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
