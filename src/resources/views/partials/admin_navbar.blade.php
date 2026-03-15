<!-- Admin Header -->
<header class="header admin-header">
    <div class="container">
        <a href="/admin" class="logo">Admin - La Chaumière</a>
        <nav class="nav">
            <a href="{{ route('admin.tables.index') }}" class="{{ $page == 'tables' ? 'active' : '' }}">Tables</a>
            <a href="{{ route('admin.quotas.index') }}" class="{{ $page == 'quotas' ? 'active' : '' }}">Quotas</a>
            <a href="{{ route('admin.reservations.index') }}" class="{{ $page == 'reservations' ? 'active' : '' }}">Réservations</a>
            <a href="{{ route('admin.concerts.index') }}" class="{{ $page == 'concerts' ? 'active' : '' }}">Concerts</a>            
            <a href="/" target="_blank">Voir le site</a>
            <span style="float: right; margin-left: 2em; width: 2em; filter: grayscale(1) invert(1);"><a href="javascript:void" onclick="document.getElementById('logout-form').submit();"><img src="/images/icons/power.png" alt="Deconnexion" /></a></span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>
</header>