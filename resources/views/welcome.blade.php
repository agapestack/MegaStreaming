@extends('layouts.app')

@section('content')

    @push('welcome')
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    @endpush

    {{-- @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif --}}

    {{-- Welcome Page d'Elise --}}
    <div class="welcome-container">
        <section class="welcome-one">
            <div class="welcome-item">
                <h1>Apprendre ou vous divertir, ne cherchez plus, Megastreamez.</h1>
                <h2>
                    Une plateforme pour partager vos vidéos ou pour en consommer
                    <br />
                    Rejoignez-nous maintenant
                </h2>
                {{-- <button type="button" class="btn btn-primary">Créer un compte</button>
                <button type="button" class="btn btn-primary">Se connecter</button> --}}
                <a href="{{ route('login') }}" role="button" class="btn btn-primary btn-redirect-auth">
                    Connectez-Vous
                </a>
                <a href="{{ route('login') }}" role="button" class="btn btn-primary btn-redirect-auth">
                    Inscrivez-Vous
                </a>
            </div>
        </section>
        <hr class="welcome-rounded" />
        <section>
            <div class="welcome-bx">
                <div class="welcome-txt">
                    <h1>
                        Une interface simple, l'accés à vos contenus à porter de main
                    </h1>
                    <h3>
                        Laissez-vous tenter par les vidéos que nous avons
                        sélectionné pour vous, tout ça sur votre page
                        d'accueil ! Tout ce que vous cherchez est disponible
                        en une page ou rangé par catégorie. Si ça ne vous
                        convient pas utilisez directement la barre de
                        recherche rien de plus simple .
                    </h3>
                </div>
                <div>
                    <img src="{{asset("assets/img/img5.png")}}" alt="" id="imgp2" />
                </div>
            </div>
        </section>
        <hr class="welcome-rounded" />
        <section>
            <div class="welcome-bx">
                <div>
                    <img src="{{asset("assets/img/image3.png")}}" alt="" id="imgp3" />
                </div>
                <div class="welcome-item welcome-txt">
                    <h1>Uploadez vos vidéos depuis votre interface utilisateur</h1>
                    <h3>
                        Pour partager vos vidéos rien de plus simple, nous
                        avons tout prévu pour vous. Votre interface
                        personnelle permettant l'accès aux vidéos que vous
                        avez partagé et le partage de vos vidéos sur nos
                        plateformes. Un titre, une description, votre
                        fichier, une catégorie et hop tout nos utilisateurs
                        peuvent profiter de votre vidéo !
                    </h3>
                </div>
            </div>
        </section>
        <hr class="welcome-rounded" />
        <section>
            <div class="welcome-bx">
                <div class="welcome-txt">
                    <h1>Un catalogue qui vous correspond</h1>
                    <h3>
                        Ne vous inquiétez pas! Vous n'avez pas les mêmes
                        intêrets que votre famille ? Pas de soucis, avec la
                        diversité de contenu que nous vous proposons, vous
                        pouvez trouver de quoi plaire à chaque membre de
                        votre famille.
                    </h3>
                </div>
                <div><img src="/assets/img/image4.png" alt="" /></div>
            </div>
        </section>
        <hr class="welcome-rounded" />
        <section class="footer section-container">
            <p>
                Copyright © 2021. Megastream. Tous droits réservés.
                <a href="#">Mentions légales</a> -
                <a href="#">Politique de confidentialité</a>
            </p>
        </section>
    </div>

@endsection