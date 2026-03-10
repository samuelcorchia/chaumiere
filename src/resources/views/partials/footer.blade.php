<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h4>La Chaumière du Télégraphe</h4>
                <p>Une taverne au cœur de la forêt des Grands Avaux à Champcueil.</p>
                <div class="social-links">
                    <a href="https://www.facebook.com/lachaumiere91" target="_blank" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/lachaume18/" target="_blank" rel="noopener noreferrer" class="instagram-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Navigation</h4>
                <ul class="footer-nav">
                    <li><a href="{{ route('site.accueil') }}">Accueil</a></li>
                    <li><a href="{{ route('site.presentation') }}">Présentation</a></li>
                    <li><a href="{{ route('site.histoire') }}">Histoire</a></li>
                    <li><a href="{{ route('site.reservations') }}">Réserver</a></li>
                    <li><a href="{{ route('site.infos') }}">Infos</a></li>
                    <li><a href="{{ route('site.concerts') }}">Concerts</a></li>
                    <li><a href="{{ route('site.privatisation') }}">Privatisation</a></li>
                </ul>
            </div>
                <div class="footer-section">
                    <h4>Contact</h4>
                    <p>Forêt des Grands Avaux<br>91750 Champcueil</p>
                    <p>Tél : 01.64.98.04.71</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 La Chaumière du Télégraphe. Tous droits réservés. | <a href="{{ route('login') }}" style="opacity: 0.5;">Admin</a></p>
            </div>
        </div>
    </div>
</footer>