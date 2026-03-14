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
                        <label for="reservationNom">Nom de la réservation *</label>
                        <input type="text" id="reservationNom" name="reservationNom" required placeholder="Ex: Dupont, Famille Martin...">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="reservationEmail">Email *</label>
                            <input type="email" id="reservationEmail" name="reservationEmail" required placeholder="votre@email.com">
                        </div>
                        <div class="form-group">
                            <label for="reservationPhone">Téléphone</label>
                            <input type="tel" id="reservationPhone" name="reservationPhone" placeholder="06 00 00 00 00">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="reservationDate">Date *</label>
                            <input type="date" id="reservationDate" name="reservationDate" required>
                        </div>
                        <div class="form-group">
                            <label for="reservationHeure">Heure *</label>
                            <select id="reservationHeure" name="reservationHeure" required>
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
                        <label for="reservationPersonnes">Nombre de personnes *</label>
                        <select id="reservationPersonnes" name="reservationPersonnes" required>
                            <option value="">Sélectionnez</option>
                            @for ($i = 1; $i < 7; $i++)
                            <option value="{{ $i }}">{{ $i }} @choice('presonne|personnes', $i) @if($i == 6)(maximum)@endif</option>
                            @endfor
                        </select>
                        <small>Pour les groupes de plus de 6 personnes, veuillez nous contacter par téléphone ou consulter notre page <a href="{{ route('site.privatisation') }}">Privatisation</a>.</small>
                    </div> 
                    <div class="form-group">
                        <label for="reservationEmplacement">Préférence d'emplacement</label>
                        <select id="reservationEmplacement" name="reservationEmplacement">
                            <option value="indifferent">Indifférent</option>
                            <option value="terrasse">Terrasse (si disponible)</option>
                            <option value="interieur">Intérieur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reservationRemarques">Remarques ou demandes spéciales</label>
                        <textarea id="reservationRemarques" name="reservationRemarques" placeholder="Allergies, anniversaire, occasion spéciale..."></textarea>
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
    <script>
       //-----------------------------------------------------------------
        // Ajouter une reservation
        //-----------------------------------------------------------------
        $('#reservationForm').on('submit', function(e) {
            const formData = {
                name:   $('#reservationNom').val(),
                email:  $('#reservationEmail').val(),
                tel:    $('#reservationPhone').val(),
                date:   $('#reservationDate').val(),
                heure:  $('#reservationHeure').val(),
                nb:     $('#reservationPersonnes').val(),
                emp:    $('#reservationEmplacement').val(),
                rq:     $('#reservationRemarques').val(),
                source: 'web'
            };
            fetch("{{ route('admin.reservations.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    window.location.reload();
                    alert("Réservation prise en compte"); 
                } else {
                    console.error("Erreurs de validation :", data.errors);
                    alert("Erreur : " + JSON.stringify(data.errors));$
                }
            })
            .catch(error => console.error("Erreur fatale :", error));
        });
    </script>
@endsection