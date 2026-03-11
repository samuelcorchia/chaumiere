@extends('layouts.back_main')

@section('content')
    <div class="container" style="margin-top: 5em;">            
        <div class="admin-actions">
            <button class="btn btn-phone" onclick="openNewConcertModal()">
                Ajouter concert
            </button>
        </div>
        
        <!-- Filtre par mois (Todo)-->
        <div class="quota-text">
            <span id="quotaDate">📅 <input type="date" id="filterDate" placeholder="Filtrer par date" value="{{ $dateGet ?? \Carbon\Carbon::now()->format('Y-m-d') }}" /></span>
        </div>
        
        <!-- Reservations Table -->
        <div class="admin-table-container">
            <div class="admin-table-header">
                <h2 style="font-size: 2em;">Liste des concerts</h2>
            </div>
            <table id="concertsTable" class="admin-table" style="display: table;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Nom</th>
                    <th>Lien</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="concertsBody" class="bg-white divide-y divide-gray-200">
            @foreach($concerts as $concert)
                <tr>
                    <td><div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($concert->date_event)->format('d/m/Y') }}</div></td>
                    <td><div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($concert->date_event)->format('H:i') }}</div></td>
                    <td><div class="text-sm font-medium text-gray-900">{{ $concert->name_event }}</div></td>
                    <td>{{ $concert->link_event }}</td>
                    <td><span class="status-badge {{ $concert->status }}">{{ ucfirst($reservation->status) }}</span></td>
                    <td>
                        <button class="action-btn cancel" onclick="confirmConcert({{ $concert->id }})">Annuler</button>
                        <button class="action-btn cancel" onclick="cancelConcert({{ $concert->id }})">Annuler</button>
                        <!-- <button class="action-btn view" onclick="viewReservation({{ $concert->id }})">Voir</button> -->
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>

            <div id="emptyState" style="display: none; text-align: center; padding: 60px 20px;">
                <div style="font-size: 4rem; margin-bottom: 20px;">📝</div>
                <h3>Aucun concert</h3>
            </div>
        </div>
    </div>

    <!-- Modal Nouveau concert -->
    <div class="modal-overlay" id="openNewConcertModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Nouveau concert</h3>
                <button class="modal-close" onclick="closeNewConcertModal()">&times;</button>
            </div>
            
            <form id="concertForm">
                <div class="form-row">
                    <label for="Nom">Nom du groupe *</label>
                    <input type="text" id="concertName" name="nom" required placeholder="Ex: Dupont, Famille Martin...">
                </div>
                <div class="form-row">
                    <label for="Date">Date *</label>
                    <input type="date" id="concertDate" name="date" required>
                </div>
                <div class="form-row">
                    <label for="Link">Lien</label>
                    <input type="text" id="concertLink" name="date" required>
                </div>
                <div style="margin-top: 25px; display: flex; gap: 15px;">
                    <button type="submit" class="btn btn-phone" style="flex: 1;">
                        ✓ Créer le concert
                    </button>
                    <button type="button" class="btn btn-outline" onclick="closeNewConcertModal()">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Détails Réservation -->
    <!--
    <div class="modal-overlay" id="reservationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>📋 Détails de la Réservation</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div id="modalContent"></div>
            <div style="margin-top: 30px;">
                <button class="btn" onclick="closeModal()">Fermer</button>
            </div>
        </div>
    </div>
    -->
<script>
    // 1. Au chargement de la page
    $(document).ready(function() {
        const dateInput = document.getElementById('phoneDate');
        if(dateInput) dateInput.min = new Date().toISOString().split('T')[0];
        $('#concertsTable').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "info": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
            }
        });
    });

    
    // --- RECHARGE RESULTATS PAR DATE ---
    document.getElementById('filterDate').addEventListener('change', function(e) {
        window.location = "{{ route('admin.concerts') }}/"+document.getElementById('filterDate').value;
    });

    // --- GESTION DU FORMULAIRE (ENVOI LARAVEL) ---
    document.getElementById('concertForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('concertName').value,
            date: document.getElementById('concertDate').value,
            link: document.getElementById('concertLink').value, 
        };

        fetch("{{ route('admin.concerts.store') }}", {
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
                alert("✅ Concert enregistré en base !");
                window.location.reload(); 
            } else {
                alert("❌ Erreur : " + (data.message || "Inconnue"));
            }
        })
        .catch(err => alert("❌ Erreur de connexion au serveur"));
    });

    // Helpers
    function formatDate(d) { return new Date(d).toLocaleDateString('fr-FR', {day:'numeric', month:'short'}); }
    function formatStatus(s) { return s === 'confirmed' ? 'Confirmée' : (s === 'pending' ? 'Attente' : 'Annulée'); }
    
    // Modal d'une reservation manuelle
    function openNewConcertModal() { 
        document.getElementById('phoneReservationForm').reset();
        selectedTables = [];
        renderTablesSelection();
        document.getElementById('newReservationModal').style.display = 'flex'; 
    }

    // Fermer la modal de création d'une reservation manuelle
    function closeNewConcertModal() { document.getElementById('newReservationModal').style.display = 'none'; }
    
    // Fermer la modal de visualisation d'une reseravtion
    /* 
    function closeModal() { document.getElementById('reservationModal').style.display = 'none'; }
    */

    // Confirmation d'une reservation en attente
    function confirmConcert(id) {
        if (!confirm('Confirmer ce concert ?')) return;
        fetch(`/admin/concerts/confirm/${id}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.reload(); 
            }
        });
    }

    // Annulation d'une reservation (confirmée ou en attente)
    function cancelConcert(id) {
        if(!confirm(`Annuler ce concert ?`)) return;

        fetch(`/admin/concerts/cancel/${id}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.reload(); 
            }
        });
    }


    // Previsualiser les detaiuls d'une reservation 
    /*
    function viewReservation(id) {
        const r = reservations.find(res => res.id === id);
        if (!r) greturn;
            document.getElementById('modalContent').innerHTML = `
            <div style="display: grid; gap: 15px;">
                <div><strong>Nom :</strong> ${r.nom}</div>
                <div><strong>Date :</strong> ${formatDate(r.dateresa)}</div>
                <div><strong>Heure :</strong> ${r.heure}</div>
                <div><strong>Personnes :</strong> ${r.guest_count}</div>
                <div><strong>Tables :</strong> ${r.tables_id || '—'}</div>
                <div><strong>Téléphone :</strong> ${r.phone || '—'}</div>
                <div><strong>Email :</strong> ${r.mail || '—'}</div>
                <div><strong>Emplacement :</strong> ${formatEmplacement(r.emplacement)}</div>
                <div><strong>Source :</strong> <span class="source-badge ${r.source || 'online'}">${r.source === 'phone' ? '📞 Téléphone' : '🌐 En ligne'}</span></div>
                <div><strong>Statut :</strong> <span class="status-badge ${r.status}">${formatStatus(r.status)}</span></div>
                ${r.remarque ? `<div><strong>Remarques :</strong><br>${r.remarque}</div>` : ''}
                <div><strong>Créée le :</strong> ${new Date(r.created_at).toLocaleString('fr-FR')}</div>
            </div>
        `;
        document.getElementById('reservationModal').style.display = 'flex';
    }
    */
</script>
@endsection