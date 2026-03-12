@extends('layouts.back_main')

@section('content')
    <div class="container" style="margin-top: 5em;">            
        <div class="admin-actions">
            <button class="btn btn-phone" onclick="openNewConcertModal(0)">
                Ajouter concert
            </button>
        </div>
        
        <!-- Filtre par mois (Todo)-->
        <!-- <div class="quota-text">
            <span id="quotaDate">📅 <input type="date" id="filterDate" placeholder="Filtrer par date" value="{{ $dateGet ?? \Carbon\Carbon::now()->format('Y-m-d') }}" /></span>
        </div>-->
        
        <!-- Concerts Table -->
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
                    <th>Type</th>
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
                    <td><div class="text-sm font-medium text-gray-900">{{ $concert->type_event }}</div></td>
                    <td>{{ $concert->link_event }}</td>
                    <td><span class="status-badge {{ $concert->active ? 'confirmed' : 'pending' }}">{{ $concert->active ? 'Confirmé' : 'En attente' }}</span></td>
                    <td>
                        @if(!$concert->active)
                            <button class="action-btn confirm" onclick="confirmConcert({{ $concert->id }})">Confirmer</button>
                        @endif
                        <button class="action-btn cancel" onclick="cancelConcert({{ $concert->id }})">Annuler</button>
                        <button class="action-btn view" onclick="viewConcert({{ $concert->id }})">Voir/Editer</button>
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
                <div class="form-group">
                    <label for="eventName">Nom du groupe *</label>
                    <input type="text" id="eventName" name="eventName" required placeholder="Spams...">
                </div>
                <div class="form-group">
                    <label for="eventType">Type de musique *</label>
                    <input type="text" id="eventType" name="eventType" required placeholder="Rock...">
                </div>
                <div class="form-group">
                    <label for="eventDate">Date *</label>
                    <input type="date" id="eventDate" name="eventDate" required value="">
                </div>
                <div class="form-group">
                    <label for="eventLink">Lien</label>
                    <input type="text" id="eventLink" name="eventLink">
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
    // Initialisation des données depuis Laravel
    let concerts = @json($concerts); 
    // DataTables
    $(document).ready(function() {
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
    /*document.getElementById('filterDate').addEventListener('change', function(e) {
        window.location = "{{ route('admin.concerts') }}/"+document.getElementById('filterDate').value;
    });*/

    // --- GESTION DU FORMULAIRE (ENVOI LARAVEL) ---
    document.getElementById('concertForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            name_event: document.getElementById('eventName').value,
            type_event: document.getElementById('eventType').value,
            date_event: document.getElementById('eventDate').value,
            link_event: document.getElementById('eventLink').value 
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
    function formatDate2(d) {
        const date  = new Date(d);
        const day   = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // +1 car janvier = 0
        const year  = date.getFullYear();
        
        return [year, month, day].join('-');return newDate;
    }
    
    // Modal ajout/update nouveau concert
    function openNewConcertModal(id) { 
        // Add (on vide les champs)
        if (id === 0) { 
            document.getElementById('concertForm').reset(); 
        // Update (on preremplie les champs)
        } else {
            const event = concerts.find(res => res.id === id);
            if (!event) return;
            $("#eventName").val(event.name_event);
            $("#eventType").val(event.type_event);
            $("#eventDate").val(formatDate2(event.date_event));
            $("#eventLink").val(event.link_event);
        }
        document.getElementById('openNewConcertModal').style.display = 'flex'; 
    }

    // Fermer la modal de création d'une reservation manuelle
    function closeNewConcertModal() { document.getElementById('openNewConcertModal').style.display = 'none'; }
    
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


    // Previsualiser et/ou modifier les infos d'un concert 
    function viewConcert(id) {
        openNewConcertModal(id);
    }

</script>
@endsection