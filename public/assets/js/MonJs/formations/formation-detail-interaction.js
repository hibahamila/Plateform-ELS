

function createFormationCard(formation) {
    const card = document.createElement('div');
    card.className = 'formation-card-container';
    
    // Utiliser le titre complet
    const fullTitle = formation.title;
    
    // Déterminer les classes spéciales pour la carte
    const hasRating = formation.average_rating !== null && formation.total_feedbacks > 0;
    const isFree = formation.price == 0;
    const hasPaidPrice = formation.price > 0;
    
    // Classes pour la carte en fonction des conditions
    const cardClasses = [
        'formation-card',
        !hasRating ? 'no-rating' : '',
        isFree ? 'has-free-badge' : '',
        !hasRating && isFree ? 'compact-card' : '',
        !hasRating && !isFree && hasPaidPrice ? 'price-bottom' : ''
    ].filter(Boolean).join(' ');
    
    let html = `
        <div class="${cardClasses}" 
             data-duration="${formation.duration || '00:00'}" 
             data-courses-count="${formation.cours ? formation.cours.length : 0}">
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
            
            <div class="action-icons">
                 <i class="icofont icofont-ui-edit edit-icon action-icon" data-edit-url="${window.location.origin}/formation/${formation.id}/edit"></i>
                <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="${window.location.origin}/formation/${formation.id}"></i>
            </div>

            <div class="card-badges">
                ${formation.price == 0 ? '<span class="badge-free">Gratuite</span>' : ''}
            </div>
        </div>
    `;
    
    card.innerHTML = html;

    return card;
}

// Fonction pour gérer l'affichage du panneau de détails
$(document).ready(function() {
    // Créer un conteneur pour le panneau de détails s'il n'existe pas déjà
    if ($('#formation-detail-panel').length === 0) {
        $('body').append('<div id="formation-detail-panel"></div>');
    }
    
    // Variables pour gérer le délai
    let timeoutId;
    let isOverCard = false;
    let isOverPanel = false;
    
    // Fonction pour récupérer la description
    function getDescriptionContent($card) {
        // Essayez plusieurs sélecteurs possibles pour la description
        const $description = $card.find('.formation-description, .description, .formation-desc');
        
        if ($description.length) {
            // Si c'est un élément textuel, retournez son texte
            if ($description.is(':not(:has(*))')) {
                return $description.text();
            }
            // Sinon retournez son HTML
            return $description.html();
        }
        
        // Si aucun sélecteur standard ne fonctionne, cherchez le premier élément avec du texte
        const textElements = $card.find('*').filter(function() {
            return $(this).text().trim().length > 0 && 
                !$(this).hasClass('formation-title') && 
                !$(this).hasClass('formation-instructor');
        });
        
        return textElements.first().html() || 'Description non disponible';
    }
    
$(document).on('mouseenter', '.formation-card', function() {
    console.log("Formation card hovered");
    
    // Récupérer les données de la formation
    const $card = $(this);
    const title = $card.find('.formation-title').text();
    const instructor = $card.find('.formation-instructor').text().trim();
    
    // Récupérer la durée et le nombre de cours depuis les attributs data-
    const duration = $card.attr('data-duration') || "00:00";
    const coursesCount = parseInt($card.attr('data-courses-count') || 0);
    
    // Récupérer le contenu de la description
    const descriptionHTML = getDescriptionContent($card);
    
    // Récupérer les caractéristiques spécifiques
    let featuresHTML = '';
    const $features = $card.find('.formation-features li, .features li');
    if ($features.length) {
        featuresHTML = '<ul class="features">';
        $features.each(function() {
            featuresHTML += `<li><b style="color: blue;">CHECK</b> ${$(this).html()}</li>`;
        });
        featuresHTML += '</ul>';
    }
    
    // Position du panneau
    const cardPosition = $card.offset();
    const cardWidth = $card.width();
    const windowWidth = $(window).width();
    const windowHeight = $(window).height();
    
    // Déterminer si on doit afficher le panneau à gauche ou à droite
    let panelPosition = 'right';
    if (cardPosition.left + cardWidth + 400 > windowWidth) {
        panelPosition = 'left';
    }
    
    // Construire la section meta-info en fonction des valeurs
    let metaInfoHTML = '';
    
    // Vérifier si la durée n'est pas "00:00" (ou 0h0m)
    const isDurationValid = duration !== "00:00" && duration !== "0:0" && duration !== "0:00" && duration !== "00:0";
    
    // Construire la partie meta-info
    if (isDurationValid && coursesCount > 0) {
        // Les deux valeurs sont valides
        metaInfoHTML = `<div class="formation-meta-info">
            ${formatDuration(duration)} • ${coursesCount} cours
        </div>`;
    } else if (isDurationValid) {
        // Seulement la durée est valide
        metaInfoHTML = `<div class="formation-meta-info">
            ${formatDuration(duration)}
        </div>`;
    } else if (coursesCount > 0) {
        // Seulement le nombre de cours est valide
        metaInfoHTML = `<div class="formation-meta-info">
            ${coursesCount} cours
        </div>`;
    }
    // Si aucune des valeurs n'est valide, metaInfoHTML reste vide
    
    // Construire le HTML du panneau avec les informations conditionnelles
    let panelHTML = `
        <div class="panel-content">
            <h3>${title}</h3>
            ${metaInfoHTML}
            <div class="description rich-content" style="margin-bottom: 15px;">${descriptionHTML}</div>
            ${featuresHTML}
            <div style="margin-top: 15px;"></div>
            <button class="btn-add-to-cart">Ajouter au panier</button>
        </div>
    `;
    
    // Positionner et afficher le panneau
    const $panel = $('#formation-detail-panel');
    $panel.html(panelHTML);
    
    // Rendre le panneau temporairement visible mais transparent pour calculer sa hauteur
    $panel.css('opacity', 0).addClass('active');
    
    // Calculer le décalage en fonction de la longueur du contenu
    const panelHeight = $panel.outerHeight();
    let topOffset = -20; // décalage par défaut
    
    // Si le panneau est grand (contenu long) et risque de dépasser l'écran
    if (panelHeight > 400) {
        // Ajuster le décalage pour le positionner plus haut
        topOffset = -Math.min(150, panelHeight * 0.2);
    }
    
    // Vérifier si le panneau dépasse du bas de la fenêtre
    const panelBottom = cardPosition.top + topOffset + panelHeight;
    if (panelBottom > windowHeight + $(window).scrollTop()) {
        // Réajuster pour qu'il reste dans la fenêtre
        topOffset = windowHeight + $(window).scrollTop() - panelHeight - cardPosition.top - 20;
    }
    
    const fixedTopOffset = -55; // 20 pixels vers le haut

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
});

// Amélioration de la fonction formatDuration pour mieux détecter les durées à 0
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
});