@extends('layouts.other')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="container">
            <div class="presentation">
                <div class="presentation-image">
                    <img src="/images/bg/bg.jpg" alt="La terrasse de La Chaumière">
                </div>
                <div class="presentation-content">
                    <h2>Une taverne au cœur de la forêt</h2>
                    <p><strong>À deux, en famille ou entre amis</strong>, La Chaume vous propose une <strong>cuisine traditionnelle</strong> (salades composées, viandes, saumon...), un large choix de <strong>bières</strong> (plus de cinquante) ainsi que de nombreux <strong>cocktails, glaces, crêpes et desserts</strong>.</p>
                    <p><a href="/images/Menu.pdf" target="_blank" class="btn">Voir le Menu (PDF)</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nos Espaces -->
    <section class="section section-light">
        <div class="container">
            <div class="section-title">
                <h2>Nos Espaces</h2>
            </div>
            <div class="presentation">
                <div class="presentation-content">
                    <h3>Deux salles intérieures</h3>
                    <p>L'une ouverte en permanence pour vous accueillir dans une ambiance chaleureuse. Celle à l'étage est ouverte pour les <strong>soirées concerts</strong> ou pour une éventuelle <strong>privatisation</strong>.</p>
                    
                    <h3 class="mt-3">Deux terrasses extérieures</h3>
                    <p>Aux beaux jours, deux terrasses vous permettent de profiter du <strong>magnifique cadre naturel</strong>. Les réservations sont fortement conseillées pour les repas.</p>
                    <p>Une terrasse pour boire un verre le midi ou le soir après le repas est toujours disponible.</p>
                </div>
                <div class="presentation-image">
                    <img src="/images/exterieur/03.jpg" alt="Terasse de La Chaumière">
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Cuisine -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Notre Cuisine</h2>
            </div>
            <div class="infos-grid">
                <div class="info-card">
                    <h3>Plats Traditionnels</h3>
                    <p>Découvrez notre cuisine traditionnelle française :</p>
                    <ul style="list-style: disc; padding-left: 20px;">
                        <li>Salades composées</li>
                        <li>Viandes grillées</li>
                        <li>Saumon et poissons</li>
                        <li>Plats du jour</li>
                    </ul>
                </div>
                <div class="info-card">
                    <h3>Bar & Desserts</h3>
                    <p>Un large choix de boissons et douceurs :</p>
                    <ul style="list-style: disc; padding-left: 20px;">
                        <li>Plus de 50 bières</li>
                        <li>Cocktails variés</li>
                        <li>Glaces artisanales</li>
                        <li>Crêpes et desserts maison</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="section section-light">
        <div class="container">
            <div class="section-title">
                <h2>Galerie Photos</h2>
            </div>
            <div class="gallery">
                <div class="gallery-item">
                    <img src="/images/bg/01.jpg" alt="La Chaumière - Photo 1">
                </div>
                <div class="gallery-item">
                    <img src="/images/bg/02.jpg" alt="La Chaumière - Photo 2">
                </div>
                <div class="gallery-item">
                    <img src="/images/bg/03.jpg" alt="La Chaumière - Photo 3">
                </div>
                <div class="gallery-item">
                    <img src="/images/bg/04.jpg" alt="La Chaumière - Photo 4">
                </div>
                <div class="gallery-item">
                    <img src="/images/bg/05.jpg" alt="La Chaumière - Photo 5">
                </div>
                <div class="gallery-item">
                    <img src="/images/bg/06.jpg" alt="La Chaumière - Photo 6">
                </div>
                <div class="gallery-item">
                    <img src="/images/drink/drink1.jpg" alt="La Chaumière - Photo 7">
                </div>
                <div class="gallery-item">
                    <img src="/images/drink/drink2.jpg" alt="La Chaumière - Photo 8">
                </div>
                <div class="gallery-item">
                    <img src="/images/drink/drink3.jpg" alt="La Chaumière - Photo 9">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam1.jpg" alt="La Chaumière - Photo 10">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam2.jpg" alt="La Chaumière - Photo 11">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam3.jpg" alt="La Chaumière - Photo 12">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam4.jpg" alt="La Chaumière - Photo 13">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam5.jpg" alt="La Chaumière - Photo 14">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam6.jpg" alt="La Chaumière - Photo 15">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam7.jpg" alt="La Chaumière - Photo 16">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam8.jpg" alt="La Chaumière - Photo 17">
                </div>
                <div class="gallery-item">
                    <img src="/images/miam/miam9.jpg" alt="La Chaumière - Photo 18">
                </div>
            </div>
        </div>
    </section>
@endsection