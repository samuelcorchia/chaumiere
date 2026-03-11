document.addEventListener('DOMContentLoaded', function() {
    // Gestion du Menu Mobile
    const menuToggle = document.querySelector('.menu-toggle');
    const headerRight = document.querySelector('.header-right');
    const nav = document.querySelector('.nav');

    if (menuToggle && headerRight) {
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            headerRight.classList.toggle('active');
            
            // Force l'affichage de la nav interne
            if (nav) {
                nav.style.display = headerRight.classList.contains('active') ? 'flex' : '';
            }
        });
    }

    // Sécurité pour le champ date (évite l'erreur null)
    const dateInput = document.getElementById('date');
    if (dateInput) {
        dateInput.min = new Date().toISOString().split('T');
    }
});