$(document).ready(function() {
    // Fonction pour afficher les alertes
    function showAlert(message, type) {
        const alertDiv = $('<div></div>')
            .addClass('alert')
            .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
            .html(message);

        $('#alert-container').empty().append(alertDiv);

        // Faire disparaître l'alerte après 5 secondes
        setTimeout(function() {
            alertDiv.fadeOut('slow', function() {
                $(this).remove();
            });
        }, 5000);
    }

    // Fonction pour charger le contenu d'un onglet
    function loadTabContent(tabName, callback = null) {
        let url = '';
        let title = '';

        switch(tabName) {
            case 'profile':
                url = PROFILE_URLS.profile;
                title = 'Modifier le Profil';
                break;
            case 'account':
                url = PROFILE_URLS.account;

                break;
            case 'certification':
                url = '#'; // À remplacer par la route vers la certification
                title = 'Certification';
                break;
            default:
                url = PROFILE_URLS.profile;
                title = 'Modifier le Profil';
        }

        $('#tab-title').text(title);
        $('#content-loader').show();

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#tab-content').html(response);
                $('#content-loader').hide();
                if (callback) callback();
            },
            error: function(xhr) {
                $('#content-loader').hide();
                showAlert('Une erreur est survenue lors du chargement de la page.', 'danger');
            }
        });
    }

    // Gérer les clics sur les onglets
    $('.list-group-item').on('click', function(e) {
        e.preventDefault();

        // Mise à jour de l'état actif des onglets
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');

        const tabName = $(this).data('tab');
        loadTabContent(tabName);
    });

    // Charger l'onglet "Modifier le Profil" par défaut
    loadTabContent('profile');

    // Gérer les événements délégués pour les liens qui seront chargés dynamiquement
    $(document).on('click', '.account-link', function(e) {
        e.preventDefault();
        const linkType = $(this).data('link');

        let url = '';
        let title = '';

        switch(linkType) {
            case 'email':
                url = PROFILE_URLS.email;

                break;
            case 'password':
                url = PROFILE_URLS.password;
                
                break;
            default:
                return;
        }

        $('#tab-title').text(title);
        $('#content-loader').show();

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#tab-content').html(response);
                $('#content-loader').hide();
            },
            error: function(xhr) {
                $('#content-loader').hide();
                showAlert('Une erreur est survenue lors du chargement de la page.', 'danger');
            }
        });
    });

    // Gestion des formulaires par AJAX
    $(document).on('submit', '.ajax-form', function(e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');
        const method = form.attr('method');
        const formData = form.serialize();

        $('#content-loader').show();

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                $('#content-loader').hide();

                if (response.message) {
                    showAlert(response.message, 'success');
                }

                // Gestion spécifique pour le formulaire de mot de passe
                if (form.attr('id') === 'edit-password-form' || form.data('reload-tab') === 'account') {
                    loadTabContent('account');
                    return;
                }

                // Gestion normale pour les autres formulaires
                if (form.data('reload-tab')) {
                    loadTabContent(form.data('reload-tab'));
                }

                if (form.data('next-page')) {
                    const nextPage = form.data('next-page');
                    const nextUrl = form.data('next-url');
                    $('#tab-title').text(nextPage);

                    $.ajax({
                        url: nextUrl,
                        type: 'GET',
                        success: function(response) {
                            $('#tab-content').html(response);
                        },
                        error: function(xhr) {
                            showAlert('Une erreur est survenue lors du chargement de la page suivante.', 'danger');
                        }
                    });
                }
            },
            error: function(xhr) {
                $('#content-loader').hide();

                if (xhr.responseJSON && xhr.responseJSON.error) {
                    showAlert(xhr.responseJSON.error, 'danger');
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorMsg = '';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMsg += value + '<br>';
                    });
                    showAlert(errorMsg, 'danger');
                } else {
                    showAlert('Une erreur est survenue. Veuillez réessayer.', 'danger');
                }
            }
        });
    });

    // Gestion du retour arrière
    $(document).on('click', '.back-btn', function(e) {
        e.preventDefault();
        const backTab = $(this).data('back-tab');
        loadTabContent(backTab);
    });
});
