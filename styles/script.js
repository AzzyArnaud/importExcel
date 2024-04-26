document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('a[id^="button"]');

    // Ajoute la classe "active" au premier bouton
    // buttons[0].classList.add('active');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Supprime la classe "active" de tous les boutons
            buttons.forEach(function(btn) {
                btn.classList.remove('active');
            });

            // Ajoute la classe "active" au bouton cliqué
            this.classList.add('active');
        });
    });
});