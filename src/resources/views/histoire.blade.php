@extends('layouts.other')

@section('content')
    <!-- Histoire -->
    <section class="section">
        <div class="container">
            <div class="historique-content">
                <h2>Notre Histoire</h2>
                <p>Créée en <strong>1967</strong> par deux frères aux abords d'un ancien télégraphe de Chappe, la Chaumière est au départ une buvette puis devient une discothèque après le bal du 14 juillet 1967.</p>
                <p>En janvier 1974, un sinistre contraint celle-ci à disparaître.</p>
                <p>Seul un frère décide de continuer l'aventure et de la reconstruire pour devenir petit à petit ce qu'elle est aujourd'hui.</p>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="section section-light">
        <div class="container">
            <div class="section-title">
                <h2>À travers les années</h2>
            </div>
            <div class="timeline">
                <div class="timeline-item">
                    <img src="http://www.alachaume.fr/images/fulls/Chaume1967.jpg" alt="La Chaumière en 1967">
                    <span class="year">1967</span>
                </div>
                <div class="timeline-item">
                    <img src="http://www.alachaume.fr/images/fulls/Chaume1969.jpg" alt="La Chaumière en 1969">
                    <span class="year">1969</span>
                </div>
                <div class="timeline-item">
                    <img src="http://www.alachaume.fr/images/fulls/Chaume1971.jpg" alt="La Chaumière en 1971">
                    <span class="year">1971</span>
                </div>
                <div class="timeline-item">
                    <img src="http://www.alachaume.fr/images/fulls/Chaume1977.jpg" alt="La Chaumière en 1977">
                    <span class="year">1977</span>
                </div>
                <div class="timeline-item">
                    <img src="http://www.alachaume.fr/images/fulls/Chaume2020.jpg" alt="La Chaumière en 2020">
                    <span class="year">2020</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Le Télégraphe de Chappe -->
    <section class="section">
        <div class="container">
            <div class="presentation">
                <div class="presentation-content">
                    <h2>Le Télégraphe de Chappe</h2>
                    <p>Le nom "La Chaumière du Télégraphe" fait référence à l'ancien <strong>télégraphe de Chappe</strong> situé à proximité.</p>
                    <p>Le télégraphe de Chappe était un système de communication visuelle inventé par Claude Chappe en 1794. Il permettait de transmettre des messages à grande distance grâce à un réseau de tours équipées de bras articulés.</p>
                    <p>La tour située près de La Chaumière faisait partie de la ligne Paris-Lyon, permettant de transmettre un message en seulement quelques minutes sur plusieurs centaines de kilomètres.</p>
                </div>
                <div class="presentation-image">
                    <img src="/images/histoire/1967.jpg" alt="Photo historique de La Chaumière">
                </div>
            </div>
        </div>
    </section>

    <!-- Aujourd'hui -->
    <section class="section section-light">
        <div class="container">
            <div class="presentation-image">
                <img src="/images/histoire/2000.jpg" alt="Photo historique de La Chaumière">
            </div>
            <div class="historique-content">
                <h2>Aujourd'hui</h2>
                <p>Plus de 55 ans après sa création, La Chaumière du Télégraphe continue d'accueillir les visiteurs dans le même esprit convivial qui a fait sa réputation.</p>
                <p>Lieu de rencontre pour les familles, les randonneurs, les grimpeurs et les amateurs de musique, elle reste un endroit unique au cœur de la forêt des Grands Avaux.</p>
                <a href="{{ route('site.presentation') }}" class="btn mt-2">Découvrir La Chaumière</a>
            </div>
        </div>
    </section>
@endsection