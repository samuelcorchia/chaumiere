@extends('layouts.back_main')

@section('content')
    <div class="tables-panel" id="tablesPanel" style="margin-top: 5em; display: block;">
        <h3>🪑 Configuration des Tables</h3>
        <p style="color: var(--color-text-light);">Définissez vos tables avec leur capacité. Vous pourrez ensuite associer plusieurs tables à une même réservation.</p>    
        <div class="add-table-form">
            <input type="text" id="newTableNumber" placeholder="N° Table (ex: T1)" style="width: 120px;">
            <input type="number" id="newTableCapacity" placeholder="Places" min="1" max="20" style="width: 100px;">
            <button class="btn" onclick="addTable()">+ Ajouter table</button>
        </div>
        <div class="tables-grid" id="tablesGrid">
            @foreach($aTablesList as $oTable)    
                <div id="table-{{ $oTable->id }}" class="table-item" onclick="desactiveTable({{ $oTable->id }}, '{{ $oTable->name }}')">
                    <div class="table-number">{{ $oTable->name }}</div>
                    <div class="table-capacity">{{ $oTable->capacity }} places</div>
                </div>
            @endforeach  
        </div>
                
        <div style="margin-top: 20px; padding: 15px; background: var(--color-cream); border-radius: 10px;">
            <strong>Tables:</strong> <span id="totalTables">{{ $nb }}</span> - <strong>Capacité totale :</strong> <span id="totalCapacity">{{ $sum }}</span> places
        </div>
    </div>
    <script>
        // ADD TABLE
        function addTable() {
            let tableName = document.getElementById('newTableNumber').value;
            let tableCapacity = document.getElementById('newTableCapacity').value;
            
            if (!tableName || !tableCapacity) {
                alert('Veuillez remplir le numéro et la capacité de la table.');
                return;
            }
            
            fetch("{{ route('admin.tables.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ name: tableName, capacity: tableCapacity })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    location.reload();            
                }
            });
        }

        // DESACTIVATE TABLE
        function desactiveTable(id, name) {
            if(!confirm(`Confirmer la descativation de la table ${name} ?`)) return;

            fetch(`/admin/tables/desactive/${id}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload(); // On rafraîchit pour voir la table disparaître
                }
            });
        }
    </script>
@endsection