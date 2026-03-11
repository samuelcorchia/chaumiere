@extends('layouts.other')

@section('content')
    <!-- Horaires -->
    <section class="section">
        <div class="container">
            <div class="infos-grid">
                <div class="info-card">
                    <h3>Horaires de l'établissement</h3>
                    <ul class="horaires-list">
                        <li>
                            <span class="jour">Vendredi</span>
                            <span class="heures">de 18h à 00h30</span>
                        </li>
                        <li>
                            <span class="jour">Samedi</span>
                            <span class="heures">de midi à 00h30</span>
                        </li>
                        <li>
                            <span class="jour">Dimanche</span>
                            <span class="heures">de midi à 23h30</span>
                        </li>
                    </ul>
                </div>
                <div class="info-card">
                    <h3>Horaires de la Cuisine</h3>
                    <p style="margin-bottom: 20px; color: var(--color-secondary);">Du Vendredi au Dimanche</p>
                    <ul class="horaires-list">
                        <li>
                            <span class="jour">Vendredi</span>
                            <span class="heures">de 19h30 à 21h30</span>
                        </li>
                        <li>
                            <span class="jour">Samedi</span>
                            <span class="heures">12h-14h et 19h30-21h30</span>
                        </li>
                        <li>
                            <span class="jour">Dimanche</span>
                            <span class="heures">12h-14h et 19h30-21h30</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Réservations -->
    <section class="section section-light">
        <div class="container">
            <div class="section-title">
                <h2>Réservations & Contact</h2>
            </div>
            <div class="infos-grid">
                <div class="info-card">
                    <h3>Réservations</h3>
                    <div class="contact-info">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <strong style="font-size: 1.5rem;">01.64.98.04.71</strong>
                        </p>
                    </div>
                    <p class="mt-2">Les réservations sont <strong>fortement conseillées</strong> pour les repas.</p>
                    <p>Une terrasse pour boire un verre le midi ou le soir après le repas est toujours disponible sans réservation.</p>
                </div>
                <div class="info-card">
                    <h3>Adresse</h3>
                    <div class="contact-info">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span>
                                <strong>La Chaumière du Télégraphe</strong><br>
                                Forêt des Grands Avaux<br>
                                91750 Champcueil
                            </span>
                        </p>
                    </div>
                    <p class="mt-2">Nichée au cœur de la forêt, avec ses promenades et ses rochers d'escalade.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Accès -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Comment nous trouver</h2>
            </div>
            <div class="presentation">
                <div class="presentation-content">
                    <h3>Au cœur de la nature</h3>
                    <p>La Chaumière du Télégraphe est située dans la <strong>forêt des Grands Avaux</strong> à Champcueil (91750), un cadre naturel exceptionnel.</p>
                    <p>Profitez de votre visite pour découvrir :</p>
                    <ul style="list-style: disc; padding-left: 20px; margin-bottom: 20px;">
                        <li><a href="https://www.cirkwi.com/fr/circuit/187741-les-grands-avaux" target="_blank">Les sentiers de promenade</a></li>
                        <li><a href="https://sites.google.com/site/topobleau/escalades-bleau/nord-essonne/rocher-du-duc" target="_blank">Les rochers d'escalade du Rocher du Duc</a></li>
                        <li><a href="https://www.facebook.com/CDEssonne/videos/1322224565397887/" target="_blank">La forêt des Grands Avaux</a></li>
                    </ul>
                </div>
                <div class="presentation-image">
                    <img src="/images/exterieur/terrasse.jpg" alt="Vue de La Chaumière">
                </div>
            </div>
        </div>
    </section>
@endsection