<!DOCTYPE html>
<html lang="fr">
@include('partials.header')
<body>
    @include('partials.navbar')
    
    @yield('content')

    @include('partials.footer')

    <!-- JavaScript -->
    <script src="/js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"9d7b67a238e50248","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.9.1","token":"7f7b0fd8732c4326aae4b9d58d5c514a"}' crossorigin="anonymous"></script>
    <script>
        // Set minimum date to today
        document.getElementById('date').min = new Date().toISOString().split('T')[0];
        
        // Form submission handler
        document.getElementById('reservationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const reservation = {};
            formData.forEach((value, key) => reservation[key] = value);
            
            // Store in localStorage for demo (in production, send to backend)
            let reservations = JSON.parse(localStorage.getItem('reservations') || '[]');
            reservation.id = Date.now();
            reservation.status = 'pending';
            reservation.created_at = new Date().toISOString();
            reservations.push(reservation);
            localStorage.setItem('reservations', JSON.stringify(reservations));
            
            // Show confirmation
            alert('Merci ' + reservation.prenom + ' !\n\nVotre demande de réservation pour le ' + reservation.date + ' à ' + reservation.heure + ' (' + reservation.personnes + ' pers.) a bien été enregistrée.\n\nVous recevrez un email de confirmation sous 24h.');
            this.reset();
        });
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"9d7b6c623f930248","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.9.1","token":"7f7b0fd8732c4326aae4b9d58d5c514a"}' crossorigin="anonymous"></script>

</body>
</html>
