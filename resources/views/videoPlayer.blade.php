@extends('layouts.app')

@section('content')
    <div>
        <div class="video-container">
            <video id="videoPlayer" class="video-js" controls preload="auto"
                   data-setup='{"responsive": true, "fluid": true}'>

                <source src="{{ asset('storage/transcoded_videos/' . $video->uuid . '/playlist.m3u8') }}"
                        type="application/x-mpegURL"/>
            </video>
        </div>
        <div class="desc-wrapper">
            <div class="bootstrap-card video-desc">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-8">
                                <h2 id="videoTitle">{{ $video->title }}</h2>
                            </div>
                            <div class="col-4 text-right">Publiée le {{$video->created_at->format('d/m/Y')}}
                                par {{$video->author->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p>{{$video->description}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                 <span class="mr-2">Vidéo aimée
                                        <span id="likeNumber">{{$video->users()->count()}}</span>
                                        fois
                                    </span>
                                <i id="likeStatus" class="text-danger @if($video->likedByUser(Auth::user())) fas @else far @endif fa-heart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const Like = () => {
            const toggleLike = () => {
                const likeStatus = document.getElementById('likeStatus');
                const likeNumber = document.getElementById('likeNumber');
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '{{route('video.toggleLike', ['video' => $video->id])}}');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        const response = JSON.parse(xhr.response);
                        likeNumber.innerHTML = response.numberOfLikes;
                        if (response.liked) {
                            likeStatus.classList.add('fas');
                            likeStatus.classList.remove('far');
                        } else {
                            likeStatus.classList.add('far');
                            likeStatus.classList.remove('fas');
                        }
                    }
                };
                const formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('_token', '{{csrf_token()}}');
                xhr.send(formData);
            };

            document.addEventListener('click', function(event) {
                if(event.target.id === 'likeStatus') {
                    toggleLike();
                }
            });
        };
        Like();
    </script>
@endsection