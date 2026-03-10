@extends('layouts.back_main')

@section('content')
    <div class="settings-panel" id="settingsPanel" style="display: block; margin-top: 5em;">
        <h3>⚙️ Quota de réservations de tables en ligne</h3>
        <p style="color: var(--color-text-light);">Définissez le nombre maximum de tables pouvant être effectuées en ligne par jour. Au-delà de ce quota, les clients devront appeler pour réserver.</p>
        <div style="max-width: 300px; margin-top: 25px;">
            <div class="setting-card">
                <label>🌐 Réservations en ligne max / jour</label>
                <input type="hidden" id="idQuota" value="{{ $oQuota->id }}" />
                <input type="number" id="nbQuota" min="0" max="100" value="{{ $oQuota->nb }}" style="width: 120px;">
                <span style="font-size: 19px; font-weight: bold;">/</span><input type="number" value="{{ $iNbTables }}" style="width: 120px;" disabled>
                <small>Quota journalier de réservations web</small>
            </div>
        </div>
                
        <div style="margin-top: 20px;">
            <button class="btn" onclick="saveQuota({{ $oQuota->id }})">💾 Enregistrer</button>
        </div>
    </div>
    <script>
        function saveQuota(id) {
            if(!confirm(`Confirmer la modification du quota ?`)) return;

            let nbQuota = document.getElementById('nbQuota').value;
            let idQuota = document.getElementById('idQuota').value;

            fetch("{{ route('admin.quotas.updnb') }}", {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }, 
                body: JSON.stringify({ id: idQuota, nb: nbQuota })
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