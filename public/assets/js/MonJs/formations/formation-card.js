
// formationCards.js
function createFormationCard(formation) {
    const duration = formation.duration || '00:00';
    const coursesCount = formation.cours ? formation.cours.length : 0;
    console.log("Formation ID:", formation.id);
    console.log("Duration:", duration);
    console.log("Courses Count:", coursesCount);
    
    // Create card container
    card.className = 'formation-card-container';
    
    const card = document.createElement('div');
    card.className = 'formation-card-container';
    const fullTitle = formation.title;
    
    const hasRating = formation.average_rating !== null && formation.total_feedbacks > 0;
    const isFree = formation.price == 0;
    const hasPaidPrice = formation.price > 0;
    
    const cardClasses = [
        'formation-card',
        !hasRating ? 'no-rating' : '',
        isFree ? 'has-free-badge' : '',
        !hasRating && isFree ? 'compact-card' : '',
        !hasRating && !isFree && hasPaidPrice ? 'price-bottom' : ''
    ].filter(Boolean).join(' ');
    
    let html = `
        <div class="${cardClasses}" data-duration="${duration}" data-courses-count="${coursesCount}">
            ${formation.status && formation.is_bestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : ''}
            
            ${formation.image 
                ? `<img src="${window.location.origin}/storage/${formation.image}" alt="${fullTitle}">`
                : '<div class="placeholder-image">Image de formation</div>'
            }
            
            <div class="title-container">
                <h4 class="formation-title ${fullTitle.length < 50 ? 'title-short' : ''}" title="${fullTitle}">${fullTitle}</h4>
            </div>
            <div class="formation-instructor ${!hasRating ? 'no-rating' : ''}">
                ${formation.user 
                    ? `${formation.user.name} ${formation.user.lastname || ''}`
                    : 'Professeur non défini'
                }
            </div>
        
            <div class="formation-description" style="display:none;">
                ${formation.description || 'Aucune description disponible'}
            </div>
            
            <div class="formation-rating-price ${!hasRating ? 'no-rating' : ''}">
                <div class="formation-rating">
    `;

    if (hasRating) {
        const rating = formation.average_rating;
        const fullStars = Math.floor(rating);
        const decimalPart = rating - fullStars;
        const hasHalfStar = decimalPart >= 0.25;
        
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= fullStars) {
                starsHtml += '<i class="fas fa-star"></i>';
            } else if (i === fullStars + 1 && hasHalfStar) {
                starsHtml += '<i class="fas fa-star-half-alt"></i>';
            } else {
                starsHtml += '<i class="far fa-star"></i>';
            }
        }
        html += `
                <span class="rating-value">${parseFloat(rating).toFixed(1)}</span>
                    <span class="rating-stars">${starsHtml}</span>
                    <span class="rating-count">(${formation.total_feedbacks})</span>
                `;
    }
    
    html += `
                </div>
                <div class="price-container ${!hasRating ? 'no-rating' : ''}">
                    ${formation.price == 0 
                        ? ``
                        : formation.discount > 0 
                            ? `<div style="display: flex; align-items: center;">
                                <span class="original-price">${parseFloat(formation.price).toFixed(3)} DT</span>
                                <span class="discount-badge">-${formation.discount}%</span>
                            </div>
                            <span class="final-price">${parseFloat(formation.final_price).toFixed(3)} DT</span>`
                            : `<span class="final-price">${parseFloat(formation.price).toFixed(3)} DT</span>`
                    }
                </div>
            </div>
            <div class="action-menu prevent-detail-panel">
                <div class="action-dots prevent-detail-panel">
                    <i class="fas fa-ellipsis-v prevent-detail-panel"></i>
                </div>
                <div class="action-dropdown prevent-detail-panel">
                    <div class="action-item edit-action prevent-detail-panel" data-edit-url="${window.location.origin}/formation/${formation.id}/edit">
                        Modifier
                    </div>
                    <div class="action-item delete-action prevent-detail-panel" data-delete-url="${window.location.origin}/formation/${formation.id}">
                        Supprimer
                    </div>
                </div>
            </div>
            
            <div class="card-badges">
                ${formation.price == 0 ? '<span class="badge-free">Gratuite</span>' : ''}
            </div>
        </div>
    `;
    card.innerHTML = html;
    return card;
}
// Initialisation du panneau de détail
$(document).ready(function() {
    if ($('#formation-detail-panel').length === 0) {
        $('body').append('<div id="formation-detail-panel"></div>');
    }
    let timeoutId;
    let isOverCard = false;
    let isOverPanel = false;
      // Créer un cache pour éviter des requêtes répétées
      const cartStatusCache = {};
    
    function checkFormationInCart(formationId, callback) {
          // Si nous avons déjà récupéré cette information, utiliser le cache
          if (cartStatusCache.hasOwnProperty(formationId)) {
              callback(cartStatusCache[formationId]);
              return;
            }
          
          // Sinon, faire une requête AJAX
          $.ajax({
              url: `/panier/check/${formationId}`,
              type: 'GET',
              success: function(response) {
                  cartStatusCache[formationId] = response.in_cart;
                  callback(response.in_cart);
              },
              error: function() {
                  callback(false);
              }
            });
    }
  
    function getDescriptionContent($card) {
        const $description = $card.find('.formation-description, .description, .formation-desc');
        if ($description.length) {
            if ($description.is(':not(:has(*))')) {
                return $description.text();
            }
            return $description.html();
        }
        const textElements = $card.find('*').filter(function() {
            return $(this).text().trim().length > 0 && 
                !$(this).hasClass('formation-title') && 
                !$(this).hasClass('formation-instructor');
        });
        
        return textElements.first().html() || 'Description non disponible';
    }
    
    $(document).on('mouseenter', '.formation-card', function(e) {
        if ($(e.target).closest('.prevent-detail-panel, .action-menu, .action-dots, .action-dropdown').length) {
            return;
        }
        
        const $card = $(this);
        const title = $card.find('.formation-title').text();
        const instructor = $card.find('.formation-instructor').text().trim();
        const duration = $card.attr('data-duration') || "00:00";
        const coursesCount = parseInt($card.attr('data-courses-count') || 0);
        const descriptionHTML = getDescriptionContent($card);
        const deleteUrl = $card.find('.delete-action').data('delete-url') || '';
        const formationId = deleteUrl.split('/').pop();
        
        // Créer le panneau avec un bouton de chargement
        // let buttonHTML = '<button class="btn-loading">Chargement...</button>';
        let buttonHTML = '<button class="btn-loading"><i class="fas fa-spinner fa-spin"></i></button>';

        
        let featuresHTML = '';
        const $features = $card.find('.formation-features li, .features li');
        if ($features.length) {
            featuresHTML = '<ul class="features">';
            $features.each(function() {
                featuresHTML += `<li><b style="color: blue;">CHECK</b> ${$(this).html()}</li>`;
            });
            featuresHTML += '</ul>';
        }
        
        const cardPosition = $card.offset();
        const cardWidth = $card.width();
        const windowWidth = $(window).width();
        const windowHeight = $(window).height();
        
        let panelPosition = 'right';
        if (cardPosition.left + cardWidth + 400 > windowWidth) {
            panelPosition = 'left';
        }
        
        let metaInfoHTML = '';
        const isDurationValid = duration !== "00:00" && duration !== "0:0" && duration !== "0:00" && duration !== "00:0";
        
        if (isDurationValid && coursesCount > 0) {
            metaInfoHTML = `<div class="formation-meta-info">
                ${formatDuration(duration)} • ${coursesCount} cours
            </div>`;
        } else if (isDurationValid) {
            metaInfoHTML = `<div class="formation-meta-info">
                ${formatDuration(duration)}
            </div>`;
        } else if (coursesCount > 0) {
            metaInfoHTML = `<div class="formation-meta-info">
                ${coursesCount} cours
            </div>`;
        }
        
        let panelHTML = `
            <div class="panel-content">
                <h3>${title}</h3>
                ${metaInfoHTML}
                <div class="description rich-content" style="margin-bottom: 15px;">${descriptionHTML}</div>
                ${featuresHTML}
                <div style="margin-top: 15px;"></div>
                ${buttonHTML}
            </div>
        `;
        
        const $panel = $('#formation-detail-panel');
        $panel.html(panelHTML);
        $panel.css('opacity', 0).addClass('active');
        
        const panelHeight = $panel.outerHeight();
        const panelBottom = cardPosition.top - 55 + panelHeight;
        let fixedTopOffset = -55;
        
        if (panelBottom > windowHeight + $(window).scrollTop()) {
            fixedTopOffset = windowHeight + $(window).scrollTop() - panelHeight - cardPosition.top - 20;
        }
        
        if (panelPosition === 'right') {
            $panel.css({
                'left': cardPosition.left + cardWidth + 10,
                'top': cardPosition.top + fixedTopOffset, 
                'opacity': 1
            });
        } else {
            $panel.css({
                'left': cardPosition.left - 410,
                'top': cardPosition.top + fixedTopOffset, 
                'opacity': 1
            });
        }
        
        isOverCard = true;
        clearTimeout(timeoutId);
     
        checkFormationInCart(formationId, function(inCart) {
            if (inCart) {
                $panel.find('.btn-loading').replaceWith(
                    '<a href="/panier" class="btn-view-cart"> Accéder au panier</a>'
                );
            } else {
                $panel.find('.btn-loading').replaceWith(
                    `<button class="btn-add-to-cart purple-btn" data-formation-id="${formationId}"> Ajouter au panier</button>`
                );
            }
        });
    });
    

    $(document).on('mouseleave', '.formation-card', function(e) {
        if ($(e.toElement || e.relatedTarget).closest('.prevent-detail-panel, .action-menu, .action-dots, .action-dropdown').length) {
            return;
        }
        
        isOverCard = false;
        timeoutId = setTimeout(function() {
            if (!isOverPanel) {
                $('#formation-detail-panel').removeClass('active').css('opacity', 0);
            }
        }, 300);
    });

    $(document).on('mouseenter', '#formation-detail-panel', function() {
        isOverPanel = true;
        clearTimeout(timeoutId);
    });

    $(document).on('mouseleave', '#formation-detail-panel', function() {
        isOverPanel = false;
        timeoutId = setTimeout(function() {
            if (!isOverCard) {
                $('#formation-detail-panel').removeClass('active').css('opacity', 0);
            }
        }, 300);
    });

    $(document).on('mouseenter click', '.prevent-detail-panel, .action-menu, .action-dots, .action-dropdown, .action-item', function(e) {
        e.stopPropagation();
        $('#formation-detail-panel').removeClass('active').css('opacity', 0);
        isOverCard = false;
        isOverPanel = false;
        clearTimeout(timeoutId);
    });

    function formatDuration(duration) {
        if (!duration || duration === '00:00' || duration === '0:0' || duration === '0:00' || duration === '00:0') {
            return '0 heures';
        }
        
        const parts = duration.split(':');
        if (parts.length !== 2) return '0 heures';
        
        const hours = parseInt(parts[0]);
        const minutes = parseInt(parts[1]);
        
        if (hours === 0 && minutes === 0) {
            return '0 heures';
        } else if (hours === 0) {
            return `${minutes} min`;
        } else if (minutes === 0) {
            return `${hours} h`;
        } else {
            return `${hours},${minutes} heures totales`;
        }
    }
    // / Ajouter un gestionnaire d'événement pour le bouton "Ajouter au panier"
//     $(document).on('click', '.btn-add-to-cart', function() {
//         const formationId = $(this).data('formation-id');
//         const $button = $(this);
        
//         $.ajax({
//             url: '/panier/ajouter',
//             type: 'POST',
//             data: {
//                 formation_id: formationId,
//                 _token: $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function(response) {
//                 if (response.success) {
//                     // Mettre à jour le cache immédiatement
//                     cartStatusCache[formationId] = true;
                    
//                     // Remplacer le bouton par "Accéder au panier"
//                     $button.replaceWith('<a href="/panier" class="btn-view-cart"> Accéder au panier</a>');
//                 }
//             }
//         });
//     });
    
// });

// Ajouter un gestionnaire d'événement pour le bouton "Ajouter au panier"
$(document).on('click', '.btn-add-to-cart', function() {
    const formationId = $(this).data('formation-id');
    const $button = $(this);
    
    $.ajax({
        url: '/panier/ajouter',
        type: 'POST',
        data: {
            formation_id: formationId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                // Mettre à jour le cache immédiatement
                cartStatusCache[formationId] = true;
                
                // Mettre à jour le badge du panier dans l'en-tête
                updateCartBadge(response.cartCount);
                
                // Remplacer le bouton par "Accéder au panier"
                $button.replaceWith('<a href="/panier" class="btn-view-cart"> Accéder au panier</a>');
            }
        }
    });
});

// Fonction pour mettre à jour le badge du panier
function updateCartBadge(count) {
    // Si le badge existe déjà
    if ($('.cart-badge').length) {
        if (count > 0) {
            // Mettre à jour le texte du badge
            $('.cart-badge').text(count);
        } else {
            // Si le panier est vide, supprimer le badge
            $('.cart-badge').remove();
        }
    } else if (count > 0) {
        // Si le badge n'existe pas et qu'il y a des articles dans le panier, créer le badge
        $('.cart-container').append(`<span class="cart-badge">${count}</span>`);
    }
}

});






