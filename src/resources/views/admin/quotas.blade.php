@extends('layouts.back_main')

@section('content')
    <div class="settings-panel" id="settingsPanel" style="display: block; margin-top: 5em;">
        <h3>⚙️ Quota de réservations de tables en ligne</h3>
        <p style="color: var(--color-text-light);">Définissez le nombre maximum de tables pouvant être effectuées en ligne par jour. Au-delà de ce quota, les clients devront appeler pour réserver.</p>
        <div style="max-width: 300px; margin-top: 25px;">
            <div class="setting-card">
                <label>🌐 Réservations en ligne max / jour</label>
                <input type="number" id="nbQuota" min="0" max="100" value="{{ $quota->nb }}" style="width: 120px;">
                <span style="font-size: 19px; font-weight: bold;">/</span><input type="number" value="{{ $iNbTables }}" style="width: 120px;" disabled>
                <small>Quota journalier de réservations web</small>
            </div>
        </div>
                
        <div style="margin-top: 20px;">
            <button class="btn" onclick="saveQuota()">💾 Enregistrer</button>
        </div>
    </div>
    <script>
        function saveQuota() {
            let nb = $('#nbQuota').val();
            if(!nb || !confirm('Confirmer la modification ?')) return;  
             fetch({{ route('admin.quotas.update') }}, {
                method: 'PATCH',
                    headers: {
                    "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                },
                // On envoie la donnée ici !
                body: JSON.stringify({ nb: nb }) 
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Quota modifié !');
                    location.reload(); 
                }
            }); 
        }
    </script>
@endsection