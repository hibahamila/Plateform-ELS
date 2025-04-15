
// function createFormationCard(formation) {
//         const duration = formation.duration || '00:00';
//         const coursesCount = formation.cours ? formation.cours.length : 0;
//         console.log("Formation ID:", formation.id);
//         console.log("Duration:", duration);
//         console.log("Courses Count:", coursesCount);
//         const card = document.createElement('div');
//         card.className = 'formation-card-container';
//         // Utiliser le titre complet
//         const fullTitle = formation.title;
//         // Déterminer les classes spéciales pour la carte
//         const hasRating = formation.average_rating !== null && formation.total_feedbacks > 0;
//         const isFree = formation.price == 0;
//         const hasPaidPrice = formation.price > 0;
        
//         // Classes pour la carte en fonction des conditions
//         const cardClasses = [
//             'formation-card',
//             !hasRating ? 'no-rating' : '',
//             isFree ? 'has-free-badge' : '',
//             !hasRating && isFree ? 'compact-card' : '',
//             !hasRating && !isFree && hasPaidPrice ? 'price-bottom' : ''
//         ].filter(Boolean).join(' ');
        
//         let html = `
//             <div class="${cardClasses}" data-duration="${duration}" 
//                 data-courses-count="${coursesCount}">
//                 ${formation.status && formation.is_bestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : ''}
                
//                 ${formation.image 
//                     ? `<img src="${window.location.origin}/storage/${formation.image}" alt="${fullTitle}">`
//                     : '<div class="placeholder-image">Image de formation</div>'
//                 }
            
//                 <div class="title-container">
//                     <h4 class="formation-title ${fullTitle.length < 50 ? 'title-short' : ''}" title="${fullTitle}">${fullTitle}</h4>
//                 </div>
//                 <div class="formation-instructor ${!hasRating ? 'no-rating' : ''}">
//                     ${formation.user 
//                         ? `${formation.user.name} ${formation.user.lastname || ''}`
//                         : 'Professeur non défini'
//                     }
//                 </div>
            
//                 <div class="formation-description" style="display:none;">
//                     ${formation.description || 'Aucune description disponible'}
//                 </div>
                
//                 <div class="formation-rating-price ${!hasRating ? 'no-rating' : ''}">
//                     <div class="formation-rating">
//         `;

//         if (hasRating) {
//             const rating = formation.average_rating;
//             const fullStars = Math.floor(rating);
//             const decimalPart = rating - fullStars;
//             const hasHalfStar = decimalPart >= 0.25;
            
//             let starsHtml = '';
//             for (let i = 1; i <= 5; i++) {
//                 if (i <= fullStars) {
//                     starsHtml += '<i class="fas fa-star"></i>';
//                 } else if (i === fullStars + 1 && hasHalfStar) {
//                     starsHtml += '<i class="fas fa-star-half-alt"></i>';
//                 } else {
//                     starsHtml += '<i class="far fa-star"></i>';
//                 }
//             }
//             html += `
//                     <span class="rating-value">${parseFloat(rating).toFixed(1)}</span>
//                         <span class="rating-stars">${starsHtml}</span>
//                         <span class="rating-count">(${formation.total_feedbacks})</span>
//                     `;
//         }
        
//         html += `
//                     </div>
//                     <div class="price-container ${!hasRating ? 'no-rating' : ''}">
//                         ${formation.price == 0 
//                             ? ``
//                             : formation.discount > 0 
//                                 ? `<div style="display: flex; align-items: center;">
//                                     <span class="original-price">${parseFloat(formation.price).toFixed(3)} DT</span>
//                                     <span class="discount-badge">-${formation.discount}%</span>
//                                 </div>
//                                 <span class="final-price">${parseFloat(formation.final_price).toFixed(3)} DT</span>`
//                                 : `<span class="final-price">${parseFloat(formation.price).toFixed(3)} DT</span>`
//                         }
//                     </div>
//                 </div>
//                 <div class="action-menu prevent-detail-panel">
//                     <div class="action-dots prevent-detail-panel">
//                         <i class="fas fa-ellipsis-v prevent-detail-panel"></i>
//                     </div>
//                     <div class="action-dropdown prevent-detail-panel">
//                         <div class="action-item edit-action prevent-detail-panel" data-edit-url="${window.location.origin}/formation/${formation.id}/edit">
//                             Modifier
//                         </div>
//                         <div class="action-item delete-action prevent-detail-panel" data-delete-url="${window.location.origin}/formation/${formation.id}">
//                             Supprimer
//                         </div>
//                     </div>
//                 </div>
                
//                 <div class="card-badges">
//                     ${formation.price == 0 ? '<span class="badge-free">Gratuite</span>' : ''}
//                 </div>
//             </div>
//         `;
//         card.innerHTML = html;
//         return card;
//     }

//     function attachActionIconHandlers() {
//         // Gestionnaire pour afficher/masquer le menu déroulant
//         document.querySelectorAll('.action-dots').forEach(dots => {
//             dots.addEventListener('click', function(e) {
//                 e.stopPropagation(); // Empêcher la propagation de l'événement
                
//                 // Masquer immédiatement le panneau de détail s'il est visible
//                 $('#formation-detail-panel').removeClass('active').css('opacity', 0);
                
//                 // Fermer tous les autres menus ouverts
//                 document.querySelectorAll('.action-dropdown.show').forEach(dropdown => {
//                     if (!dropdown.parentNode.contains(e.target)) {
//                         dropdown.classList.remove('show');
//                     }
//                 });
                
//                 // Basculer l'affichage du menu actuel
//                 const dropdown = this.nextElementSibling;
//                 dropdown.classList.toggle('show');
//             });
//         });
        
//         // Gestionnaire pour les actions d'édition
//         document.querySelectorAll('.edit-action').forEach(action => {
//             action.addEventListener('click', function(e) {
//                 e.stopPropagation();
//                 window.location.href = this.dataset.editUrl;
//             });
//         });
        
//         // Gestionnaire pour les actions de suppression
//         document.querySelectorAll('.delete-action').forEach(action => {
//             action.addEventListener('click', function(e) {
//                 e.stopPropagation();
//                 const deleteUrl = this.dataset.deleteUrl;
//                 const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                
//                 // Message de confirmation
//                 if (confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')) {
//                     // Utiliser le formulaire pour soumettre la requête DELETE
//                     const form = document.createElement('form');
//                     form.method = 'POST';
//                     form.action = deleteUrl;
//                     form.style.display = 'none';
                    
//                     // Simuler la méthode DELETE pour Laravel
//                     const methodField = document.createElement('input');
//                     methodField.type = 'hidden';
//                     methodField.name = '_method';
//                     methodField.value = 'DELETE';
                    
//                     // Ajouter le token CSRF
//                     const tokenField = document.createElement('input');
//                     tokenField.type = 'hidden';
//                     tokenField.name = '_token';
//                     tokenField.value = csrfToken;
                    
//                     // Ajouter les champs au formulaire et soumettre
//                     form.appendChild(methodField);
//                     form.appendChild(tokenField);
//                     document.body.appendChild(form);
//                     form.submit();
//                 }
//             });
//         });
        
//         // Fermez le menu si on clique ailleurs sur la page
//         document.addEventListener('click', function(e) {
//             if (!e.target.closest('.action-menu')) {
//                 document.querySelectorAll('.action-dropdown').forEach(dropdown => {
//                     dropdown.classList.remove('show');
//                 });
//             }
//         });
//     }

//     // Modification de la fonction pour gérer l'affichage du panneau de détails
//     $(document).ready(function() {
//         // Créer un conteneur pour le panneau de détails s'il n'existe pas déjà
//         if ($('#formation-detail-panel').length === 0) {
//             $('body').append('<div id="formation-detail-panel"></div>');
//         }
        
//         // Variables pour gérer le délai
//         let timeoutId;
//         let isOverCard = false;
//         let isOverPanel = false;
        
//         // Fonction pour récupérer la description
//         function getDescriptionContent($card) {
//             // Essayez plusieurs sélecteurs possibles pour la description
//             const $description = $card.find('.formation-description, .description, .formation-desc');
            
//             if ($description.length) {
//                 // Si c'est un élément textuel, retournez son texte
//                 if ($description.is(':not(:has(*))')) {
//                     return $description.text();
//                 }
//                 // Sinon retournez son HTML
//                 return $description.html();
//             }
            
//             // Si aucun sélecteur standard ne fonctionne, cherchez le premier élément avec du texte
//             const textElements = $card.find('*').filter(function() {
//                 return $(this).text().trim().length > 0 && 
//                     !$(this).hasClass('formation-title') && 
//                     !$(this).hasClass('formation-instructor');
//             });
            
//             return textElements.first().html() || 'Description non disponible';
//         }
        
//         // Modifier l'événement mouseenter pour éviter d'afficher le panneau quand on survole le menu d'action
//         $(document).on('mouseenter', '.formation-card', function(e) {
//             // Ne pas afficher le panneau si on entre par le menu d'action
//             if ($(e.target).closest('.prevent-detail-panel, .action-menu, .action-dots, .action-dropdown').length) {
//                 return;
//             }
            
//             console.log("Formation card hovered");
            
//             // Récupérer les données de la formation
//             const $card = $(this);
//             const title = $card.find('.formation-title').text();
//             const instructor = $card.find('.formation-instructor').text().trim();
            
//             // Récupérer la durée et le nombre de cours depuis les attributs data-
//             const duration = $card.attr('data-duration') || "00:00";
//             const coursesCount = parseInt($card.attr('data-courses-count') || 0);
            
//             // Récupérer le contenu de la description
//             const descriptionHTML = getDescriptionContent($card);
            
//             // Récupérer les caractéristiques spécifiques
//             let featuresHTML = '';
//             const $features = $card.find('.formation-features li, .features li');
//             if ($features.length) {
//                 featuresHTML = '<ul class="features">';
//                 $features.each(function() {
//                     featuresHTML += `<li><b style="color: blue;">CHECK</b> ${$(this).html()}</li>`;
//                 });
//                 featuresHTML += '</ul>';
//             }
            
//             // Position du panneau
//             const cardPosition = $card.offset();
//             const cardWidth = $card.width();
//             const windowWidth = $(window).width();
//             const windowHeight = $(window).height();
            
//             // Déterminer si on doit afficher le panneau à gauche ou à droite
//             let panelPosition = 'right';
//             if (cardPosition.left + cardWidth + 400 > windowWidth) {
//                 panelPosition = 'left';
//             }
            
//             // Construire la section meta-info en fonction des valeurs
//             let metaInfoHTML = '';
            
//             // Vérifier si la durée n'est pas "00:00" (ou 0h0m)
//             const isDurationValid = duration !== "00:00" && duration !== "0:0" && duration !== "0:00" && duration !== "00:0";
            
//             // Construire la partie meta-info
//             if (isDurationValid && coursesCount > 0) {
//                 // Les deux valeurs sont valides
//                 metaInfoHTML = `<div class="formation-meta-info">
//                     ${formatDuration(duration)} • ${coursesCount} cours
//                 </div>`;
//             } else if (isDurationValid) {
//                 // Seulement la durée est valide
//                 metaInfoHTML = `<div class="formation-meta-info">
//                     ${formatDuration(duration)}
//                 </div>`;
//             } else if (coursesCount > 0) {
//                 // Seulement le nombre de cours est valide
//                 metaInfoHTML = `<div class="formation-meta-info">
//                     ${coursesCount} cours
//                 </div>`;
//             }
            
//             // Construire le HTML du panneau avec les informations conditionnelles
//             let panelHTML = `
//                 <div class="panel-content">
//                     <h3>${title}</h3>
//                     ${metaInfoHTML}
//                     <div class="description rich-content" style="margin-bottom: 15px;">${descriptionHTML}</div>
//                     ${featuresHTML}
//                     <div style="margin-top: 15px;"></div>
//                     <button class="btn-add-to-cart">Ajouter au panier</button>
//                 </div>
//             `;
            
//             // Positionner et afficher le panneau
//             const $panel = $('#formation-detail-panel');
//             $panel.html(panelHTML);
            
//             // Rendre le panneau temporairement visible mais transparent pour calculer sa hauteur
//             $panel.css('opacity', 0).addClass('active');
            
//             // Calculer le décalage en fonction de la longueur du contenu
//             const panelHeight = $panel.outerHeight();
            
//             // Vérifier si le panneau dépasse du bas de la fenêtre
//             const panelBottom = cardPosition.top - 55 + panelHeight;
//             let fixedTopOffset = -55; // 55 pixels vers le haut
            
//             if (panelBottom > windowHeight + $(window).scrollTop()) {
//                 // Réajuster pour qu'il reste dans la fenêtre
//                 fixedTopOffset = windowHeight + $(window).scrollTop() - panelHeight - cardPosition.top - 20;
//             }
            
//             if (panelPosition === 'right') {
//                 $panel.css({
//                     'left': cardPosition.left + cardWidth + 10,
//                     'top': cardPosition.top + fixedTopOffset, 
//                     'opacity': 1
//                 });
//             } else {
//                 $panel.css({
//                     'left': cardPosition.left - 410,
//                     'top': cardPosition.top + fixedTopOffset, 
//                     'opacity': 1
//                 });
//             }
            
//             isOverCard = true;
//             clearTimeout(timeoutId);
//         });

//         // Quitter la carte de formation
//         $(document).on('mouseleave', '.formation-card', function(e) {
//             // Ne pas masquer le panneau si on quitte par le menu d'action
//             if ($(e.toElement || e.relatedTarget).closest('.prevent-detail-panel, .action-menu, .action-dots, .action-dropdown').length) {
//                 return;
//             }
            
//             console.log("Formation card left");
//             isOverCard = false;
            
//             // Délai avant de masquer le panneau
//             timeoutId = setTimeout(function() {
//                 if (!isOverPanel) {
//                     $('#formation-detail-panel').removeClass('active').css('opacity', 0);
//                 }
//             }, 300); // Délai de 300ms pour permettre le déplacement vers le panneau
//         });

//         // Entrer dans le panneau de détail
//         $(document).on('mouseenter', '#formation-detail-panel', function() {
//             console.log("Panel entered");
//             isOverPanel = true;
//             clearTimeout(timeoutId);
//         });

//         // Quitter le panneau de détail
//         $(document).on('mouseleave', '#formation-detail-panel', function() {
//             console.log("Panel left");
//             isOverPanel = false;
            
//             timeoutId = setTimeout(function() {
//                 if (!isOverCard) {
//                     $('#formation-detail-panel').removeClass('active').css('opacity', 0);
//                 }
//             }, 300);
//         });

//         // Ajouter des gestionnaires d'événements pour les menus d'action
//         $(document).on('mouseenter click', '.prevent-detail-panel, .action-menu, .action-dots, .action-dropdown, .action-item', function(e) {
//             e.stopPropagation();
//             // Masquer immédiatement le panneau de détail
//             $('#formation-detail-panel').removeClass('active').css('opacity', 0);
//             // Réinitialiser les variables d'état
//             isOverCard = false;
//             isOverPanel = false;
//             clearTimeout(timeoutId);
//         });

//         // Formatage de la durée pour l'affichage
//         function formatDuration(duration) {
//             if (!duration || duration === '00:00' || duration === '0:0' || duration === '0:00' || duration === '00:0') {
//                 return '0 heures';
//             }
            
//             const parts = duration.split(':');
//             if (parts.length !== 2) return '0 heures';
            
//             const hours = parseInt(parts[0]);
//             const minutes = parseInt(parts[1]);
            
//             if (hours === 0 && minutes === 0) {
//                 return '0 heures';
//             } else if (hours === 0) {
//                 return `${minutes} min`;
//             } else if (minutes === 0) {
//                 return `${hours} h`;
//             } else {
//                 return `${hours},${minutes} heures totales`;
//             }
//         }
//     });
//     // Ajouter cette fonction à votre code d'initialisation
//     function initActionMenus() {
//         // Fermer tous les menus déroulants lorsqu'on clique en dehors
//         document.addEventListener('click', function(e) {
//             if (!e.target.closest('.action-menu')) {
//                 document.querySelectorAll('.action-dropdown').forEach(dropdown => {
//                     dropdown.classList.remove('show');
//                 });
//             }
//         });
//         // Réattacher les gestionnaires après chaque mise à jour du DOM
//         attachActionIconHandlers();
//     }

