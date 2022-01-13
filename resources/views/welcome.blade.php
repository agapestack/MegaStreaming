@extends('layouts.app')

@section('content')

    @push('welcome')
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    @endpush
    <div class="welcome-container">
        <section class="welcome-one">
            <div class="welcome-item">
                <h1>Apprendre ou vous divertir, ne cherchez plus, Megastreamez.</h1>
                <h2>
                    Une plateforme pour partager vos vidéos ou pour en consommer
                    <br />
                    Rejoignez-nous maintenant
                </h2>
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
                        Une interface intuitive
                    </h1>
                    <h3>
                        Laissez-vous tenter par les vidéos que nous avons sélectionné pour vous, tout ça sur votre page d'accueil !
                        Disponible en une page ou par categorie.
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
                    <img src="{{asset("assets/img/image3.jpg")}}" alt="" id="imgp3" />
                </div>
                <div class="welcome-item welcome-txt">
                    <h1>Uploadez vos vidéos en un clic !</h1>
                    <h3>
                        Un titre, votre video, un clic.
                        <br>Partagez votre création avec tous vos amis
                    </h3>
                </div>
            </div>
        </section>
        <hr class="welcome-rounded" />
        <section>
            <div class="welcome-bx">
                <div class="welcome-txt">
                    <h1>Un catalogue qui correspond à chacun</h1>
                    <h3>
                        Avec la diversité de contenu que nous vous proposons,
                        vous pourrez trouver de quoi plaire à chaque membre de votre famille.
                    </h3>
                </div>
                <div><img src="/assets/img/image4.png" alt="imgp4" /></div>
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