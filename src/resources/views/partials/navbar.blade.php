<!-- Navbar -->
<header class="header">
    <div class="container">
        <a href="{{ route('site.accueil') }}" class="logo"><img src="/images/icons/logo.png" alt="La Chaumière du Télégraphe" style="width: 40px; height: 35px;" /> La Chaumière du Télégraphe</a>
        <div class="header-right">
            <nav class="nav">
                <a href="{{ route('site.accueil') }}" class="{{ $page == 'accueil' ? 'active' : '' }}">Accueil</a>
                <a href="{{ route('site.presentation') }}" class="{{ $page == 'presentation' ? 'active' : '' }}">Présentation</a>
                <a href="{{ route('site.infos') }}" class="{{ $page == 'infos' ? 'active' : '' }}">Infos</a>
                <a href="{{ route('site.concerts') }}" class="{{ $page == 'concerts' ? 'active' : '' }}">Concerts</a>
                <a href="{{ route('site.histoire') }}" class="{{ $page == 'histoire' ? 'active' : '' }}">Histoire</a>
                <a href="{{ route('site.privatisation') }}" class="{{ $page == 'privatisation' ? 'active' : '' }}">Privatisation</a>
            </nav>
            <a href="{{ route('site.reservations') }}" class="header-btn-reserve">Réserver</a>
            <a href="tel:0164980471" class="header-phone">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                 </svg>
                 01 64 98 04 71
            </a>
        </div>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>