<!-- Admin Header -->
<header class="header admin-header">
    <div class="container">
        <a href="/admin" class="logo">Admin - La Chaumière</a>
        <nav class="nav">
            <a href="{{ route('admin.tables') }}" class="{{ $page == 'tables' ? 'active' : '' }}">Tables</a>
            <a href="{{ route('admin.quotas') }}" class="{{ $page == 'quotas' ? 'active' : '' }}">Quotas</a>
            <a href="{{ route('admin.reservations') }}" class="{{ $page == 'reservations' ? 'active' : '' }}">Réservations</a>
            
            <a href="/" target="_blank">Voir le site</a>
        </nav>
    </div>
</header>