// // $(document).ready(function() {
// //     // Initialiser les dropdowns avec Bootstrap
// //     $('.dropdown-toggle').dropdown();
    
// //     // Fermer le dropdown lorsqu'on clique à l'extérieur
// //     $(document).on('click', function(e) {
// //         if (!$(e.target).closest('.dropdown').length) {
// //             $('.dropdown-menu').removeClass('show');
// //         }
// //     });
    
// //     // Toggle du dropdown lorsqu'on clique sur le bouton
// //     $('.dropdown-toggle.no-caret').on('click', function(e) {
// //         e.stopPropagation();
// //         const dropdownMenu = $(this).next('.dropdown-menu');
// //         $('.dropdown-menu').not(dropdownMenu).removeClass('show');
// //         dropdownMenu.toggleClass('show');
// //     });

// //     // Afficher le message de succès après suppression
// //     $(document).on('click', '.delete-action', function() {
// //         var deleteUrl = $(this).data('delete-url');
// //         var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtenir le token CSRF depuis les métadonnées

// //         if (confirm('Êtes-vous sûr de vouloir supprimer cette leçon ?')) {
// //             $.ajax({
// //                 url: deleteUrl,
// //                 type: 'POST', // Utilisation de POST pour contourner les restrictions de méthode DELETE
// //                 data: {
// //                     _method: 'DELETE', // Spécifier la méthode DELETE
// //                     _token: csrfToken
// //                 },
// //                 success: function(response) {
// //                     // Afficher le message de succès immédiatement
// //                     var successMessage = response.successMessage;  // Message de succès avec le nom de la leçon supprimée
// //                     $('#success-message').text(successMessage).show();

// //                     // Masquer le message après 5 secondes (temps de visualisation)
// //                     setTimeout(function() {
// //                         $('#success-message').fadeOut();
// //                         // Rafraîchir la page après 5 secondes
// //                         location.reload();
// //                     }, 1000); // Message visible pendant 5 secondes
// //                 },
// //                 error: function(xhr, status, error) {
// //                     console.log('Erreur:', xhr.responseText);
// //                     alert('Une erreur est survenue lors de la suppression.');
// //                 }
// //             });
// //         }
// //     });
// // });




// $(document).ready(function() {
//     // Initialiser les dropdowns avec Bootstrap
//     $('.dropdown-toggle').dropdown();
    
//     // Fermer le dropdown lorsqu'on clique à l'extérieur
//     $(document).on('click', function(e) {
//         if (!$(e.target).closest('.dropdown').length) {
//             $('.dropdown-menu').removeClass('show');
//         }
//     });
    
//     // Toggle du dropdown lorsqu'on clique sur le bouton
//     $('.dropdown-toggle.no-caret').on('click', function(e) {
//         e.stopPropagation();
//         const dropdownMenu = $(this).next('.dropdown-menu');
//         $('.dropdown-menu').not(dropdownMenu).removeClass('show');
//         dropdownMenu.toggleClass('show');
//     });

//     // Afficher le message de succès après suppression
//     $(document).on('click', '.delete-action', function() {
//         var deleteUrl = $(this).data('delete-url');
//         var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtenir le token CSRF depuis les métadonnées
//         var type = $(this).data('type'); // Récupérer le type de la ressource (ex: catégorie, leçon)
//         var name = $(this).data('name'); // Récupérer le nom de la ressource (ex: nom de la catégorie)

//         // Message de confirmation dynamique selon le type de la ressource
//         var message = `Êtes-vous sûr de vouloir supprimer cette ${type} : "${name}" ?`;

//         if (confirm(message)) {
//             $.ajax({
//                 url: deleteUrl,
//                 type: 'POST', // Utilisation de POST pour contourner les restrictions de méthode DELETE
//                 data: {
//                     _method: 'DELETE', // Spécifier la méthode DELETE
//                     _token: csrfToken
//                 },
//                 success: function(response) {
//                     // Afficher le message de succès immédiatement
//                     var successMessage = response.successMessage;  // Message de succès avec le nom de la ressource supprimée
//                     $('#success-message').text(successMessage).show();

//                     // Masquer le message après 5 secondes (temps de visualisation)
//                     setTimeout(function() {
//                         $('#success-message').fadeOut();
//                         // Rafraîchir la page après 5 secondes
//                         location.reload();
//                     }, 1000); // Message visible pendant 5 secondes
//                 },
//                 error: function(xhr, status, error) {
//                     console.log('Erreur:', xhr.responseText);
//                     alert('Une erreur est survenue lors de la suppression.');
//                 }
//             });
//         }
//     });
// });



// $(document).ready(function() {
//     // Initialiser les dropdowns avec Bootstrap
//     $('.dropdown-toggle').dropdown();
    
//     // Fermer le dropdown lorsqu'on clique à l'extérieur
//     $(document).on('click', function(e) {
//         if (!$(e.target).closest('.dropdown').length) {
//             $('.dropdown-menu').removeClass('show');
//         }
//     });
    
//     // Toggle du dropdown lorsqu'on clique sur le bouton
//     $('.dropdown-toggle.no-caret').on('click', function(e) {
//         e.stopPropagation();
//         const dropdownMenu = $(this).next('.dropdown-menu');
//         $('.dropdown-menu').not(dropdownMenu).removeClass('show');
//         dropdownMenu.toggleClass('show');
//     });

//     // Afficher le message de succès après suppression
//     $(document).on('click', '.delete-action', function() {
//         var deleteUrl = $(this).data('delete-url');
//         var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtenir le token CSRF depuis les métadonnées

//         if (confirm('Êtes-vous sûr de vouloir supprimer cette leçon ?')) {
//             $.ajax({
//                 url: deleteUrl,
//                 type: 'POST', // Utilisation de POST pour contourner les restrictions de méthode DELETE
//                 data: {
//                     _method: 'DELETE', // Spécifier la méthode DELETE
//                     _token: csrfToken
//                 },
//                 success: function(response) {
//                     // Afficher le message de succès immédiatement
//                     var successMessage = response.successMessage;  // Message de succès avec le nom de la leçon supprimée
//                     $('#success-message').text(successMessage).show();

//                     // Masquer le message après 5 secondes (temps de visualisation)
//                     setTimeout(function() {
//                         $('#success-message').fadeOut();
//                         // Rafraîchir la page après 5 secondes
//                         location.reload();
//                     }, 1000); // Message visible pendant 5 secondes
//                 },
//                 error: function(xhr, status, error) {
//                     console.log('Erreur:', xhr.responseText);
//                     alert('Une erreur est survenue lors de la suppression.');
//                 }
//             });
//         }
//     });
// });




$(document).ready(function() {
    // Initialiser les dropdowns avec Bootstrap
    $('.dropdown-toggle').dropdown();
    
    // Fermer le dropdown lorsqu'on clique à l'extérieur
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('show');
        }
    });
    
    // Toggle du dropdown lorsqu'on clique sur le bouton
    $('.dropdown-toggle.no-caret').on('click', function(e) {
        e.stopPropagation();
        const dropdownMenu = $(this).next('.dropdown-menu');
        $('.dropdown-menu').not(dropdownMenu).removeClass('show');
        dropdownMenu.toggleClass('show');
    });

    // Afficher le message de succès après suppression
    $(document).on('click', '.delete-action', function() {
        var deleteUrl = $(this).data('delete-url');
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtenir le token CSRF depuis les métadonnées
        var type = $(this).data('type'); // Récupérer le type de la ressource (ex: catégorie, leçon)
        var name = $(this).data('name'); // Récupérer le nom de la ressource (ex: nom de la catégorie)

        // Message de confirmation dynamique selon le type de la ressource
        var message = `Êtes-vous sûr de vouloir supprimer cette ${type} : "${name}" ?`;

        if (confirm(message)) {
            $.ajax({
                url: deleteUrl,
                type: 'POST', // Utilisation de POST pour contourner les restrictions de méthode DELETE
                data: {
                    _method: 'DELETE', // Spécifier la méthode DELETE
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.successMessage) {
                        $('#success-message').text(response.successMessage).show();
                        setTimeout(function() {
                            $('#success-message').fadeOut();
                            location.reload(); // Rafraîchir la page
                        }, 1000); 
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erreur:', xhr.responseText);
                    alert('Une erreur est survenue lors de la suppression.');
                }
            });
        }
    });
});
