@extends('layouts.other')

@section('content')
     <!-- Concerts à venir -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Prochains Concerts</h2>
            </div>
            <div class="concerts-list">
                @forelse($concerts as $concert)
                    <div class="concert-card">
                    <div class="concert-date">
                        <span class="day">{{ \Carbon\Carbon::parse($concert->date_event)->format('d') }}</span>
                        <span class="month">{{ \Carbon\Carbon::parse($concert->date_event)->format('F') }}</span>
                    </div>
                    <div class="concert-info">
                        <h4>{{ $concert->name_event}}</h4>
                        <p class="genre">{{ $concert->type_event}}</p>
                    </div>
                    <a href="{{ $concert->link_event}}" target="_blank" class="concert-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                        </svg>
                        Écouter
                    </a>
                </div>
                @empty
                    <p class="text-muted">Aucun concert à venir</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Info concerts -->
    <section class="section section-light">
        <div class="container">
            <div class="presentation">
                <div class="presentation-image">
                    <img src="/images/bg/06.jpg" alt="Concert à La Chaumière">
                </div>
                <div class="presentation-content">
                    <h2>Musique Live</h2>
                    <p>Chaque semaine, La Chaumière du Télégraphe accueille des artistes et groupes locaux pour des soirées musicales uniques.</p>
                    <p>Les concerts ont lieu le <strong>samedi soir</strong> dans notre salle à l'étage, spécialement aménagée pour ces événements.</p>
                    <p>Ambiance conviviale garantie dans un cadre naturel exceptionnel !</p>
                    <h3 class="mt-3">Réservations</h3>
                    <p>Pour les soirées concerts, nous vous conseillons de réserver votre table.</p>
                    <p><strong>Tél : 01.64.98.04.71</strong></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Artistes -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Vous êtes artiste ?</h2>
            </div>
            <div class="text-center" style="max-width: 700px; margin: 0 auto;">
                <p>Vous souhaitez vous produire à La Chaumière du Télégraphe ? Nous sommes toujours à la recherche de nouveaux talents pour animer nos soirées.</p>
                <p>Contactez-nous par téléphone ou via notre page Facebook pour nous présenter votre projet musical.</p>
                <div class="mt-3">
                    <a href="https://www.facebook.com/lachaumiere91" target="_blank" class="btn">Nous contacter sur Facebook</a>
                </div>
            </div>
        </div>
    </section>
@endsection