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
        <section id="hero">
            <div class="section-container">
                <div class="hero">
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

            </div>
        </section>
        <section>
            <div class="section-container">
                <div class="txt">
                    <h1>
                        Une interface simple, l'accés à vos contenus à porté de main
                    </h1>
                    <h3>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia,
                        minus optio tempore, quos vel, natus veritatis ex nulla accusamus
                        facere veniam! Vitae deleniti reprehenderit aperiam maxime
                        architecto provident odit odio molestias maiores autem ea
                        molestiae cupiditate, velit, dignissimos repellendus!
                        Exercitationem a eligendi neque. Et, nemo.
                    </h3>
                </div>
                <div>
                    <img src="#" alt="" id="imgp2" />
                </div>
            </div>
        </section>
        <section>
            <div class="section-container">
                <div>
                    <img src="#" alt="" id="imgp3" />
                </div>
                <div class="item txt">
                    <h1>Uploadez vos vidéos depuis votre interface utilisateur</h1>
                    <h3>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                        excepturi rerum animi voluptatum pariatur fuga quo dicta,
                        consequuntur dignissimos dolorem ullam aperiam ut id blanditiis
                        mollitia impedit illum possimus, iure minus error temporibus
                        exercitationem dolor. Numquam vitae minima nemo, labore quae,
                        quisquam sit, vero perspiciatis possimus tempora placeat amet
                        nostrum.
                    </h3>
                </div>
            </div>
        </section>
        <section>
            <div class="section-container">
                <div class="txt">
                    <h1>Un catalogue qui correspond à chacun</h1>
                    <h3>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Quibusdam, fuga, magnam obcaecati facere temporibus officiis odio
                        illo, veritatis dolore enim voluptate adipisci earum quis
                        consequuntur magni quasi? Dignissimos quidem, sed excepturi
                        corporis quae maxime fuga, nihil animi saepe repellendus enim
                        exercitationem magnam. In, autem id.
                    </h3>
                </div>
                <div><img src="#" alt="" /></div>
            </div>
        </section>
        <section class="footer section-container">
            <p>
                Copyright © 2021. Megastream. Tous droits réservés.
                <a href="#">Mentions légales</a> -
                <a href="#">Politique de confidentialité</a>
            </p>
        </section>
    </div>

    {{-- JS Elise Welcome --}}
    <script>
        var i;
        var toggle = document.getElementById("label");
        const pages = document.querySelectorAll("section");
    </script>

@endsection
