@extends('layouts.back_main')

@section('content')
    <div class="tables-panel" id="tablesPanel" style="margin-top: 5em; display: block;">
        <h3>🪑 Configuration des Tables</h3>
        <p style="color: var(--color-text-light);">Définissez vos tables avec leur capacité. Vous pourrez ensuite associer plusieurs tables à une même réservation.</p>    
        <div class="add-table-form">
            <input type="text" id="tableName" placeholder="N° Table (ex: T1)" style="width: 120px;">
            <input type="number" id="tableCapacity" placeholder="Nb Places" min="1" max="20" style="width: 100px;">
            <button class="btn" onclick="addTable()">+ Ajouter table</button>
        </div>
        <div class="tables-grid" id="tablesGrid">
            @foreach($aTablesList as $oTable)    
                <div id="table-{{ $oTable->id }}" class="table-item" onclick="desactiveTable({{ $oTable->id }}, '{{ $oTable->name }}')">
                    <div id="table-name" class="table-number">{{ $oTable->name }}</div>
                    <div class="table-capacity">{{ $oTable->capacity }} places</div>
                </div>
            @endforeach  
        </div>
                
        <div style="margin-top: 20px; padding: 15px; background: var(--color-cream); border-radius: 10px;">
            <strong>Tables:</strong> <span id="totalTables"></span> - <strong>Capacité totale :</strong> <span id="totalCapacity"></span> places
        </div>
    </div>
    <script>
        $(document).ready(function() {
            getStats();
        });

        // Recuperer nombre de tables
        function getTotalTables() {
            var countTables =  $('.table-item').length;
            $("#totalTables").html(countTables);
        }

        // Recuperer capacité total
        function getTotalCapacity() {
            var sum = 0;
            $('.table-capacity').each(function(){
                sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
            });
            $("#totalCapacity").html(sum);
        }

        function getStats() {
            getTotalTables();
            getTotalCapacity();
        }

        // ADD TABLE
        function addTable() {
            let tableName     = $('#tableName').val();
            let tableCapacity = $('#tableCapacity').val();

            if(!tableName || !tableCapacity) return;
            fetch("{{ route('admin.tables.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                // 2. On envoie les données ICI, dans le corps de la requête
                body: JSON.stringify({
                    name: tableName,
                    capacity: tableCapacity
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    let newBloc = `
                    <div id="table-${data.table.id}" class="table-item" onclick="desactiveTable(${data.table.id}, '${data.table.name}')">
                        <div id="table-name" class="table-number">${data.table.name}</div>
                        <div class="table-capacity">${data.table.capacity} places</div>
                    </div>
                    `;
                    $("#tablesGrid").append(newBloc);
                    getStats();
                    $(':input').val('');
                } else {
                    console.error("Erreurs de validation :", data.errors);
                    alert("Erreur : " + JSON.stringify(data.errors));
                }
            })
            .catch(error => console.error("Erreur fatale :", error));
        }

        // DESACTIVATE TABLE
        function desactiveTable(id, name) {
            if(!confirm(`Confirmer la descativation de la table ${name} ?`)) return;
            let url = "{{ route('admin.tables.desactive', ['id' => 'ID_HERE']) }}";
            url = url.replace('ID_HERE', id);
            fetch(url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    $(`#table-${data.table.id}`).remove();
                    getStats();
                } else {
                    console.error("Erreurs de validation :", data.errors);
                    alert("Erreur : " + JSON.stringify(data.errors));
                }
            })
            .catch(error => console.error("Erreur fatale :", error));
        }
    </script>
@endsection