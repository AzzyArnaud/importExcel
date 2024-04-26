
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <style>
 button.active {
    background-color: #f8f9fa;
    color: #000;
}
table.dataTable thead th,
table.dataTable thead td {
    white-space: nowrap;
}

@media screen and (max-width: 767px) {
    table.dataTable thead th,
    table.dataTable thead td {
        white-space: normal;
    }
}
  </style>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const myButton = document.getElementById('myButton');

    // Vérifie si le bouton a été visité précédemment
    if (localStorage.getItem('buttonVisited')) {
        myButton.classList.add('active');
    }

    myButton.addEventListener('click', function() {
        // Active le bouton
        myButton.classList.add('active');

        // Enregistre l'état du bouton dans le stockage local du navigateur
        localStorage.setItem('buttonVisited', true);
    });
});
</script>