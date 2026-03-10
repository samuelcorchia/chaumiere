@extends('layouts.back_main')

@section('content')
    <div class="container" style="margin-top: 5em;">            
        <div class="admin-actions">
            <button class="btn btn-phone" onclick="openNewReservationModal()">
                📞 Ajouter réservation
            </button>
        </div>

        <!-- Quota en temps réel -->
        <div class="quota-info" id="quotaInfo">
            <div class="quota-text">
                <span id="quotaDate">📅 <input type="date" id="filterDate" placeholder="Filtrer par date" value="{{ $dateGet ?? \Carbon\Carbon::now()->format('Y-m-d') }}" /></span>
            </div>
            <div class="quota-numbers">
                <div class="quota-number">
                    <div class="value" id="onlineAvailable">{{ $oQuota->nb }}</div>
                    <div class="label">Dispo en ligne</div>
                </div>
                <div class="quota-number">
                    <div class="value" id="onlineUsed">{{ $stats['web'] }}</div>
                    <div class="label">En ligne</div>
                </div>
                <div class="quota-number">
                    <div class="value" id="phoneUsed">{{ $stats['phone'] }}</div>
                    <div class="label">Téléphone</div>
                </div>
                <div class="quota-number">
                    <div class="value" id="totalUsed">{{ $stats['total'] }}</div>
                    <div class="label">Total</div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <!--
        <div class="admin-stats" id="statsContainer">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Réservations</div>
            </div>
            <div class="stat-card confirmed">
                <div class="stat-icon">✅</div>
                <div class="stat-number" id="confirmedCount">{{ $stats['confirmed'] }}</div>
                <div class="stat-label">Confirmées</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-icon">⏳</div>
                <div class="stat-number" id="pendingCount">{{ $stats['pending'] }}</div>
                <div class="stat-label">En attente</div>
            </div>
        </div>
        -->

        <!-- Reservations Table -->
        <div class="admin-table-container">
            <div class="admin-table-header">
                <h2 style="font-size: 2em;">➀ Réservations confirmées</h2>
            </div>
            <table class="admin-table" style="display: table;">
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
                    <td>
                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('d/m/Y') }}</div>
                    </td>
                    <td>
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('H:i') }}</div>
                    </td>
                    <td>
                        <div class="text-sm font-medium text-gray-900">{{ $reservation->nom }}</div>
                    </td>
                    <td>
                        {{ $reservation->guest_count }}
                    </td>
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
                    <td>
                        <div class="text-sm text-gray-500">{{ $reservation->phone ?? '-' }}</div>
                    </td>
                    <td>
                        <span class="source-badge {{ $reservation->source ?? 'online' }}">
                            {{ $reservation->source == 'phone' ? '📞 Tél.' : '🌐 Web' }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge {{ $reservation->status }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="action-btn cancel" onclick="cancelReservation({{ $reservation->id }})">Annuler</button>
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

        <div class="admin-table-container" style="margin-top: 2em;">
            <div class="admin-table-header">
                <h2 style="font-size: 2em;">➁ Réservations à valider</h2>
            </div>

            <table class="admin-table" style="display: table;">
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
                    <td>
                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('d M Y') }}</div>
                    </td>
                    <td>
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($reservation->reserved_at)->format('H:i') }}</div>
                    </td>
                    <td>
                        <div class="text-sm font-medium text-gray-900">{{ $reservation->nom }}</div>
                    </td>
                    <td>
                        {{ $reservation->guest_count }} personnes
                    </td>
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
                    <td>
                        <div class="text-sm text-gray-500">{{ $reservation->phone ?? '-' }}</div>
                    </td>
                    <td>
                        <span class="source-badge {{ $reservation->source ?? 'online' }}">
                            {{ $reservation->source == 'phone' ? '📞 Tél.' : '🌐 Web' }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge {{ $reservation->status }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="action-btn confirm" onclick="confirmReservation({{ $reservation->id }})">Confirmer</button>
                        <button class="action-btn cancel" onclick="cancelReservation({{ $reservation->id }})">Annuler</button>
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

    <!-- Modal Nouvelle Réservation Téléphone -->
    <div class="modal-overlay" id="newReservationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>📞 Nouvelle réservation téléphonique</h3>
                <button class="modal-close" onclick="closeNewReservationModal()">&times;</button>
            </div>
            
            <form id="phoneReservationForm">
                <div class="form-group">
                    <label for="phoneNom">Nom de la réservation *</label>
                    <input type="text" id="phoneNom" name="nom" required placeholder="Ex: Dupont, Famille Martin...">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phoneDate">Date *</label>
                        <input type="date" id="phoneDate" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneHeure">Heure d'arrivée *</label>
                        <select id="phoneHeure" name="heure" required>
                            <option value="">Choisir</option>
                            <optgroup label="Déjeuner">
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
                    <label for="phonePersonnes">Nombre de personnes *</label>
                    <select id="phonePersonnes" name="personnes" required onchange="updateTablesSelection()">
                        <option value="">Sélectionnez</option>
                        <option value="1">1 personne</option>
                        <option value="2">2 personnes</option>
                        <option value="3">3 personnes</option>
                        <option value="4">4 personnes</option>
                        <option value="5">5 personnes</option>
                        <option value="6">6 personnes</option>
                        <option value="7">7 personnes</option>
                        <option value="8">8 personnes</option>
                        <option value="9">9 personnes</option>
                        <option value="10">10 personnes</option>
                        <option value="11">11 personnes</option>
                        <option value="12">12+ personnes</option>
                    </select>
                </div>

                <!-- Sélection des tables -->
                <div class="tables-selection" id="tablesSelectionContainer">
                    <h4>🪑 Attribution des tables <small style="font-weight: normal; color: var(--color-text-light);">(optionnel)</small></h4>
                    <p style="font-size: 0.9rem; color: var(--color-text-light); margin-bottom: 15px;">
                        Sélectionnez une ou plusieurs tables pour cette réservation. Vous pouvez associer plusieurs tables si nécessaire.
                    </p>
                    <div class="tables-mini-grid" id="tablesSelectionGrid">
                        <!-- Tables à sélectionner -->
                    </div>
                    <div class="selected-tables-summary" id="selectedTablesSummary" style="display: none;">
                        Tables sélectionnées : <strong id="selectedTablesText"></strong> — Capacité totale : <strong id="selectedCapacity"></strong> places
                    </div>
                </div>

                <div class="form-row" style="margin-top: 20px;">
                    <div class="form-group">
                        <label for="phoneTel">Téléphone <small>(optionnel)</small></label>
                        <input type="tel" id="phoneTel" name="telephone" placeholder="06 00 00 00 00">
                    </div>
                    <div class="form-group">
                        <label for="phoneEmplacement">Emplacement</label>
                        <select id="phoneEmplacement" name="emplacement">
                            <option value="indifferent">Indifférent</option>
                            <option value="terrasse">🌲 Terrasse</option>
                            <option value="interieur">🏠 Intérieur</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phoneRemarques">Remarques <small>(notes internes)</small></label>
                    <textarea id="phoneRemarques" name="remarques" placeholder="Notes internes, demandes spéciales..."></textarea>
                </div>

                <div style="margin-top: 25px; display: flex; gap: 15px;">
                    <button type="submit" class="btn btn-phone" style="flex: 1;">
                        ✓ Créer la réservation
                    </button>
                    <button type="button" class="btn btn-outline" onclick="closeNewReservationModal()">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Détails Réservation -->
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

<script>
    // 1. Initialisation des données depuis Laravel
    let reservations = @json($reservations['all']); 
    let tables = [
        @foreach($allTables as $table)
            { id: {{ $table->id }}, number: '{{ $table->name }}', capacity: {{ $table->capacity }} },
        @endforeach
    ];
    let selectedTables = [];
    //const csrfToken = '{{ csrf_token() }}';

    // 2. Au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        //renderReservations();
        // On initialise la date du jour par défaut dans le modal
        const dateInput = document.getElementById('phoneDate');
        if(dateInput) dateInput.min = new Date().toISOString().split('T')[0];
    });

    // --- GESTION DES TABLES ---

    function toggleTableSelection(tableNumber) {
        const index = selectedTables.indexOf(tableNumber);
        if (index > -1) {
            selectedTables.splice(index, 1);
        } else {
            selectedTables.push(tableNumber);
        }
        renderTablesSelection();
    }

    function updateSelectedTablesSummary() {
        const summaryDiv = document.getElementById('selectedTablesSummary');
        const textSpan = document.getElementById('selectedTablesText');
        const capacitySpan = document.getElementById('selectedCapacity');

        if (selectedTables.length > 0) {
            summaryDiv.style.display = 'block';
            textSpan.textContent = selectedTables.join(', ');
            let totalCap = 0;
            selectedTables.forEach(num => {
                const table = tables.find(t => t.number === num);
                if (table) totalCap += parseInt(table.capacity);
            });
            capacitySpan.textContent = totalCap;
        } else {
            summaryDiv.style.display = 'none';
        }
    }

    function renderTablesSelection() {
        const grid = document.getElementById('tablesSelectionGrid');
        const date = document.getElementById('phoneDate').value;
        const heure = document.getElementById('phoneHeure').value;
        
        if (tables.length === 0) {
            grid.innerHTML = '<p>Aucune table active.</p>';
            return;
        }
        
        // Optionnel : filtrer les tables déjà prises dans l'objet 'reservations' local
        const occupiedTables = [];
        if (date && heure) {
            reservations.filter(r => r.date === date && r.heure === heure && r.status !== 'cancelled')
                        .forEach(r => {
                            if(r.tables_id) occupiedTables.push(...r.tables_id.split(','));
                        });
        }
        
        grid.innerHTML = tables.map(t => {
            const isOccupied = occupiedTables.includes(t.number);
            const isSelected = selectedTables.includes(t.number);
            let className = 'table-mini ' + (isOccupied ? 'occupied' : (isSelected ? 'selected' : 'available'));
            
            return `
                <div class="${className}" onclick="${isOccupied ? '' : `toggleTableSelection('${t.number}')`}">
                    <strong>${t.number}</strong><br><small>${t.capacity}p</small>
                </div>`;
        }).join('');
        
        updateSelectedTablesSummary();
    }

    // --- RECHARGE RESULTATS PAR DATE ---
    document.getElementById('filterDate').addEventListener('change', function(e) {
        window.location = "{{ route('admin.reservations') }}/"+document.getElementById('filterDate').value;
    });

    // --- GESTION DU FORMULAIRE (ENVOI LARAVEL) ---
    document.getElementById('phoneReservationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('phoneNom').value,
            date: document.getElementById('phoneDate').value,
            heure: document.getElementById('phoneHeure').value,
            nb: document.getElementById('phonePersonnes').value,
            tel: document.getElementById('phoneTel').value,
            emp: document.getElementById('phoneEmplacement').value,
            rq: document.getElementById('phoneRemarques').value,
            tables: selectedTables 
        };

        fetch("{{ route('admin.resas.storePhone') }}", {
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
                alert("✅ Réservation enregistrée en base !");
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
    function openNewReservationModal() { 
        document.getElementById('phoneReservationForm').reset();
        selectedTables = [];
        renderTablesSelection();
        document.getElementById('newReservationModal').style.display = 'flex'; 
    }

    // Fermer la modal de création d'une reservation manuelle
    function closeNewReservationModal() { document.getElementById('newReservationModal').style.display = 'none'; }
    
    // Fermer la modal de visualisation d'une reseravtion
    function closeModal() { document.getElementById('reservationModal').style.display = 'none'; }

    // Confirmation d'une reservation en attente
    function confirmReservation(id) {
        if (!confirm('Confirmer cette réservation ?')) return;
        fetch(`/admin/reservation/confirm/${id}`, {
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
    function cancelReservation(id) {
        if(!confirm(`Annuler cette reservation ?`)) return;

        fetch(`/admin/reservation/cancel/${id}`, {
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

    // Formatage pour l'affichage de l'emplacement (terasse ou interieur)
    function formatEmplacement(emp) {
        const labels = { 'indifferent': 'Indifférent', 'terrasse': '🌲 Terrasse', 'interieur': '🏠 Intérieur' };
        return labels[emp] || emp;
    }

    // Cette fonction est appelée par le onchange du select "Nombre de personnes"
    function updateTablesSelection() {
        // On appelle la fonction qui dessine la grille des tables
        if (typeof renderTablesSelection === "function") {
            renderTablesSelection();
        } else {
            console.error("La fonction renderTablesSelection n'est pas encore définie.");
        }
    }
</script>
@endsection