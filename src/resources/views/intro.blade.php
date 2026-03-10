@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="background-image: url('/images/bg/bg.jpg');">
        <div class="hero-content">
            <h1>Bienvenue à La Chaumière du Télégraphe</h1>
            <p>Une taverne nichée au cœur de la <strong>forêt des Grands Avaux</strong> à Champcueil. Découvrez notre terrasse perchée, notre cuisine traditionnelle et nos <strong>50+ bières artisanales</strong>.</p>
            <div class="mt-3">
                <a href="{{ route('site.reservations') }}" class="btn-cta">
                    RÉSERVER MA TABLE
                </a>
            </div>
            <p style="margin-top: 20px; font-size: 1.1rem; opacity: 0.95;">
                ou appelez-nous : <a href="tel:0164980471" style="color: var(--color-accent); font-weight: 700; font-size: 1.2rem;">01 64 98 04 71</a>
            </p>
        </div>
        <a href="#decouverte" class="scroll-indicator">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </a>
    </section>

    <!-- Découverte Section -->
    <section id="decouverte" class="section">
        <div class="container">
            <div class="section-title">
                <h2>🍽️ Découvrez nos spécialités</h2>
            </div>
            <div class="photos-grid">
                <div class="photo-item large">
                    <img src="/images/miam/miam1.jpg" alt="Terrasse de La Chaumière">
                </div>
                <div class="photo-item">
                    <img src="/images/miam/miam2.jpg" alt="Vue du restaurant">
                </div>
                <div class="photo-item">
                    <img src="/images/miam/miam3.jpg" alt="Intérieur">
                </div>
                <div class="photo-item">
                    <img src="/images/miam/miam4.jpg" alt="Ambiance">
                </div>
                <div class="photo-item">
                    <img src="/images/miam/miam5.jpg" alt="La Chaumière">
                </div>
            </div>
        </div>
    </section>

    <!-- Présentation Preview -->
    <section class="section section-light">
        <div class="container">
            <div class="presentation">
                <div class="presentation-image">
                    <img src="/images/bg/bg.jpg" alt="La terrasse de La Chaumière">
                </div>
                <div class="presentation-content">
                    <h2>Un cadre unique en forêt</h2>
                    <p><strong>À deux, en famille ou entre amis</strong>, La Chaume vous propose une <strong>cuisine traditionnelle</strong> (salades composées, viandes, saumon...), un large choix de <strong>bières</strong> (plus de cinquante) ainsi que de nombreux <strong>cocktails, glaces, crêpes et desserts</strong>.</p>
                    <p><strong>Deux salles intérieures</strong> : l'une ouverte en permanence, celle à l'étage est ouverte pour les soirées concerts ou pour une éventuelle privatisation.</p>
                    <p>⭐ <strong>Note Google : 4.4/5</strong> sur 1192 avis</p>
                    <a href="{{ route('site.presentation') }}" class="btn">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Cuisine -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>🍴 Notre Cuisine Traditionnelle</h2>
            </div>
            <div class="photos-grid" style="grid-template-columns: repeat(4, 1fr);">
                <div class="photo-item">
                    <img src="/images/miam/miam6.jpg" alt="Photo 1">
                </div>
                <div class="photo-item">
                    <img src="/images/miam/miam7.jpg" alt="Photo 2">
                </div>
                <div class="photo-item">
                    <img src="/images/miam/miam8.jpg" alt="Photo 3">
                </div>
                <div class="photo-item">
                    <img src="/images/miam/miam9.jpg" alt="Photo 4">
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="/images/Menu.pdf" target="_blank" class="btn btn-outline">📄 Voir le Menu (PDF)</a>
            </div>
        </div>
    </section>

    <!-- Réservation CTA -->
    <section class="section section-green">
        <div class="container text-center">
            <h2 style="color: white;">🌟 Réservez votre table</h2>
            <p style="max-width: 600px; margin: 0 auto 30px; opacity: 0.9;">
                Profitez d'un moment unique au cœur de la forêt. Tables jusqu'à 6 personnes, terrasse avec vue sur les arbres.
            </p>
            <a href="{{ route('site.reservations') }}" class="btn btn-accent btn-large">Réserver maintenant</a>
            <p class="mt-2" style="opacity: 0.8;">ou appelez-nous au <strong>01.64.98.04.71</strong></p>
        </div>
    </section>

    <!-- Infos Preview -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>📍 Horaires & Contact</h2>
            </div>
            <div class="infos-grid">
                <div class="info-card">
                    <h3>🕐 Horaires de l'établissement</h3>
                    <ul class="horaires-list">
                        <li>
                            <span class="jour">Vendredi</span>
                            <span class="heures">18h à 00h30</span>
                        </li>
                        <li>
                            <span class="jour">Samedi</span>
                            <span class="heures">midi à 00h30</span>
                        </li>
                        <li>
                            <span class="jour">Dimanche</span>
                            <span class="heures">midi à 23h30</span>
                        </li>
                    </ul>
                </div>
                <div class="info-card">
                    <h3>📞 Réservations</h3>
                    <div class="contact-info">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <strong style="font-size: 1.5rem;">01.64.98.04.71</strong>
                        </p>
                        <p>Réservations fortement conseillées pour les repas.</p>
                    </div>
                    <a href="{{ route('site.infos') }}" class="btn btn-outline mt-2">Plus d'informations</a>
                </div>
            </div>
        </div>
    </section>
@endsection