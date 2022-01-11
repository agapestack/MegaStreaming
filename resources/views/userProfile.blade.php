@extends('layouts.app')

@push('userStyle')
    <link rel="stylesheet" href="{{ asset('css/userProfile.css') }}">
    {{-- cropperjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.js"
        integrity="sha512-IlZV3863HqEgMeFLVllRjbNOoh8uVj0kgx0aYxgt4rdBABTZCl/h5MfshHD9BrnVs6Rs9yNN7kUQpzhcLkNmHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.css"
        integrity="sha512-5ZQRy5L3cl4XTtZvjaJRucHRPKaKebtkvCWR/gbYdKH67km1e18C1huhdAc0wSnyMwZLiO7nEa534naJrH6R/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    {{-- @dd($profile_picture) --}}

    <div class="user-settings">

        <h1>Paramètres de l'utilisateurs</h1>

        <h3>Photo de profil</h3>
        <div class="profile-picture-menu">
            {{-- Profil Picture || default profile picture --}}
            <div class="picture">
                @if (@isset(Auth::user()->profile_picture->path))
                    <img class="pp" src="{{ asset('storage/' . Auth::user()->profile_picture->path) }}" alt="">
                @else
                    <i class="far fa-user pp"></i>
                @endif
            </div>

            <div class="picture-menu">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profilePictureModal">
                    Mettre à jour la photo de profil
                </button>

                <p>L’image doit être au format JPEG, PNG ou GIF et ne doit pas dépasser 2 Mo.</p>

                {{-- TODO DELETE PP BUTTON --}}
                {{-- <button type="button" class="btn btn-danger">
                    Supprimer la photo de profil
                </button> --}}

                {{-- Profil Picture Upload Modal --}}
                <div class="modal fade" id="profilePictureModal" tabindex="-1" role="dialog"
                    aria-labelledby="profilPictureModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Mettre à jour la photo de profil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="uploadPPForm" action="{{ url('profile_picture') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <input type="file" name="file" required onchange="loadImagePreview(event)" accept="image/*">
                                    </div>

                                    <div class="form-group">
                                        <img id="imgPreview" class="pp" src="#" alt="" />
                                    </div>
                                    

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Enregister</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Crop script --}}
                    <script>
                        var imgInput = document.getElementById("imgInput");

                        function loadImagePreview(event) {
                            var imgPreview = document.getElementById("imgPreview");
                            console.log(imgPreview);
                            imgPreview.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                            }
                        }
                    </script>
                </div>

            </div>

        </div>


    </div>

@endsection
