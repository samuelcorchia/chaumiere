@extends('layouts.back_main')

@section('content')
    <div class="container" style="margin-top: 5em;">            
        <div class="admin-actions">
            <button class="btn btn-phone" onclick="addReservation()">Nouvelle réservation</button>
        </div>
        <!-- Quota en temps réel -->
        <div class="quota-info" id="quotaInfo">
            <div class="quota-text">
                <span id="quotaDate">📅 <input type="date" id="filterDate" placeholder="Filtrer par date" value="{{ $dateGet ?? \Carbon\Carbon::now()->format('Y-m-d') }}" /></span>
            </div>
            <div class="quota-numbers">
                <div class="quota-number">
                    <div class="value" id="onlineAvailable" style="font-size:1rem;">{{ $oQuota->nb - $stats['web'] }}/{{ $oQuota->nb }}</div>
                    <div class="label">Dispo en ligne</div>
                </div>
                <div class="quota-number">
                    <div class="value" id="onlineUsed">{{ $stats['web'] }}</div>
                    <div class="label">web</div>
                </div>
                <div class="quota-number">
                    <div class="value" id="phoneUsed">{{ $stats['phone'] }}</div>
                    <div class="label">Téléphone</div>
                </div>
                <div class="quota-number" style="border: 1px solid #FFF; border-radius: 10px; background-color: lightgreen; color: #000; padding-left: 3em; padding-right: 3em;">
                    <div class="value" id="totalUsed">{{ $stats['total'] }}</div>
                    <div class="label">Total</div>
                </div>
            </div>
        </div>
        <!-- Reservations confirmées -->
        <div class="admin-table-container">
            <div class="admin-table-header"><h2 style="font-size: 2em;">➀ Réservations confirmées</h2></div>
            <table id="reservationsTableConfirmed" class="admin-table" style="display: table;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Nom</th>
                    <th>Pers.</th>
                    <th>Tables</th>
                    <th>Contact</th>
                    <th>Source</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reservationsBody" class="bg-white divide-y divide-gray-200">
            @foreach($reservations['confirmed'] as $reservation)
                <tr>
                    <td data-order="{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('Ymd') }}">{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('H:i') }}</td>
                    <td>{{ $reservation->nom }}</td>
                    <td>{{ $reservation->guest_count }}</td>
                    <td>
                        <div class="assigned-tables">
                            @if(!empty($reservation->tables_id))
                                @foreach(explode(',', $reservation->tables_id) as $tableNum)
                                    <span class="table-tag" stykle="float: left; margin-left: 2px;">{{ trim($tableNum) }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-400 text-sm italic">Aucune table</span>
                            @endif
                        </div>
                    </td>
                    <td>{{ $reservation->phone ?? '-' }}</td>
                    <td><span class="source-badge {{ $reservation->source ?? 'online' }}">{{ $reservation->source == 'phone' ? '📞 Tél.' : '🌐 Web' }}</span></td>
                    <td><span class="status-badge {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span></td>
                    <td>
                        <button class="action-btn cancel" onclick="updateStatusReservation({{ $reservation->id }}, `{{ $reservation->nom }}`, 'cancel')">Annuler</button>
                        <button class="action-btn view" onclick="editReservation({{ $reservation->id }})">Voir/Editer</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
            <div id="emptyState" style="display: none; text-align: center; padding: 60px 20px;">
                <div style="font-size: 4rem; margin-bottom: 20px;">📝</div>
                <h3>Aucune réservation</h3>
            </div>
        </div>
        <!-- Reservations en attente -->
        <div class="admin-table-container" style="margin-top: 2em;">
            <div class="admin-table-header"><h2 style="font-size: 2em;">➁ Réservations en attente</h2></div>
            <table id="reservationsTablePending" class="admin-table" style="display: table;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Nom</th>
                    <th>Pers.</th>
                    <th>Tables</th>
                    <th>Contact</th>
                    <th>Source</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reservationsBody">
            @foreach($reservations['pending'] as $reservation)
                <tr>
                    <td data-order="{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('Ymd') }}">{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('H:i') }}</td>
                    <td>{{ $reservation->nom }}</td>
                    <td>{{ $reservation->guest_count }}</td>
                    <td>
                        <div class="assigned-tables">
                            @if(!empty($reservation->tables_id))
                                @foreach(explode(',', $reservation->tables_id) as $tableNum)
                                    <span class="table-tag" stykle="float: left; margin-left: 2px;">{{ trim($tableNum) }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-400 text-sm italic">Aucune table</span>
                            @endif
                        </div>
                    </td>
                    <td>{{ $reservation->phone ?? '-' }}</td>
                    <td><span class="source-badge {{ $reservation->source ?? 'online' }}">{{ $reservation->source == 'phone' ? '📞 Tél.' : '🌐 Web' }}</span></td>
                    <td><span class="status-badge {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span></td>
                    <td>
                        <button class="action-btn confirm" onclick="updateStatusReservation({{ $reservation->id }}, `{{ $reservation->nom }}`, 'confirm')">Confirmer</button>
                        <button class="action-btn cancel" onclick="updateStatusReservation({{ $reservation->id }}, `{{ $reservation->nom }}`, 'cancel')">Annuler</button>
                        <button class="action-btn view" onclick="viewReservation({{ $reservation->id }})">Voir</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
            <div id="emptyState" style="display: none; text-align: center; padding: 60px 20px;">
                <div style="font-size: 4rem; margin-bottom: 20px;">📝</div>
                <h3>Aucune réservation</h3>
            </div>
        </div>
    </div>
    <!-- Modal Réservation (Ajouter ou modifier) -->
    <div class="modal-overlay" id="reservationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title"></h3>
                <button class="modal-close" onclick="closeReservationModal()">&times;</button>
            </div>
            <form id="reservationForm">
                <div class="form-group">
                    <label for="reservationNom">Nom de la réservation *</label>
                    <input type="text" id="reservationNom" name="nom" required placeholder="Ex: Dupont, Famille Martin...">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="reservationDate">Date *</label>
                        <input type="date" id="reservationDate" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="reservationHeure">Heure d'arrivée *</label>
                        <select id="reservationHeure" name="heure" required>
                            <option value="">Choisir</option>
                            <optgroup label="Déjeuner">
                                <option value="12:00">12h00</option>
                                <option value="12:30">12h30</option>
                                <option value="13:00">13h00</option>
                                <option value="13:30">13h30</option>
                            </optgroup>
                            <optgroup label="Dîner">
                                <option value="19:00">19h00</option>
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
                    <select id="reservationPersonnes" name="personnes" required>
                        <option value="">Sélectionnez</option>
                        @for ($i = 1; $i < 12; $i++)
                            <option value="{{ $i }}">{{ $i }} @choice('presonne|personnes', $i)</option>
                        @endfor
                        <option value="12">12+ personnes</option>
                    </select>
                </div>
                <div class="form-row" style="margin-top: 20px;">
                    <div class="form-group">
                        <label for="reservationTel">Téléphone <small>(optionnel)</small></label>
                        <input type="tel" id="reservationTel" name="telephone" placeholder="06 00 00 00 00">
                    </div>
                    <div class="form-group">
                        <label for="reservationEmplacement">Emplacement</label>
                        <select id="reservationEmplacement" name="emplacement">
                            <option value="indifferent">Indifférent</option>
                            <option value="terrasse">🌲 Terrasse</option>
                            <option value="interieur">🏠 Intérieur</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reservationRemarques">Remarques <small>(notes internes)</small></label>
                    <textarea id="reservationRemarques" name="remarques" placeholder="Notes internes, demandes spéciales..."></textarea>
                </div>
                <input type="hidden" id="reservationId" name="reservationId" />
                <input type="hidden" id="reservationSource" name="reservationSource" /> 
                <div style="margin-top: 25px; display: flex; gap: 15px;">
                    <button type="submit" class="btn btn-phone" style="flex: 1;">
                        <span id="button-text"></span>
                    </button>
                    <button type="button" class="btn btn-outline" onclick="closeReservationModal()">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
<script>
    // Récupérer toutes les reservations confirmées et en attentes
    let reservations = @json($reservations['all']);
    $(document).ready(function() {
        // Initialiser date recherche des reservations
        const dateInput = document.getElementById('reservationDate');
        if(dateInput) dateInput.min = new Date().toISOString().split('T')[0];
        // DataTable sur les reservation confirmées et en attente
        $('#reservationsTableConfirmed, #reservationsTablePending').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "info": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
            }
        });
    });

    //-------------------------------------------------------------------------
    // Recherche reservations par date (Uniquement les reservations confirmées)
    //-------------------------------------------------------------------------
    $('#filterDate').on('change', function(e) {
        window.location = "{{ route('admin.reservations') }}/"+$('#filterDate').val();
    });

    //-----------------------------------------------------------------
    // Modal ajouter une reservation
    //-----------------------------------------------------------------
    function addReservation() {
        $('#reservationModal').css("display", "flex");
        $("#modal-title").text('Ajouter réservation');
        $('#reservationNom').focus();
        $('#reservationForm')[0].reset();
        $("#button-text").text('Ajouter');
        $('#reservationId').val('');
        $('#reservationSource').val('phone');
    }

    //-----------------------------------------------------------------
    // Modal editer une reservation
    //-----------------------------------------------------------------
    function editReservation(id) { 
        $('#reservationModal').css('display', "flex");
        const resa = reservations.find(res => res.id === id);
        if (!resa) return;
        $("#modal-title").text('Modifier réservation');
        $('#reservationNom').val(resa.nom);
        $('#reservationDate').val(formatDate2(resa.dateresa));
        $('#reservationHeure').val(resa.heure);
        $('#reservationPersonnes').val(resa.guest_count);
        $('#reservationTel').val(resa.phone);
        $('#reservationRemarques').val(resa.remarque);
        $('#reservationSource').val(resa.source);
        $('#reservationId').val(resa.id);
        $("#button-text").text('Modifier');
    }
    
    //-----------------------------------------------------------------
    // Fermer la modal
    //-----------------------------------------------------------------
    function closeReservationModal() { document.getElementById('reservationModal').style.display = 'none'; }

    //-----------------------------------------------------------------
    // Ajouter ou editer une reservation
    //-----------------------------------------------------------------
    $('#reservationForm').on('submit', function(e) {
        const formData = {
            name:   $('#reservationNom').val(),
            date:   $('#reservationDate').val(),
            heure:  $('#reservationHeure').val(),
            nb:     $('#reservationPersonnes').val(),
            tel:    $('#reservationTel').val(),
            emp:    $('#reservationEmplacement').val(),
            rq:     $('#reservationRemarques').val(),
            source: $('#reservationSource').val(),
            id:     $('#reservationId').val()
        };
        let themethod = $('#reservationId').val() > 0 ? "PATCH" : "POST";
        let url = themethod == "PATCH" ? "{{ route('admin.reservations.update') }}" : "{{ route('admin.reservations.store') }}";
        fetch(url, {
            method: themethod,
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
            } else {
                console.error("Erreurs de validation :", data.errors);
                alert("Erreur : " + JSON.stringify(data.errors));$
            }
        })
        .catch(error => console.error("Erreur fatale :", error));
    });

    //-----------------------------------------------------------------
    // Confirmation ou annulation d'une reservation
    //-----------------------------------------------------------------
    function updateStatusReservation(id_customer, name_customer, new_status) {
        let confirm_message = new_status === 'confirm' ? 'Confirmer' : 'Annuler';
        if (!confirm(confirm_message + ` cette réservation [${name_customer}] ?`)) return;
        fetch("{{ route('admin.reservations.updateStatus') }}", {
            method: 'PATCH',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({ id: id_customer, action: new_status })
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

    //-----------------------------------------
    // Format date us format 
    //-----------------------------------------
    function formatDate2(d) {
        const date  = new Date(d);
        const day   = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // +1 car janvier = 0
        const year  = date.getFullYear();
        return [year, month, day].join('-');return newDate;
    }
</script>
@endsection