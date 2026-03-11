@extends('layouts.other')

@section('content')
    <!-- Formulaire de Réservation -->
    <section class="section reservation-section">
        <div class="container">
            <div class="reservation-form-container">
                <div class="reservation-info">
                    <h2>🌲 Réservez votre expérience</h2>
                    <p>Offrez-vous un moment unique au cœur de la forêt des Grands Avaux. Terrasse perchée, cuisine traditionnelle et ambiance conviviale vous attendent.</p>
                    
                    <ul class="reservation-highlights">
                        <!-- <li>Tables jusqu'à 6 personnes</li> -->
                        <li>Terrasse avec vue sur la forêt</li>
                        <li>Plus de 50 bières artisanales</li>
                        <li>Cuisine traditionnelle française</li>
                        <li>Soirées Concerts ou evenements</li>
                    </ul>

                    <!--
                    <div class="mt-3">
                        <h3>📞 Réservation par téléphone</h3>
                        <p style="font-size: 1.5rem; font-weight: 700;">01.64.98.04.71</p>
                    </div>
                    -->
                </div>

                <form class="contact-form" id="reservationForm" action="#" method="POST">
                    <h3 style="margin-bottom: 25px; color: var(--color-primary);">📝 Formulaire de Réservation</h3>
                    
                    <div class="form-group">
                        <label for="nom">Nom de la réservation *</label>
                        <input type="text" id="nom" name="nom" required placeholder="Ex: Dupont, Famille Martin...">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required placeholder="votre@email.com">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone *</label>
                            <input type="tel" id="telephone" name="telephone" required placeholder="06 00 00 00 00">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="date">Date *</label>
                            <input type="date" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="heure">Heure *</label>
                            <select id="heure" name="heure" required>
                                <option value="">Choisir un créneau</option>
                                <optgroup label="Déjeuner (Samedi & Dimanche)">
                                    <option value="12:00">12h00</option>
                                    <option value="12:30">12h30</option>
                                    <option value="13:00">13h00</option>
                                    <option value="13:30">13h30</option>
                                </optgroup>
                                <optgroup label="Dîner">
                                    <option value="19:30">19h30</option>
                                    <option value="20:00">20h00</option>
                                    <option value="20:30">20h30</option>
                                    <option value="21:00">21h00</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="personnes">Nombre de personnes *</label>
                        <select id="personnes" name="personnes" required>
                            <option value="">Sélectionnez</option>
                            <option value="1">1 personne</option>
                            <option value="2">2 personnes</option>
                            <option value="3">3 personnes</option>
                            <option value="4">4 personnes</option>
                            <option value="5">5 personnes</option>
                            <option value="6">6 personnes (maximum)</option>
                        </select>
                        <small>Pour les groupes de plus de 6 personnes, veuillez nous contacter par téléphone ou consulter notre page <a href="{{ route('site.privatisation') }}">Privatisation</a>.</small>
                    </div>

                    <div class="form-group">
                        <label for="emplacement">Préférence d'emplacement</label>
                        <select id="emplacement" name="emplacement">
                            <option value="indifferent">Indifférent</option>
                            <option value="terrasse">Terrasse (si disponible)</option>
                            <option value="interieur">Intérieur</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="remarques">Remarques ou demandes spéciales</label>
                        <textarea id="remarques" name="remarques" placeholder="Allergies, anniversaire, occasion spéciale..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-accent btn-large" style="width: 100%;">
                        ✓ Confirmer ma réservation
                    </button>

                    <p style="text-align: center; margin-top: 15px; font-size: 0.9rem; color: var(--color-text-light);">
                        Vous recevrez un email de confirmation sous 24h.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- Infos pratiques -->
    <section class="section section-green" style="color: #000;">
        <div class="container">
            <div class="section-title">
                <h2 style="color: white;">📅 Horaires de la cuisine</h2>
            </div>
            <div class="infos-grid" style="max-width: 800px; margin: 0 auto;">
                <div class="info-card" style="background: rgba(255,255,255,0.95);">
                    <h3 style="color: darkgreen;">Vendredi</h3>
                    <p style="font-size: 1.2rem;">Dîner uniquement<br><strong>19h30 à 21h30</strong></p>
                </div>
                <div class="info-card" style="background: rgba(255,255,255,0.95);">
                    <h3 style="color: darkgreen;">Samedi & Dimanche</h3>
                    <p style="font-size: 1.2rem;">Déjeuner : <strong>12h à 14h</strong><br>Dîner : <strong>19h30 à 21h30</strong></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Galerie Photos -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Un cadre exceptionnel vous attend</h2>
            </div>
            <div class="photos-grid">
                <div class="photo-item large">
                    <img src="/images/exterieur/terrasse.jpg" alt="Ambiance">    
                </div>
                <div class="photo-item">
                    <img src="/images/bg/02.jpg" alt="Vue du restaurant">
                </div>
                <div class="photo-item">
                    <img src="/images/bg/03.jpg" alt="Intérieur">
                </div>
                <div class="photo-item">
                    <img src="/images/bg/01.jpg" alt="Vue extérieure de La Chaumière">    
                </div>
                <div class="photo-item">
                    <img src="/images/bg/05.jpg" alt="La Chaumière">
                </div>
            </div>
        </div>
    </section>

    <!-- Photos des plats -->
    <!-- 
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>🍽 Notre Cuisine</h2>
            </div>
            <div class="photos-grid">
                <div class="photo-item">
                    <img src="http://www.alachaume.fr/images/thumbs/05.jpg" alt="Photo 5">
                </div>
                <div class="photo-item">
                    <img src="http://www.alachaume.fr/images/thumbs/06.jpg" alt="Photo 6">
                </div>
                <div class="photo-item">
                    <img src="http://www.alachaume.fr/images/thumbs/07.jpg" alt="Photo 7">
                </div>
                <div class="photo-item">
                    <img src="http://www.alachaume.fr/images/thumbs/08.jpg" alt="Photo 8">
                </div>
            </div>
        </div>
    </section>
    -->
@endsection