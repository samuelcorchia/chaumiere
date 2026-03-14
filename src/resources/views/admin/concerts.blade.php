@extends('layouts.back_main')

@section('content')
    <div class="container" style="margin-top: 5em;">            
        <div class="admin-actions">
            <button class="btn btn-phone" onclick="addConcert()">
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
                    <td data-order="{{ \Carbon\Carbon::parse($concert->date_event)->format('Ymd') }}"><div class="text-sm">{{ \Carbon\Carbon::parse($concert->date_event)->format('d/m/Y') }}</div></td>
                    <td><div class="text-sm">{{ \Carbon\Carbon::parse($concert->date_event)->format('H:i') }}</div></td>
                    <td><div class="text-sm">{{ $concert->name_event }}</div></td>
                    <td><div class="text-sm">{{ $concert->type_event }}</div></td>
                    <td><div class="text-sm"><a href="{{ $concert->link_event }}" target="_blank"><img src="{{ asset('/images/icons/youtube.png') }}" alt="Lien youtube" title="Lien youtube" /></a></div></td>
                    <td><div class="text-sm"><span class="status-badge {{ $concert->active ? 'confirmed' : 'pending' }}">{{ $concert->active ? 'Confirmé' : 'En attente' }}</span></div></td>
                    <td>
                        <div class="text-sm">
                            <button class="action-btn view" onclick="editConcert({{ $concert->id }})">Voir/Editer</button>
                            @if($concert->active)
                                <button class="action-btn cancel" onclick="updateStatusConcert({{ $concert->id }}, `{{ $concert->name_event }}`, 'cancel')">Annuler</button>
                            @else
                                <button class="action-btn confirm" onclick="updateStatusConcert({{ $concert->id }}, `{{ $concert->name_event }}`, 'confirm')">Confirmer</button>
                            @endif
                        </div>
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

    <!-- Modal Concert -->
    <div class="modal-overlay" id="concert-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title"></h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
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
                    <input type="hidden" id="eventId" name="eventId" /> 
                    <button type="submit" class="btn btn-phone" style="flex: 1;">
                        <span id="button-text"></span>
                    </button>
                    <button type="button" class="btn btn-outline" onclick="closeModal()">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
<script>
    // Récupérer tout les concerts
    let concerts = @json($concerts); 
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
    
    //-----------------------------------------------------------------
    // Ajouter ou editer un concert
    //-----------------------------------------------------------------
    $("#concertForm").on("submit", function() {
        const formData = {
            name_event: $('#eventName').val(),
            type_event: $('#eventType').val(),
            date_event: $('#eventDate').val(),
            link_event: $('#eventLink').val(),
            id_event:   $('#eventId').val()
        };
        let themethod = $('#eventId').val() > 0 ? "PATCH" : "POST";
        let url = $('#eventId').val() > 0 ? "{{ route('admin.concerts.update') }}" : "{{ route('admin.concerts.store') }}";
        fetch(url, {
            method: themethod,
            headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                window.location.reload();
                closeModal();
            } else {
                alert("❌ Erreur : " + (data.message || "Inconnue"));
            }
        })
        .catch(err => alert("❌ Erreur de connexion au serveur"));
    });

    // Format date us format 
    function formatDate2(d) {
        const date  = new Date(d);
        const day   = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // +1 car janvier = 0
        const year  = date.getFullYear();
        
        return [year, month, day].join('-');return newDate;
    }
    
    //-----------------------------------------------------------------
    // Modal ajouter un concert
    //-----------------------------------------------------------------
    function addConcert() {
        $('#concert-modal').css('display', "flex");
        $("#modal-title").text('Ajouter un concert');
        $('#eventName').focus();
        $("#concertForm")[0].reset();
        $("#button-text").text('Ajouter');
    }

    //-----------------------------------------------------------------
    // Modal editer un concert
    //-----------------------------------------------------------------
    function editConcert(id) { 
        $('#concert-modal').css('display', "flex");
        const event = concerts.find(res => res.id === id);
        if (!event) return;
        $("#modal-title").text('Modifier concert');
        $("#eventName").val(event.name_event);
        $("#eventType").val(event.type_event);
        $("#eventDate").val(formatDate2(event.date_event));
        $("#eventLink").val(event.link_event);
        $("#eventId").val(event.id);
        $("#button-text").text('Modifier');
    }

    //-----------------------------------------------------------------
    // Fermer la modal
    //-----------------------------------------------------------------
    function closeModal() { 
        $('#concert-modal').css("display", "none"); 
    }
    
    //-----------------------------------------------------------------
    // Confirmation ou annulation d'un concert
    //-----------------------------------------------------------------
    function updateStatusConcert(event_id, event_name, new_status) {
        let confirm_message = new_status === 'confirm' ? 'Confirmer' : 'Annuler';
        if (!confirm(confirm_message + ` ce concert [${event_name}] ?`)) return;
        fetch("{{ route('admin.concerts.updateStatus') }}", {
            method: 'PATCH',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({ id: event_id, action: new_status })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.reload();
            } else {
                console.error("Erreurs de validation :", data.errors);
                alert("Erreur : " + JSON.stringify(data.errors));
            }
        })
        .catch(error => console.error("Erreur fatale :", error));
    }
</script>
@endsection