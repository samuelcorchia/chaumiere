@extends('layouts.other')

@section('content')
    <!-- Intro Privatisation -->
    <section class="section">
        <div class="container">
            <div class="presentation">
                <div class="presentation-image">
                    <img src="/images/interieur/event.jpg" alt="Salle à privatiser">
                </div>
                <div class="presentation-content">
                    <h2>Un lieu unique pour vos événements</h2>
                    <p>La Chaumière du Télégraphe met à votre disposition sa <strong>salle à l'étage</strong> pour vos événements privés.</p>
                    <p>Dans un cadre naturel exceptionnel, au cœur de la forêt des Grands Avaux, organisez vos :</p>
                    <ul class="privatisation-features">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Anniversaires et fêtes de famille</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Réunions d'entreprise et séminaires</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Fêtes entre amis</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Événements associatifs</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Nos Services -->
    <section class="section section-light">
        <div class="container">
            <div class="section-title">
                <h2>Nos Services</h2>
            </div>
            <div class="infos-grid">
                <div class="info-card">
                    <h3>La Salle</h3>
                    <p>Notre salle à l'étage peut accueillir vos événements dans une ambiance chaleureuse.</p>
                    <ul style="list-style: disc; padding-left: 20px; margin-top: 15px;">
                        <li>Capacité adaptée à vos besoins</li>
                        <li>Équipement son disponible</li>
                        <li>Décoration personnalisable</li>
                        <li>Espace privatif</li>
                    </ul>
                </div>
                <div class="info-card">
                    <h3>La Restauration</h3>
                    <p>Profitez de notre cuisine traditionnelle pour vos événements.</p>
                    <ul style="list-style: disc; padding-left: 20px; margin-top: 15px;">
                        <li>Menus personnalisés</li>
                        <li>Large choix de bières</li>
                        <li>Cocktails et boissons</li>
                        <li>Desserts et crêpes</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulaire de Contact -->
    <section class="section">
        <div class="container">
            <div class="privatisation-content">
                <div class="privatisation-info">
                    <h2>Demande de Privatisation</h2>
                    <p>Pour toute demande de privatisation, contactez-nous par téléphone ou remplissez le formulaire ci-contre.</p>
                    <p>Nous vous recontacterons rapidement pour discuter de votre projet et établir un devis personnalisé.</p>
                    
                    <h3 class="mt-3">Contact Direct</h3>
                    <div class="contact-info">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <strong style="font-size: 1.3rem;">01.64.98.04.71</strong>
                        </p>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Formulaire de Contact</h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="nom">Nom complet *</label>
                            <input type="text" id="nom" name="nom" required placeholder="Votre nom">
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required placeholder="votre@email.com">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" id="telephone" name="telephone" placeholder="06 00 00 00 00">
                        </div>
                        <div class="form-group">
                            <label for="type">Type d'événement</label>
                            <select id="type" name="type">
                                <option value="">Sélectionnez...</option>
                                <option value="anniversaire">Anniversaire</option>
                                <option value="entreprise">Événement d'entreprise</option>
                                <option value="famille">Fête de famille</option>
                                <option value="amis">Fête entre amis</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Description de votre projet *</label>
                            <textarea id="message" name="message" required placeholder="Décrivez votre événement (nombre de personnes, date souhaitée, besoins particuliers...)"></textarea>
                        </div>
                        <button type="submit" class="btn">Envoyer la demande</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection