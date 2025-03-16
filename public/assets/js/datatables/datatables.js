$(document).ready(function() {
    // Initialisation de DataTable pour toutes les tables avec la classe .dataTable
    $('.dataTable').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json"

            // url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json" // Langue française
        },
        responsive: true,
        paging: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],  // Options de pagination
        pageLength: 10,
        order: [[0, 'asc']]  // Tri par défaut sur la première colonne
    });
    //zedtha tw

    table.columns.adjust().draw();

});