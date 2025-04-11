// // // document.addEventListener('DOMContentLoaded', function() {
// // //     // Cache pour stocker les résultats des requêtes
// // //     const formationsCache = {};

// // //     // Création de l'indicateur de chargement
// // //     const loadingIndicator = `
// // //         <div class="loading-overlay" style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.7); z-index:9999; text-align:center; padding-top:100px;">
// // //             <div class="spinner-border text-primary" role="status">
// // //                 <span class="sr-only">Chargement...</span>
// // //             </div>
// // //         </div>
// // //     `;
    
// // //     // Ajout de l'indicateur à chaque conteneur de carousel
// // //     document.querySelectorAll('.carousel-container').forEach(container => {
// // //         container.style.position = 'relative';
// // //         container.insertAdjacentHTML('beforeend', loadingIndicator);
// // //     });

// // //     // Gestionnaire d'événements pour les liens de catégorie
// // //     document.querySelectorAll('.category-link').forEach(link => {
// // //         link.addEventListener('click', function(e) {
// // //             e.preventDefault();
            
// // //             const categoryId = this.dataset.categoryId;
// // //             const categoryUrl = this.href;
            
// // //             // Vérifier si la catégorie est déjà active
// // //             if (this.closest('.category-item').classList.contains('active')) {
// // //                 return;
// // //             }
            
// // //             // Mettre à jour la classe active
// // //             document.querySelectorAll('.category-item').forEach(item => {
// // //                 item.classList.remove('active');
// // //             });
// // //             this.closest('.category-item').classList.add('active');
            
// // //             // Afficher l'indicateur de chargement
// // //             document.querySelectorAll('.loading-overlay').forEach(loader => {
// // //                 loader.style.display = 'block';
// // //             });
            
// // //             // Mettre à jour l'URL sans rafraîchir la page
// // //             history.pushState({}, '', categoryUrl);
            
// // //             // Vérifier le cache
// // //             if (formationsCache[categoryId]) {
// // //                 updateFormationsCarousels(formationsCache[categoryId]);
// // //                 hideLoaders();
// // //                 return;
// // //             }
            
// // //             // Requête AJAX
// // //             fetch(categoryUrl, {
// // //                 headers: {
// // //                     'X-Requested-With': 'XMLHttpRequest',
// // //                     'Accept': 'application/json'
// // //                 }
// // //             })
// // //             .then(response => response.json())
// // //             .then(data => {
// // //                 formationsCache[categoryId] = data.formations;
// // //                 updateFormationsCarousels(data.formations);
// // //             })
// // //             .catch(error => {
// // //                 console.error('Erreur lors du chargement des formations:', error);
// // //             })
// // //             .finally(() => {
// // //                 hideLoaders();
// // //             });
// // //         });
// // //     });
    
// // //     function hideLoaders() {
// // //         document.querySelectorAll('.loading-overlay').forEach(loader => {
// // //             loader.style.display = 'none';
// // //         });
// // //     }
    
   
// // //     function updateFormationsCarousels(formations) {
// // //         const allFormations = [];
// // //         const publishedFormations = [];
// // //         const unpublishedFormations = [];
        
// // //         formations.forEach(formation => {
// // //             const formationCard = createFormationCard(formation);
// // //             allFormations.push(formationCard);
            
// // //             if (formation.status) {
// // //                 publishedFormations.push(formationCard);
// // //             } else {
// // //                 unpublishedFormations.push(formationCard);
// // //             }
// // //         });
        
// // //         updateSingleCarousel('.formations-carousel', allFormations);
// // //         updateSingleCarousel('.formations-carousel-published', publishedFormations);
// // //         updateSingleCarousel('.formations-carousel-unpublished', unpublishedFormations);
        
// // //         attachActionIconHandlers();
        
// // //         // Activer systématiquement l'onglet "Tous" après le changement de catégorie
// // //         const tousTab = document.querySelector('#top-home-tab');
// // //         if (tousTab) {
// // //             // Mettre à jour l'état actif des onglets
// // //             document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
// // //                 tab.classList.remove('active');
// // //                 tab.setAttribute('aria-selected', 'false');
// // //             });
// // //             tousTab.classList.add('active');
// // //             tousTab.setAttribute('aria-selected', 'true');
            
// // //             // Afficher le contenu de l'onglet "Tous"
// // //             document.querySelectorAll('.tab-pane').forEach(pane => {
// // //                 pane.classList.remove('show', 'active');
// // //             });
// // //             document.querySelector('#top-home').classList.add('show', 'active');
            
// // //             // Rafraîchir le carousel visible
// // //             const visibleCarousel = document.querySelector('#top-home .slick-initialized');
// // //             if (visibleCarousel) {
// // //                 $(visibleCarousel).slick('refresh');
// // //             }
// // //         }
// // //     }
// // //     function updateSingleCarousel(selector, items) {
// // //         const carousel = document.querySelector(selector);
        
// // //         // Détruire le carousel Slick s'il existe
// // //         if (carousel.classList.contains('slick-initialized')) {
// // //             $(carousel).slick('unslick');
// // //         }
        
// // //         // Vider le carousel
// // //         carousel.innerHTML = '';
        
// // //         // Ajouter les nouveaux éléments
// // //         items.forEach(item => {
// // //             carousel.appendChild(item);
// // //         });
        
// // //         // Réinitialiser le carousel si nécessaire
// // //         if (items.length > 0) {
// // //             $(carousel).slick({
// // //                 dots: false,
// // //                 infinite: true,
// // //                 speed: 300,
// // //                 slidesToShow: 4,
// // //                 slidesToScroll: 1,
// // //                 lazyLoad: 'ondemand',
// // //                 waitForAnimate: false,
// // //                 arrows: true,
// // //                 prevArrow: '<button type="button" class="slick-prev">Précédent</button>',
// // //                 nextArrow: '<button type="button" class="slick-next">Suivant</button>',
// // //                 responsive: [
// // //                     {
// // //                         breakpoint: 1024,
// // //                         settings: {
// // //                             slidesToShow: 3,
// // //                             slidesToScroll: 1
// // //                         }
// // //                     },
// // //                     {
// // //                         breakpoint: 768,
// // //                         settings: {
// // //                             slidesToShow: 2,
// // //                             slidesToScroll: 1
// // //                         }
// // //                     },
// // //                     {
// // //                         breakpoint: 480,
// // //                         settings: {
// // //                             slidesToShow: 1,
// // //                             slidesToScroll: 1
// // //                         }
// // //                     }
// // //                 ]
// // //             });
// // //         } else {
// // //             carousel.innerHTML = '<div class="no-formations">Aucune formation trouvée dans cette catégorie.</div>';
// // //         }
// // //     }
// // //     function createFormationCard(formation) {
// // //         const card = document.createElement('div');
// // //     card.className = 'formation-card-container';
    
// // //     let html = `
// // //         <div class="formation-card">
// // //             ${formation.status && formation.is_bestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : ''}
            
// // //             ${formation.image 
// // //                 ? `<img src="${window.location.origin}/storage/${formation.image}" alt="${formation.title}">`
// // //                 : '<div class="placeholder-image">Image de formation</div>'
// // //             }
            
// // //             <h4 class="formation-title">${formation.title}</h4>
// // //             <div class="formation-instructor">
// // //                 ${formation.user 
// // //                     ? `${formation.user.name} ${formation.user.lastname || ''}`
// // //                     : 'Professeur non défini'
// // //                 }
// // //             </div>
            
// // //             <!-- Suppression de l'affichage direct de la description -->
// // //             <div class="formation-description" style="display:none;">
// // //                 ${formation.description || 'Aucune description disponible'}
// // //             </div>
            
// // //                 <div class="formation-rating-price">
// // //                     <div class="formation-rating">
// // //          `;
        
// // //         if (formation.average_rating !== null && formation.total_feedbacks > 0) {
// // //             const rating = formation.average_rating;
// // //             const fullStars = Math.floor(rating);
// // //             const decimalPart = rating - fullStars;
// // //             const hasHalfStar = decimalPart >= 0.25;
            
// // //             let starsHtml = '';
// // //             for (let i = 1; i <= 5; i++) {
// // //                 if (i <= fullStars) {
// // //                     starsHtml += '<i class="fas fa-star"></i>';
// // //                 } else if (i === fullStars + 1 && hasHalfStar) {
// // //                     starsHtml += '<i class="fas fa-star-half-alt"></i>';
// // //                 } else {
// // //                     starsHtml += '<i class="far fa-star"></i>';
// // //                 }
// // //             }
            
// // //             html += `
// // //                 <span class="rating-value">${parseFloat(rating).toFixed(1)}</span>
// // //                 <span class="rating-stars">${starsHtml}</span>
// // //                 <span class="rating-count">(${formation.total_feedbacks})</span>
// // //             `;
// // //         }
        
// // //         html += `
// // //                     </div>
// // //                     <div class="price-container">
// // //                         ${formation.discount > 0 
// // //                             ? `<div style="display: flex; align-items: center;">
// // //                                 <span class="original-price">${parseFloat(formation.price).toFixed(3)} DT</span>
// // //                                 <span class="discount-badge">-${formation.discount}%</span>
// // //                                </div>
// // //                                <span class="final-price">${parseFloat(formation.final_price).toFixed(3)} DT</span>`
// // //                             : `<span class="final-price">${parseFloat(formation.price).toFixed(3)} DT</span>`
// // //                         }
// // //                     </div>
// // //                 </div>
                
// // //                 <div class="action-icons">
// // //                     <i class="icofont icofont-ui-edit edit-icon action-icon" data-edit-url="${window.location.origin}/formation/${formation.id}/edit"></i>
// // //                     <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="${window.location.origin}/formationdestroy/${formation.id}"></i>
// // //                 </div>
// // //             </div>
// // //         `;
       
        
// // //         card.innerHTML = html;
// // //         return card;
// // //     }

    
// // //     function attachActionIconHandlers() {
// // //         // Gestionnaire pour les icônes d'édition
// // //         document.querySelectorAll('.edit-icon').forEach(icon => {
// // //             icon.addEventListener('click', function() {
// // //                 window.location.href = this.dataset.editUrl;
// // //             });
// // //         });
        
// // //         // Gestionnaire pour les icônes de suppression
// // //         document.querySelectorAll('.delete-icon').forEach(icon => {
// // //             icon.addEventListener('click', function() {
// // //                 if (confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')) {
// // //                     const deleteUrl = this.dataset.deleteUrl;
// // //                     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    
// // //                     fetch(deleteUrl, {
// // //                         method: 'DELETE',
// // //                         headers: {
// // //                             'X-CSRF-TOKEN': csrfToken,
// // //                             'Content-Type': 'application/json',
// // //                             'Accept': 'application/json'
// // //                         }
// // //                     })
// // //                     .then(response => {
// // //                         if (response.ok) {
// // //                             window.location.reload();
// // //                         } else {
// // //                             console.error('Erreur lors de la suppression');
// // //                         }
// // //                     })
// // //                     .catch(error => {
// // //                         console.error('Erreur:', error);
// // //                     });
// // //                 }
// // //             });
// // //         });
// // //     }
    
// // //     // Gestion des onglets
// // //     document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
// // //         tab.addEventListener('click', function(e) {
// // //             e.preventDefault();
            
// // //             const tabId = this.getAttribute('href');
// // //             document.querySelectorAll('.tab-pane').forEach(pane => {
// // //                 pane.classList.remove('show', 'active');
// // //             });
// // //             document.querySelector(tabId).classList.add('show', 'active');
            
// // //             // Rafraîchir le carousel visible
// // //             const visibleCarousel = document.querySelector(`${tabId} .slick-initialized`);
// // //             if (visibleCarousel) {
// // //                 $(visibleCarousel).slick('refresh');
// // //             }
// // //         });
// // //     });
    
// // //     // Précharger la première catégorie
// // //     const firstCategoryLink = document.querySelector('.category-link');
// // //     if (firstCategoryLink) {
// // //         const firstCategoryId = firstCategoryLink.dataset.categoryId;
// // //         const firstCategoryUrl = firstCategoryLink.href;
        
// // //         fetch(firstCategoryUrl, {
// // //             headers: {
// // //                 'X-Requested-With': 'XMLHttpRequest',
// // //                 'Accept': 'application/json'
// // //             }
// // //         })
// // //         .then(response => response.json())
// // //         .then(data => {
// // //             formationsCache[firstCategoryId] = data.formations;
// // //         })
// // //         .catch(error => {
// // //             console.error('Erreur lors du préchargement:', error);
// // //         });
// // //     }
// // // });

// // document.addEventListener('DOMContentLoaded', function() {
// //     // Cache pour stocker les résultats des requêtes
// //     const formationsCache = {};
    
// //     // Création de l'indicateur de chargement
// //     const loadingIndicator = `
// //         <div class="loading-overlay" style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.7); z-index:9999; text-align:center; padding-top:100px;">
// //             <div class="spinner-border text-primary" role="status">
// //                 <span class="sr-only">Chargement...</span>
// //             </div>
// //         </div>
// //     `;
    
// //     // Ajout de l'indicateur à chaque conteneur de carousel
// //     document.querySelectorAll('.carousel-container').forEach(container => {
// //         container.style.position = 'relative';
// //         container.insertAdjacentHTML('beforeend', loadingIndicator);
// //     });

// //     attachActionIconHandlers();


// //     // Gestion de la navigation des catégories (slider)
// //     const categoriesSlider = document.querySelector('.categories-slider');
// //     const nextButton = document.querySelector('.next-button');
// //     const prevButton = document.querySelector('.prev-button');
    
// //     if (categoriesSlider && nextButton && prevButton) {
// //         // Navigation de la barre de catégories
// //         nextButton.addEventListener('click', function() {
// //             const scrollDistance = Math.min(categoriesSlider.clientWidth * 0.8, 500);
// //             categoriesSlider.scrollBy({
// //                 left: scrollDistance,
// //                 behavior: 'smooth'
// //             });
// //         });
        
// //         prevButton.addEventListener('click', function() {
// //             const scrollDistance = Math.min(categoriesSlider.clientWidth * 0.8, 500);
// //             categoriesSlider.scrollBy({
// //                 left: -scrollDistance,
// //                 behavior: 'smooth'
// //             });
// //         });
        
// //         function updateNavButtons() {
// //             if (categoriesSlider.scrollLeft + categoriesSlider.clientWidth >= categoriesSlider.scrollWidth - 10) {
// //                 nextButton.style.display = 'none';
// //             } else {
// //                 nextButton.style.display = 'flex';
// //             }
            
// //             if (categoriesSlider.scrollLeft <= 10) {
// //                 prevButton.style.display = 'none';
// //             } else {
// //                 prevButton.style.display = 'flex';
// //             }
            
// //             if (categoriesSlider.scrollWidth <= categoriesSlider.clientWidth) {
// //                 nextButton.style.display = 'none';
// //                 prevButton.style.display = 'none';
// //             }
// //         }
        
// //         categoriesSlider.addEventListener('scroll', updateNavButtons);
// //         window.addEventListener('resize', updateNavButtons);
// //         updateNavButtons();
// //     }

// //     // Gestionnaire d'événements pour les liens de catégorie
// //     function handleCategoryClick(e) {
// //         e.preventDefault();
        
// //         const categoryId = this.dataset.categoryId;
// //         const categoryUrl = this.href;
        
// //         // Vérifier si la catégorie est déjà active
// //         if (this.closest('.category-item').classList.contains('active')) {
// //             return;
// //         }
        
// //         // Mettre à jour la classe active
// //         document.querySelectorAll('.category-item').forEach(item => {
// //             item.classList.remove('active');
// //         });
// //         this.closest('.category-item').classList.add('active');
        
// //         // Afficher l'indicateur de chargement
// //         document.querySelectorAll('.loading-overlay').forEach(loader => {
// //             loader.style.display = 'block';
// //         });
        
// //         // Mettre à jour l'URL sans rafraîchir la page
// //         history.pushState({}, '', categoryUrl);
        
// //         // Vérifier le cache
// //         if (formationsCache[categoryId]) {
// //             updateFormationsCarousels(formationsCache[categoryId]);
// //             hideLoaders();
// //             return;
// //         }
        
// //         // Requête AJAX
// //         fetch(categoryUrl, {
// //             headers: {
// //                 'X-Requested-With': 'XMLHttpRequest',
// //                 'Accept': 'application/json'
// //             }
// //         })
// //         .then(response => response.json())
// //         .then(data => {
// //             formationsCache[categoryId] = data.formations;
// //             updateFormationsCarousels(data.formations);
// //         })
// //         .catch(error => {
// //             console.error('Erreur lors du chargement des formations:', error);
// //         })
// //         .finally(() => {
// //             hideLoaders();
// //         });
// //     }

// //     // Attacher les gestionnaires d'événements aux liens de catégorie
// //     document.querySelectorAll('.category-link').forEach(link => {
// //         link.addEventListener('click', handleCategoryClick);
// //     });
    
// //     function hideLoaders() {
// //         document.querySelectorAll('.loading-overlay').forEach(loader => {
// //             loader.style.display = 'none';
// //         });
// //     }
    
// //     function updateFormationsCarousels(formations) {
// //         const allFormations = [];
// //         const publishedFormations = [];
// //         const unpublishedFormations = [];
        
// //         formations.forEach(formation => {
// //             const formationCard = createFormationCard(formation);
// //             allFormations.push(formationCard);
            
// //             if (formation.status) {
// //                 publishedFormations.push(formationCard);
// //             } else {
// //                 unpublishedFormations.push(formationCard);
// //             }
// //         });
        
// //         updateSingleCarousel('.formations-carousel', allFormations);
// //         updateSingleCarousel('.formations-carousel-published', publishedFormations);
// //         updateSingleCarousel('.formations-carousel-unpublished', unpublishedFormations);
        
// //         attachActionIconHandlers();
        
// //         // Activer systématiquement l'onglet "Tous" après le changement de catégorie
// //         const tousTab = document.querySelector('#top-home-tab');
// //         if (tousTab) {
// //             // Mettre à jour l'état actif des onglets
// //             document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
// //                 tab.classList.remove('active');
// //                 tab.setAttribute('aria-selected', 'false');
// //             });
// //             tousTab.classList.add('active');
// //             tousTab.setAttribute('aria-selected', 'true');
            
// //             // Afficher le contenu de l'onglet "Tous"
// //             document.querySelectorAll('.tab-pane').forEach(pane => {
// //                 pane.classList.remove('show', 'active');
// //             });
// //             document.querySelector('#top-home').classList.add('show', 'active');
            
// //             // Rafraîchir le carousel visible
// //             const visibleCarousel = document.querySelector('#top-home .slick-initialized');
// //             if (visibleCarousel) {
// //                 $(visibleCarousel).slick('refresh');
// //             }
// //         }
// //     }
    
// //     function updateSingleCarousel(selector, items) {
// //         const carousel = document.querySelector(selector);
// //         if (!carousel) return;
        
// //         // Détruire le carousel Slick s'il existe
// //         if (carousel.classList.contains('slick-initialized')) {
// //             $(carousel).slick('unslick');
// //         }
        
// //         // Vider le carousel
// //         carousel.innerHTML = '';
        
// //         // Ajouter les nouveaux éléments
// //         items.forEach(item => {
// //             carousel.appendChild(item);
// //         });
        
// //         // Réinitialiser le carousel si nécessaire
// //         if (items.length > 0) {
// //             $(carousel).slick({
// //                 dots: false,
// //                 infinite: true,
// //                 speed: 300,
// //                 slidesToShow: 4,
// //                 slidesToScroll: 1,
// //                 lazyLoad: 'ondemand',
// //                 waitForAnimate: false,
// //                 arrows: true,
// //                 prevArrow: '<button type="button" class="slick-prev">Précédent</button>',
// //                 nextArrow: '<button type="button" class="slick-next">Suivant</button>',
// //                 responsive: [
// //                     {
// //                         breakpoint: 1024,
// //                         settings: {
// //                             slidesToShow: 3,
// //                             slidesToScroll: 1
// //                         }
// //                     },
// //                     {
// //                         breakpoint: 768,
// //                         settings: {
// //                             slidesToShow: 2,
// //                             slidesToScroll: 1
// //                         }
// //                     },
// //                     {
// //                         breakpoint: 480,
// //                         settings: {
// //                             slidesToShow: 1,
// //                             slidesToScroll: 1
// //                         }
// //                     }
// //                 ]
// //             });
// //         } else {
// //             carousel.innerHTML = '<div class="no-formations">Aucune formation trouvée dans cette catégorie.</div>';
// //         }
// //     }
    
// //     function createFormationCard(formation) {
// //         const card = document.createElement('div');
// //         card.className = 'formation-card-container';
        
// //         let html = `
// //             <div class="formation-card">
// //                 ${formation.status && formation.is_bestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : ''}
                
// //                 ${formation.image 
// //                     ? `<img src="${window.location.origin}/storage/${formation.image}" alt="${formation.title}">`
// //                     : '<div class="placeholder-image">Image de formation</div>'
// //                 }
                
// //                 <h4 class="formation-title">${formation.title}</h4>
// //                 <div class="formation-instructor">
// //                     ${formation.user 
// //                         ? `${formation.user.name} ${formation.user.lastname || ''}`
// //                         : 'Professeur non défini'
// //                     }
// //                 </div>
                
// //                 <!-- Suppression de l'affichage direct de la description -->
// //                 <div class="formation-description" style="display:none;">
// //                     ${formation.description || 'Aucune description disponible'}
// //                 </div>
                
// //                 <div class="formation-rating-price">
// //                     <div class="formation-rating">
// //         `;
        
// //         if (formation.average_rating !== null && formation.total_feedbacks > 0) {
// //             const rating = formation.average_rating;
// //             const fullStars = Math.floor(rating);
// //             const decimalPart = rating - fullStars;
// //             const hasHalfStar = decimalPart >= 0.25;
            
// //             let starsHtml = '';
// //             for (let i = 1; i <= 5; i++) {
// //                 if (i <= fullStars) {
// //                     starsHtml += '<i class="fas fa-star"></i>';
// //                 } else if (i === fullStars + 1 && hasHalfStar) {
// //                     starsHtml += '<i class="fas fa-star-half-alt"></i>';
// //                 } else {
// //                     starsHtml += '<i class="far fa-star"></i>';
// //                 }
// //             }
            
// //             html += `
// //                 <span class="rating-value">${parseFloat(rating).toFixed(1)}</span>
// //                 <span class="rating-stars">${starsHtml}</span>
// //                 <span class="rating-count">(${formation.total_feedbacks})</span>
// //             `;
// //         }
        
// //         html += `
// //                     </div>
// //                     <div class="price-container">
// //                         ${formation.discount > 0 
// //                             ? `<div style="display: flex; align-items: center;">
// //                                 <span class="original-price">${parseFloat(formation.price).toFixed(3)} DT</span>
// //                                 <span class="discount-badge">-${formation.discount}%</span>
// //                                </div>
// //                                <span class="final-price">${parseFloat(formation.final_price).toFixed(3)} DT</span>`
// //                             : `<span class="final-price">${parseFloat(formation.price).toFixed(3)} DT</span>`
// //                         }
// //                     </div>
// //                 </div>
                
            
// //                 <div class="action-icons">
// //                      <i class="icofont icofont-ui-edit edit-icon action-icon" data-edit-url="${window.location.origin}/formation/${formation.id}/edit"></i>
// //                      <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="${window.location.origin}/formationdestroy/${formation.id}"></i>
// //                  </div>
// //             </div>
// //         `;
        
// //         card.innerHTML = html;
// //         return card;
// //     }
    
// //     function attachActionIconHandlers() {
// //         // Gestionnaire pour les icônes d'édition
// //         document.querySelectorAll('.edit-icon').forEach(icon => {
// //             icon.addEventListener('click', function() {
// //                 window.location.href = this.dataset.editUrl;
// //             });
// //         });
        
// //         // Gestionnaire pour les icônes de suppression
// //         document.querySelectorAll('.delete-icon').forEach(icon => {
// //             icon.addEventListener('click', function() {
// //                 if (confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')) {
// //                     const deleteUrl = this.dataset.deleteUrl;
// //                     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    
// //                     fetch(deleteUrl, {
// //                         method: 'DELETE',
// //                         headers: {
// //                             'X-CSRF-TOKEN': csrfToken,
// //                             'Content-Type': 'application/json',
// //                             'Accept': 'application/json'
// //                         }
// //                     })
// //                     .then(response => {
// //                         if (response.ok) {
// //                             window.location.reload();
// //                         } else {
// //                             console.error('Erreur lors de la suppression');
// //                         }
// //                     })
// //                     .catch(error => {
// //                         console.error('Erreur:', error);
// //                     });
// //                 }
// //             });
// //         });
// //     }
    
// //     // Gestion des onglets
// //     document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
// //         tab.addEventListener('click', function(e) {
// //             e.preventDefault();
            
// //             const tabId = this.getAttribute('href');
// //             document.querySelectorAll('.tab-pane').forEach(pane => {
// //                 pane.classList.remove('show', 'active');
// //             });
// //             document.querySelector(tabId).classList.add('show', 'active');
            
// //             // Rafraîchir le carousel visible
// //             const visibleCarousel = document.querySelector(`${tabId} .slick-initialized`);
// //             if (visibleCarousel) {
// //                 $(visibleCarousel).slick('refresh');
// //             }
// //         });
// //     });

// //     // Initialisation automatique de la première catégorie au chargement
// //     function initializeFirstCategory() {
// //         const firstCategory = document.querySelector('.category-link');
// //         if (firstCategory) {
// //             // Définir cette catégorie comme active
// //             firstCategory.closest('.category-item').classList.add('active');
            
// //             // Récupérer les données de cette catégorie
// //             const categoryId = firstCategory.dataset.categoryId;
// //             const categoryUrl = firstCategory.href;
            
// //             // Afficher l'indicateur de chargement
// //             document.querySelectorAll('.loading-overlay').forEach(loader => {
// //                 loader.style.display = 'block';
// //             });
            
// //             // Mettre à jour l'URL sans rafraîchir la page
// //             history.pushState({}, '', categoryUrl);
            
// //             // Requête AJAX pour récupérer les formations
// //             fetch(categoryUrl, {
// //                 headers: {
// //                     'X-Requested-With': 'XMLHttpRequest',
// //                     'Accept': 'application/json'
// //                 }
// //             })
// //             .then(response => response.json())
// //             .then(data => {
// //                 formationsCache[categoryId] = data.formations;
// //                 updateFormationsCarousels(data.formations);
// //             })
// //             .catch(error => {
// //                 console.error('Erreur lors du chargement initial des formations:', error);
// //             })
// //             .finally(() => {
// //                 hideLoaders();
// //             });
// //         }
// //     }
    
// //     // Déclencher l'initialisation après le chargement des éléments DOM
// //     setTimeout(initializeFirstCategory, 100);
// // });

// // // Initialiser les carrousels de formation avec jQuery
// // $(document).ready(function() {
// //     // Gestion des messages flash
// //     ['success-message', 'delete-message', 'create-message'].forEach(id => {
// //         const message = document.getElementById(id);
// //         if (message) {
// //             message.style.opacity = 1;
// //             setTimeout(() => {
// //                 message.style.opacity = 0;
// //             }, 2000);
// //         }
// //     });
    
// //     function initCarousel(carouselClass) {
// //         // Initialiser seulement si le carousel n'est pas déjà initialisé
// //         if (!$(carouselClass).hasClass('slick-initialized')) {
// //             $(carouselClass).slick({
// //                 dots: false,
// //                 infinite: false,
// //                 speed: 600,
// //                 slidesToShow: 3,
// //                 slidesToScroll: 3,
// //                 prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
// //                 nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
// //                 centerPadding: '0px',
// //                 centerMode: false,
// //                 cssEase: 'ease-in-out',

// //                 responsive: [
// //                     {
// //                         breakpoint: 2200,
// //                         settings: {
// //                             slidesToShow: 4,
// //                             slidesToScroll: 4
// //                         }
// //                     },
// //                     {
// //                         breakpoint: 1800,
// //                         settings: {
// //                             slidesToShow: 3,
// //                             slidesToScroll: 3
// //                         }
// //                     },
// //                     {
// //                         breakpoint: 1400,
// //                         settings: {
// //                             slidesToShow: 2,
// //                             slidesToScroll: 2
// //                         }
// //                     },
// //                     {
// //                         breakpoint: 1024,
// //                         settings: {
// //                             slidesToShow: 1,
// //                             slidesToScroll: 1
// //                         }
// //                     }
// //                 ]
// //             });
// //         }
    
// //         // Gérer les flèches manuellement
// //         const $carousel = $(carouselClass);
        
// //         // Fonction pour mettre à jour les flèches
// //         function updateArrows() {
// //             const slick = $carousel.slick('getSlick');
// //             const currentSlide = $carousel.slick('slickCurrentSlide');
            
// //             // Cacher la flèche gauche sur le premier slide
// //             if (currentSlide === 0) {
// //                 $carousel.find('.slick-prev').css('opacity', '0').css('pointer-events', 'none');
// //             } else {
// //                 $carousel.find('.slick-prev').css('opacity', '1').css('pointer-events', 'auto');
// //             }
            
// //             // Cacher la flèche droite sur le dernier slide
// //             if (currentSlide >= slick.slideCount - slick.options.slidesToShow) {
// //                 $carousel.find('.slick-next').css('opacity', '0').css('pointer-events', 'none');
// //             } else {
// //                 $carousel.find('.slick-next').css('opacity', '1').css('pointer-events', 'auto');
// //             }
// //         }
        
// //         // Appliquer les états initiaux
// //         updateArrows();
        
// //         // Mettre à jour lors du changement de slide
// //         $carousel.on('afterChange', function() {
// //             updateArrows();
// //         });
// //     }
    
// //     // Gestion des onglets avec Bootstrap
// //     $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
// //         const target = $(e.target).attr("href");
        
// //         if (target === "#top-contact" && !$('.formations-carousel-published').hasClass('slick-initialized')) {
// //             initCarousel('.formations-carousel-published');
// //         } else if (target === "#top-profile" && !$('.formations-carousel-unpublished').hasClass('slick-initialized')) {
// //             initCarousel('.formations-carousel-unpublished');
// //         }
// //     });
    
// //     $(window).on('resize', function() {
// //         $('.slick-initialized').each(function() {
// //             $(this).slick('resize');
// //             updateCarouselArrows($(this));
// //         });
// //     });
    
// //     function updateCarouselArrows($carousel) {
// //         const currentSlide = $carousel.slick('slickCurrentSlide');
// //         const slick = $carousel.slick('getSlick');
        
// //         if (currentSlide === 0) {
// //             $carousel.find('.slick-prev').css('opacity', '0').css('pointer-events', 'none');
// //         } else {
// //             $carousel.find('.slick-prev').css('opacity', '1').css('pointer-events', 'auto');
// //         }
        
// //         if (currentSlide >= slick.slideCount - slick.options.slidesToShow) {
// //             $carousel.find('.slick-next').css('opacity', '0').css('pointer-events', 'none');
// //         } else {
// //             $carousel.find('.slick-next').css('opacity', '1').css('pointer-events', 'auto');
// //         }
// //     }
// // });

// document.addEventListener('DOMContentLoaded', function() {
//     // Cache pour stocker les résultats des requêtes
//     const formationsCache = {};
    
//     // Création de l'indicateur de chargement
//     const loadingIndicator = `
//         <div class="loading-overlay" style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.7); z-index:9999; text-align:center; padding-top:100px;">
//             <div class="spinner-border text-primary" role="status">
//                 <span class="sr-only">Chargement...</span>
//             </div>
//         </div>
//     `;
    
//     // Ajout de l'indicateur à chaque conteneur de carousel
//     document.querySelectorAll('.carousel-container').forEach(container => {
//         container.style.position = 'relative';
//         container.insertAdjacentHTML('beforeend', loadingIndicator);
//     });

//     // Gestion de la navigation des catégories (slider)
//     const categoriesSlider = document.querySelector('.categories-slider');
//     const nextButton = document.querySelector('.next-button');
//     const prevButton = document.querySelector('.prev-button');
    
//     if (categoriesSlider && nextButton && prevButton) {
//         // Navigation de la barre de catégories
//         nextButton.addEventListener('click', function() {
//             const scrollDistance = Math.min(categoriesSlider.clientWidth * 0.8, 500);
//             categoriesSlider.scrollBy({
//                 left: scrollDistance,
//                 behavior: 'smooth'
//             });
//         });
        
//         prevButton.addEventListener('click', function() {
//             const scrollDistance = Math.min(categoriesSlider.clientWidth * 0.8, 500);
//             categoriesSlider.scrollBy({
//                 left: -scrollDistance,
//                 behavior: 'smooth'
//             });
//         });
        
//         function updateNavButtons() {
//             if (categoriesSlider.scrollLeft + categoriesSlider.clientWidth >= categoriesSlider.scrollWidth - 10) {
//                 nextButton.style.display = 'none';
//             } else {
//                 nextButton.style.display = 'flex';
//             }
            
//             if (categoriesSlider.scrollLeft <= 10) {
//                 prevButton.style.display = 'none';
//             } else {
//                 prevButton.style.display = 'flex';
//             }
            
//             if (categoriesSlider.scrollWidth <= categoriesSlider.clientWidth) {
//                 nextButton.style.display = 'none';
//                 prevButton.style.display = 'none';
//             }
//         }
        
//         categoriesSlider.addEventListener('scroll', updateNavButtons);
//         window.addEventListener('resize', updateNavButtons);
//         updateNavButtons();
//     }

//     // Gestionnaire d'événements pour les liens de catégorie
//     function handleCategoryClick(e) {
//         e.preventDefault();
        
//         const categoryId = this.dataset.categoryId;
//         const categoryUrl = this.href;
        
//         // Vérifier si la catégorie est déjà active
//         if (this.closest('.category-item').classList.contains('active')) {
//             return;
//         }
        
//         // Mettre à jour la classe active
//         document.querySelectorAll('.category-item').forEach(item => {
//             item.classList.remove('active');
//         });
//         this.closest('.category-item').classList.add('active');
        
//         // Afficher l'indicateur de chargement
//         document.querySelectorAll('.loading-overlay').forEach(loader => {
//             loader.style.display = 'block';
//         });
        
//         // Mettre à jour l'URL sans rafraîchir la page
//         history.pushState({}, '', categoryUrl);
        
//         // Vérifier le cache
//         if (formationsCache[categoryId]) {
//             updateFormationsCarousels(formationsCache[categoryId]);
//             hideLoaders();
//             return;
//         }
        
//         // Requête AJAX
//         fetch(categoryUrl, {
//             headers: {
//                 'X-Requested-With': 'XMLHttpRequest',
//                 'Accept': 'application/json'
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             formationsCache[categoryId] = data.formations;
//             updateFormationsCarousels(data.formations);
//         })
//         .catch(error => {
//             console.error('Erreur lors du chargement des formations:', error);
//         })
//         .finally(() => {
//             hideLoaders();
//         });
//     }

//     // Attacher les gestionnaires d'événements aux liens de catégorie
//     document.querySelectorAll('.category-link').forEach(link => {
//         link.addEventListener('click', handleCategoryClick);
//     });
    
//     function hideLoaders() {
//         document.querySelectorAll('.loading-overlay').forEach(loader => {
//             loader.style.display = 'none';
//         });
//     }
    
//     function updateFormationsCarousels(formations) {
//         const allFormations = [];
//         const publishedFormations = [];
//         const unpublishedFormations = [];
        
//         formations.forEach(formation => {
//             const formationCard = createFormationCard(formation);
//             allFormations.push(formationCard);
            
//             if (formation.status) {
//                 publishedFormations.push(formationCard);
//             } else {
//                 unpublishedFormations.push(formationCard);
//             }
//         });
        
//         updateSingleCarousel('.formations-carousel', allFormations);
//         updateSingleCarousel('.formations-carousel-published', publishedFormations);
//         updateSingleCarousel('.formations-carousel-unpublished', unpublishedFormations);
        
//         attachActionIconHandlers();
        
//         // Activer systématiquement l'onglet "Tous" après le changement de catégorie
//         const tousTab = document.querySelector('#top-home-tab');
//         if (tousTab) {
//             // Mettre à jour l'état actif des onglets
//             document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
//                 tab.classList.remove('active');
//                 tab.setAttribute('aria-selected', 'false');
//             });
//             tousTab.classList.add('active');
//             tousTab.setAttribute('aria-selected', 'true');
            
//             // Afficher le contenu de l'onglet "Tous"
//             document.querySelectorAll('.tab-pane').forEach(pane => {
//                 pane.classList.remove('show', 'active');
//             });
//             document.querySelector('#top-home').classList.add('show', 'active');
            
//             // Rafraîchir le carousel visible
//             const visibleCarousel = document.querySelector('#top-home .slick-initialized');
//             if (visibleCarousel) {
//                 $(visibleCarousel).slick('refresh');
//             }
//         }
//     }
    
//     function updateSingleCarousel(selector, items) {
//         const carousel = document.querySelector(selector);
//         if (!carousel) return;
        
//         // Détruire le carousel Slick s'il existe
//         if (carousel.classList.contains('slick-initialized')) {
//             $(carousel).slick('unslick');
//         }
        
//         // Vider le carousel
//         carousel.innerHTML = '';
        
//         // Ajouter les nouveaux éléments
//         items.forEach(item => {
//             carousel.appendChild(item);
//         });
        
//         // Réinitialiser le carousel si nécessaire
//         if (items.length > 0) {
//             $(carousel).slick({
//                 dots: false,
//                 infinite: true,
//                 speed: 300,
//                 slidesToShow: 4,
//                 slidesToScroll: 1,
//                 lazyLoad: 'ondemand',
//                 waitForAnimate: false,
//                 arrows: true,
//                 prevArrow: '<button type="button" class="slick-prev">Précédent</button>',
//                 nextArrow: '<button type="button" class="slick-next">Suivant</button>',
//                 responsive: [
//                     {
//                         breakpoint: 1024,
//                         settings: {
//                             slidesToShow: 3,
//                             slidesToScroll: 1
//                         }
//                     },
//                     {
//                         breakpoint: 768,
//                         settings: {
//                             slidesToShow: 2,
//                             slidesToScroll: 1
//                         }
//                     },
//                     {
//                         breakpoint: 480,
//                         settings: {
//                             slidesToShow: 1,
//                             slidesToScroll: 1
//                         }
//                     }
//                 ]
//             });
//         } else {
//             carousel.innerHTML = '<div class="no-formations">Aucune formation trouvée dans cette catégorie.</div>';
//         }
//     }
    
//     function createFormationCard(formation) {
//         const card = document.createElement('div');
//         card.className = 'formation-card-container';
        
//         let html = `
//             <div class="formation-card">
//                 ${formation.status && formation.is_bestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : ''}
                
//                 ${formation.image 
//                     ? `<img src="${window.location.origin}/storage/${formation.image}" alt="${formation.title}">`
//                     : '<div class="placeholder-image">Image de formation</div>'
//                 }
                
//                 <h4 class="formation-title">${formation.title}</h4>
//                 <div class="formation-instructor">
//                     ${formation.user 
//                         ? `${formation.user.name} ${formation.user.lastname || ''}`
//                         : 'Professeur non défini'
//                     }
//                 </div>
                
//                 <!-- Suppression de l'affichage direct de la description -->
//                 <div class="formation-description" style="display:none;">
//                     ${formation.description || 'Aucune description disponible'}
//                 </div>
                
//                 <div class="formation-rating-price">
//                     <div class="formation-rating">
//         `;
        
//         if (formation.average_rating !== null && formation.total_feedbacks > 0) {
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
//                 <span class="rating-value">${parseFloat(rating).toFixed(1)}</span>
//                 <span class="rating-stars">${starsHtml}</span>
//                 <span class="rating-count">(${formation.total_feedbacks})</span>
//             `;
//         }
        
//         html += `
//                     </div>
//                     <div class="price-container">
//                         ${formation.discount > 0 
//                             ? `<div style="display: flex; align-items: center;">
//                                 <span class="original-price">${parseFloat(formation.price).toFixed(3)} DT</span>
//                                 <span class="discount-badge">-${formation.discount}%</span>
//                                </div>
//                                <span class="final-price">${parseFloat(formation.final_price).toFixed(3)} DT</span>`
//                             : `<span class="final-price">${parseFloat(formation.price).toFixed(3)} DT</span>`
//                         }
//                     </div>
//                 </div>
                
            
//                 <div class="action-icons">
//                      <i class="icofont icofont-ui-edit edit-icon action-icon" data-edit-url="${window.location.origin}/formation/${formation.id}/edit"></i>
//                      <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="${window.location.origin}/formationdestroy/${formation.id}"></i>
//                  </div>
//             </div>
//         `;
        
//         card.innerHTML = html;
//         return card;
//     }
    
//     function attachActionIconHandlers() {
//         // Gestionnaire pour les icônes d'édition
//         document.querySelectorAll('.edit-icon').forEach(icon => {
//             icon.addEventListener('click', function() {
//                 window.location.href = this.dataset.editUrl;
//             });
//         });
        
//         // Gestionnaire pour les icônes de suppression
//         document.querySelectorAll('.delete-icon').forEach(icon => {
//             icon.addEventListener('click', function() {
//                 if (confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')) {
//                     const deleteUrl = this.dataset.deleteUrl;
//                     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    
//                     fetch(deleteUrl, {
//                         method: 'DELETE',
//                         headers: {
//                             'X-CSRF-TOKEN': csrfToken,
//                             'Content-Type': 'application/json',
//                             'Accept': 'application/json'
//                         }
//                     })
//                     .then(response => {
//                         if (response.ok) {
//                             window.location.reload();
//                         } else {
//                             console.error('Erreur lors de la suppression');
//                         }
//                     })
//                     .catch(error => {
//                         console.error('Erreur:', error);
//                     });
//                 }
//             });
//         });
//     }
    
//     // Attacher les gestionnaires d'événements pour les icônes d'action dès le chargement de la page
//     attachActionIconHandlers();
    
//     // Gestion des onglets
//     document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
//         tab.addEventListener('click', function(e) {
//             e.preventDefault();
            
//             const tabId = this.getAttribute('href');
//             document.querySelectorAll('.tab-pane').forEach(pane => {
//                 pane.classList.remove('show', 'active');
//             });
//             document.querySelector(tabId).classList.add('show', 'active');
            
//             // Rafraîchir le carousel visible
//             const visibleCarousel = document.querySelector(`${tabId} .slick-initialized`);
//             if (visibleCarousel) {
//                 $(visibleCarousel).slick('refresh');
//             }
//         });
//     });

//     // Initialisation automatique de la première catégorie au chargement
//     function initializeFirstCategory() {
//         // Supprimer toutes les classes 'active' d'abord
//         document.querySelectorAll('.category-item').forEach(item => {
//             item.classList.remove('active');
//         });
        
//         const firstCategory = document.querySelector('.category-link');
//         if (firstCategory) {
//             // Définir cette catégorie comme active
//             firstCategory.closest('.category-item').classList.add('active');
            
//             // Récupérer les données de cette catégorie
//             const categoryId = firstCategory.dataset.categoryId;
//             const categoryUrl = firstCategory.href;
            
//             // Afficher l'indicateur de chargement
//             document.querySelectorAll('.loading-overlay').forEach(loader => {
//                 loader.style.display = 'block';
//             });
            
//             // Mettre à jour l'URL sans rafraîchir la page
//             history.pushState({}, '', categoryUrl);
            
//             // Requête AJAX pour récupérer les formations
//             fetch(categoryUrl, {
//                 headers: {
//                     'X-Requested-With': 'XMLHttpRequest',
//                     'Accept': 'application/json'
//                 }
//             })
//             .then(response => response.json())
//             .then(data => {
//                 formationsCache[categoryId] = data.formations;
//                 updateFormationsCarousels(data.formations);
//             })
//             .catch(error => {
//                 console.error('Erreur lors du chargement initial des formations:', error);
//             })
//             .finally(() => {
//                 hideLoaders();
//             });
//         }
//     }
    
//     // Déclencher l'initialisation après le chargement des éléments DOM
//     setTimeout(initializeFirstCategory, 100);
// });

// // Initialiser les carrousels de formation avec jQuery
// $(document).ready(function() {
//     // Gestion des messages flash
//     ['success-message', 'delete-message', 'create-message'].forEach(id => {
//         const message = document.getElementById(id);
//         if (message) {
//             message.style.opacity = 1;
//             setTimeout(() => {
//                 message.style.opacity = 0;
//             }, 2000);
//         }
//     });
    
//     function initCarousel(carouselClass) {
//         // Initialiser seulement si le carousel n'est pas déjà initialisé
//         if (!$(carouselClass).hasClass('slick-initialized')) {
//             $(carouselClass).slick({
//                 dots: false,
//                 infinite: false,
//                 speed: 600,
//                 slidesToShow: 3,
//                 slidesToScroll: 3,
//                 prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
//                 nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
//                 centerPadding: '0px',
//                 centerMode: false,
//                 cssEase: 'ease-in-out',

//                 responsive: [
//                     {
//                         breakpoint: 2200,
//                         settings: {
//                             slidesToShow: 4,
//                             slidesToScroll: 4
//                         }
//                     },
//                     {
//                         breakpoint: 1800,
//                         settings: {
//                             slidesToShow: 3,
//                             slidesToScroll: 3
//                         }
//                     },
//                     {
//                         breakpoint: 1400,
//                         settings: {
//                             slidesToShow: 2,
//                             slidesToScroll: 2
//                         }
//                     },
//                     {
//                         breakpoint: 1024,
//                         settings: {
//                             slidesToShow: 1,
//                             slidesToScroll: 1
//                         }
//                     }
//                 ]
//             });
//         }
    
//         // Gérer les flèches manuellement
//         const $carousel = $(carouselClass);
        
//         // Fonction pour mettre à jour les flèches
//         function updateArrows() {
//             const slick = $carousel.slick('getSlick');
//             const currentSlide = $carousel.slick('slickCurrentSlide');
            
//             // Cacher la flèche gauche sur le premier slide
//             if (currentSlide === 0) {
//                 $carousel.find('.slick-prev').css('opacity', '0').css('pointer-events', 'none');
//             } else {
//                 $carousel.find('.slick-prev').css('opacity', '1').css('pointer-events', 'auto');
//             }
            
//             // Cacher la flèche droite sur le dernier slide
//             if (currentSlide >= slick.slideCount - slick.options.slidesToShow) {
//                 $carousel.find('.slick-next').css('opacity', '0').css('pointer-events', 'none');
//             } else {
//                 $carousel.find('.slick-next').css('opacity', '1').css('pointer-events', 'auto');
//             }
//         }
        
//         // Appliquer les états initiaux
//         updateArrows();
        
//         // Mettre à jour lors du changement de slide
//         $carousel.on('afterChange', function() {
//             updateArrows();
//         });
//     }
    
//     // Gestion des onglets avec Bootstrap
//     $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
//         const target = $(e.target).attr("href");
        
//         if (target === "#top-contact" && !$('.formations-carousel-published').hasClass('slick-initialized')) {
//             initCarousel('.formations-carousel-published');
//         } else if (target === "#top-profile" && !$('.formations-carousel-unpublished').hasClass('slick-initialized')) {
//             initCarousel('.formations-carousel-unpublished');
//         }
//     });
    
//     $(window).on('resize', function() {
//         $('.slick-initialized').each(function() {
//             $(this).slick('resize');
//             updateCarouselArrows($(this));
//         });
//     });
    
//     function updateCarouselArrows($carousel) {
//         const currentSlide = $carousel.slick('slickCurrentSlide');
//         const slick = $carousel.slick('getSlick');
        
//         if (currentSlide === 0) {
//             $carousel.find('.slick-prev').css('opacity', '0').css('pointer-events', 'none');
//         } else {
//             $carousel.find('.slick-prev').css('opacity', '1').css('pointer-events', 'auto');
//         }
        
//         if (currentSlide >= slick.slideCount - slick.options.slidesToShow) {
//             $carousel.find('.slick-next').css('opacity', '0').css('pointer-events', 'none');
//         } else {
//             $carousel.find('.slick-next').css('opacity', '1').css('pointer-events', 'auto');
//         }
//     }
// });