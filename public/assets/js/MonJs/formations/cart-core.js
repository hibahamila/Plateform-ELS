
// window.cartFormations = [];

// document.addEventListener('DOMContentLoaded', function() {
//     // Initialisation
//     initCartCore();
//     // Vérifier l'état du badge immédiatement
//     initCartBadge();
// });

// function initCartCore() {
//     setupAddToCartListeners();
//     updateCartButtons();
// }

// function setupAddToCartListeners() {
//     document.addEventListener('click', function(e) {
//         // Vérifier si on a cliqué sur un bouton d'ajout au panier
//         if (e.target.classList.contains('btn-add-to-cart') || 
//             e.target.closest('.btn-add-to-cart')) {
            
//             e.preventDefault();
            
//             // Masquer immédiatement le panneau de détail
//             $('#formation-detail-panel').removeClass('active').css('opacity', 0);
            
//             handleAddToCart(e);
//         }
        
//         if (e.target.classList.contains('add-related-btn')) {
//             e.preventDefault();
//             const formationId = e.target.getAttribute('data-id');
//             const formationCard = e.target.closest('.related-formation-card');
            
//             try {
//                 // Extraire les données de la formation associée
//                 const formationData = {
//                     id: formationId,
//                     title: formationCard.querySelector('.related-formation-title')?.textContent || 'Formation',
//                     instructor: formationCard.querySelector('.related-formation-instructor')?.textContent || 'Instructeur',
//                     image: formationCard.querySelector('.related-formation-image')?.src || '',
//                     price: formationCard.querySelector('.final-price')?.textContent || '0 DT',
//                     isBestseller: formationCard.querySelector('.badge-bestseller-small') !== null
//                 };    
                
//                 // Récupération sécurisée des éléments de notation
//                 const ratingElement = formationCard.querySelector('.related-formation-rating');
//                 if (ratingElement) {
//                     formationData.rating = ratingElement.querySelector('.rating-value')?.textContent || '0';
//                     formationData.ratingStars = ratingElement.querySelector('.rating-stars')?.innerHTML || '';
//                     formationData.ratingCount = ratingElement.querySelector('.rating-count')?.textContent || '(0)';
//                 } else {
//                     formationData.rating = '0';
//                     formationData.ratingStars = '';
//                     formationData.ratingCount = '(0)';
//                 }
                
//                 // Vérifier s'il y a une remise
//                 const originalPriceElement = formationCard.querySelector('.original-price');
//                 if (originalPriceElement) {
//                     formationData.hasDiscount = true;
//                     formationData.originalPrice = originalPriceElement.textContent;
//                     formationData.discountPercentage = formationCard.querySelector('.discount-percentage')?.textContent || '';
//                 } else {
//                     formationData.hasDiscount = false;
//                 }
                    
//                 // Ajouter au panier (appel API)
//                 addToCart(formationId);
                
//                 // Ajouter à la liste des formations dans la modale
//                 window.addFormationToCartDisplay(formationData);
                
//                 // Supprimer la formation de la section "Fréquemment achetés ensemble"
//                 formationCard.remove();
                
//                 // Afficher le toast de confirmation
//                 window.showConfirmationToast('Formation ajoutée au panier');
                
//                 console.log("Formation associée ajoutée avec succès:", formationId);
//             } catch (error) {
//                 console.error("Erreur lors de l'ajout de la formation associée:", error);
//             }
//         }
//     });
// }

// function handleAddToCart(e) {
//     // Déterminer d'où vient le clic (carte ou panneau)
//     const target = e.target.closest('.btn-add-to-cart');
//     if (!target) return;
    
//     let formationData;
//     const isFromPanel = target.closest('.panel-content') !== null;
    
//     if (isFromPanel) {
//         console.log("Ajout depuis le panneau de détail");
//         // Pour les clics depuis le panneau, récupérer les données depuis la carte survolée
//         const hoveredCard = document.querySelector('.formation-card:hover');
//         if (hoveredCard) {
//             formationData = extractFormationDataFromCard(hoveredCard);
//         } else {
//             // Récupérer certaines données du panneau et essayer de trouver la carte correspondante
//             const panelContent = target.closest('.panel-content');
//             const title = panelContent.querySelector('h3').textContent;
            
//             // Essayer de trouver la carte qui correspond au titre
//             const allCards = document.querySelectorAll('.formation-card');
//             const matchingCard = Array.from(allCards).find(card => 
//                 card.querySelector('.formation-title').textContent.trim() === title.trim()
//             );
            
//             if (matchingCard) {
//                 formationData = extractFormationDataFromCard(matchingCard);
//             } else {
//                 // Fallback avec des données limitées du panneau
//                 formationData = {
//                     id: '0',
//                     title: title,
//                     instructor: 'Instructeur',
//                     image: '',
//                     price: '0 DT',
//                     rating: '0',
//                     ratingStars: '',
//                     ratingCount: '(0)',
//                     isBestseller: false,
//                     hasDiscount: false,
//                     originalPrice: '',
//                     discountPercentage: '',
//                     category: ''
//                 };
//             }
//         }
//     } else {
//         console.log("Ajout depuis la carte de formation");
//         const formationCard = target.closest('.formation-card') || 
//                               target.closest('.formation-card-container')?.querySelector('.formation-card');
        
//         if (!formationCard) {
//             console.error("Impossible de trouver la carte de formation");
//             return;
//         }
        
//         formationData = extractFormationDataFromCard(formationCard);
//     }
//     console.log("Données de formation extraites:", formationData);
//     // Stocker la formation principale
//     window.cartFormations.unshift(formationData);
//     // Ajouter au panier (API call)
//     addToCart(formationData.id);
    
//     // Réinitialiser la zone d'affichage des formations dans la modale
//     document.getElementById('cart-added-formations').innerHTML = '';
//     const existingFormationIndex = window.cartFormations.findIndex(f => f.id === formationData.id);
//     if (existingFormationIndex === -1) {
//         window.cartFormations.unshift(formationData);
//     }
        
//     // Remplir les informations dans la modale
//     window.populateModal(formationData);
        
//     // Charger les formations associées de la même catégorie, en excluant la formation actuelle
//     window.loadRelatedFormations(formationData.category, formationData.id);
        
//     // Configurer les boutons d'action
//     window.setupActionButtons();
    
//     // Masquer le panneau de détail avant d'afficher la modal
//     $('#formation-detail-panel').removeClass('active').css('opacity', 0);
    
//     // Afficher la modale
//     document.getElementById('add-to-cart-modal').style.display = 'block';
// }

// function extractFormationDataFromCard(card) {
//     // Extraire le titre
//     const titleElement = card.querySelector('.formation-title');
//     const title = titleElement ? titleElement.textContent.trim() : 'Formation';
    
//     // Extraire l'instructeur
//     const instructorElement = card.querySelector('.formation-instructor');
//     const instructor = instructorElement ? instructorElement.textContent.trim() : 'Instructeur';
    
//     // Extraire l'image
//     let image = '';
//     const imgElement = card.querySelector('img');
//     if (imgElement && imgElement.src) {
//         image = imgElement.src;
//     }
    
//     // Extraire les informations de prix et remises
//     let finalPrice = '0 DT';
//     let hasDiscount = false;
//     let originalPrice = '';
//     let discountPercentage = '';
    
//     // Vérifier si nous avons un prix final
//     const finalPriceElement = card.querySelector('.final-price');
//     if (finalPriceElement) {
//         finalPrice = finalPriceElement.textContent.trim();
        
//         // Vérifier s'il y a une remise
//         const originalPriceElement = card.querySelector('.original-price');
//         if (originalPriceElement) {
//             hasDiscount = true;
//             originalPrice = originalPriceElement.textContent.trim();
            
//             // Chercher le pourcentage de remise s'il existe
//             const discountElement = card.querySelector('.discount-percentage');
//             if (discountElement) {
//                 discountPercentage = discountElement.textContent.trim();
//             } else {
//                 // Calculer le pourcentage si non disponible
//                 try {
//                     const finalPriceValue = parseFloat(finalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
//                     const originalPriceValue = parseFloat(originalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
                    
//                     if (originalPriceValue > 0) {
//                         const discount = ((originalPriceValue - finalPriceValue) / originalPriceValue) * 100;
//                         discountPercentage = `-${Math.round(discount)}%`;
//                     }
//                 } catch (e) {
//                     console.error("Erreur lors du calcul de la remise:", e);
//                 }
//             }
//         }
//     }
    
//     // Informations de notation
//     let rating = '0';
//     let ratingStars = '';
//     let ratingCount = '(0)';
    
//     const ratingValueElement = card.querySelector('.rating-value');
//     if (ratingValueElement) {
//         rating = ratingValueElement.textContent.trim();
        
//         const starsElement = card.querySelector('.rating-stars');
//         if (starsElement) {
//             ratingStars = starsElement.innerHTML;
//         } else {
//             ratingStars = window.generateStars(parseFloat(rating));
//         }
        
//         const countElement = card.querySelector('.rating-count');
//         if (countElement) {
//             ratingCount = countElement.textContent.trim();
//         }
//     }
//     const isBestseller = card.querySelector('.badge-bestseller') !== null;
    
//     // Essayer d'extraire l'ID de la formation
//     let formationId = '0';
    
//     // Méthode 1: Depuis un attribut data-id
//     if (card.hasAttribute('data-id')) {
//         formationId = card.getAttribute('data-id');
//     } 
//     // Méthode 2: Depuis les boutons d'action
//     else {
//         const actionElements = card.closest('.formation-card-container')?.querySelectorAll('.action-item');
//         if (actionElements && actionElements.length) {
//             for (const action of actionElements) {
//                 if (action.hasAttribute('data-delete-url')) {
//                     const url = action.getAttribute('data-delete-url');
//                     const matches = url.match(/\/formation\/(\d+)$/);
//                     if (matches && matches[1]) {
//                         formationId = matches[1];
//                         break;
//                     }
//                 } else if (action.hasAttribute('data-edit-url')) {
//                     const url = action.getAttribute('data-edit-url');
//                     const matches = url.match(/\/formation\/(\d+)\/edit$/);
//                     if (matches && matches[1]) {
//                         formationId = matches[1];
//                         break;
//                     }
//                 }
//             }
//         }
//     }

//     // Extraire la catégorie de la formation
//     let category = '';
//     // Rechercher d'abord dans les attributs data-
//     if (card.hasAttribute('data-category')) {
//         category = card.getAttribute('data-category');
//     } else {
//         // Essayer de trouver un élément contenant la catégorie
//         const categoryElement = card.querySelector('.formation-category');
//         if (categoryElement) {
//             category = categoryElement.textContent.trim();
//         } else {
//             // On peut aussi essayer de récupérer la catégorie depuis l'URL 
//             const currentPath = window.location.pathname;
//             const categoryMatch = currentPath.match(/\/category\/([^\/]+)/);
//             if (categoryMatch && categoryMatch[1]) {
//                 category = decodeURIComponent(categoryMatch[1]);
//             }
//         }
//     }
    
//     return {
//         id: formationId,
//         title: title,
//         instructor: instructor,
//         image: image,
//         price: finalPrice,
//         rating: rating,
//         ratingStars: ratingStars,
//         ratingCount: ratingCount,
//         isBestseller: isBestseller,
//         hasDiscount: hasDiscount,
//         originalPrice: originalPrice,
//         discountPercentage: discountPercentage,
//         category: category
//     };
// }

// function checkIfInCart(formationId, callback) {
//     fetch('/panier/check', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             formation_id: formationId
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (callback && typeof callback === 'function') {
//             callback(data.inCart || false);
//         }
//     })
//     .catch(error => {
//         console.error('Erreur lors de la vérification du panier:', error);
//         if (callback && typeof callback === 'function') {
//             callback(false);
//         }
//     });
// }

// function updateCartButtons() {
//     const cartButtons = document.querySelectorAll('.btn-add-to-cart');
    
//     cartButtons.forEach(button => {
//         const formationCard = button.closest('.formation-card') || 
//                              button.closest('.formation-card-container')?.querySelector('.formation-card');
                         
//         if (!formationCard) return;
        
//         const formationId = formationCard.getAttribute('data-id');
//         if (!formationId) return;
        
//         checkIfInCart(formationId, (inCart) => {
//             if (inCart) {
//                 button.innerHTML = '<i class="fas fa-shopping-cart"></i> Accéder au panier';
//                 button.classList.add('in-cart');
                
//                 // Changer l'action du bouton
//                 button.removeEventListener('click', handleAddToCart);
//                 button.addEventListener('click', function(e) {
//                     e.preventDefault();
//                     window.location.href = '/panier';
//                 });
//             } else {
//                 button.innerHTML = '<i class="fas fa-cart-plus"></i> Ajouter au panier';
//                 button.classList.remove('in-cart');
//             }
//         });
//     });
// }

// // ----- IMPLÉMENTATION AMÉLIORÉE POUR LE BADGE DU PANIER -----

// // Initialiser le badge du panier
// function initCartBadge() {
//     // Charger les styles CSS immédiatement
//     addCartStyles();
    
//     // Vérifier le localStorage en premier pour une réponse immédiate
//     const storedCount = parseInt(localStorage.getItem('cartCount') || '0');
//     if (storedCount > 0) {
//         updateCartBadge(storedCount);
//     }
    
//     // Puis vérifier avec le serveur pour s'assurer que c'est exact
//     fetchCartItemsCount();
    
//     // Configurer l'observateur de mutations
//     setupMutationObserver();
// }

// // NOUVELLE FONCTION: UpdateCartBadge simplifiée sans animation et sans recréation
// function updateCartBadge(count) {
//     const cartContainer = document.querySelector('.cart-container');
    
//     if (!cartContainer) {
//         console.error("Conteneur de panier introuvable");
//         return;
//     }
    
//     // Rechercher le badge existant
//     let cartBadge = document.querySelector('.cart-badge');
    
//     // Si le count est 0, supprimer le badge s'il existe
//     if (count <= 0) {
//         if (cartBadge) {
//             cartBadge.remove();
//         }
//         return;
//     }
    
//     // Si le badge existe déjà, simplement mettre à jour son contenu
//     if (cartBadge) {
//         // Mettre à jour le texte sans modifier l'élément
//         cartBadge.textContent = count.toString();
//     } else {
//         // Créer un nouveau badge si aucun n'existe
//         cartBadge = document.createElement('span');
//         cartBadge.className = 'cart-badge';
//         cartBadge.id = 'cart-badge';
//         cartBadge.textContent = count.toString();
        
//         // Appliquer les styles directement pour s'assurer qu'il est visible immédiatement
//         applyPermanentStyles(cartBadge);
        
//         // Ajouter le badge au conteneur
//         cartContainer.appendChild(cartBadge);
//     }
// }

// // Appliquer des styles permanents au badge
// function applyPermanentStyles(badge) {
//     badge.style.display = 'flex';
//     badge.style.visibility = 'visible';
//     badge.style.opacity = '1';
//     badge.style.position = 'absolute';
//     badge.style.top = '-10px';
//     badge.style.right = '-10px';
//     badge.style.backgroundColor = '#ff0000';
//     badge.style.color = 'white';
//     badge.style.borderRadius = '50%';
//     badge.style.minWidth = '18px';
//     badge.style.height = '18px';
//     badge.style.padding = '0 5px';
//     badge.style.fontSize = '12px';
//     badge.style.fontWeight = 'bold';
//     badge.style.alignItems = 'center';
//     badge.style.justifyContent = 'center';
//     badge.style.zIndex = '1000';
//     badge.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
//     badge.style.pointerEvents = 'none'; // Éviter que le badge interfère avec les clics
// }

// // Fonction améliorée pour mettre à jour le compteur depuis le serveur
// function fetchCartItemsCount() {
//     fetch('/panier/items-count', {
//         method: 'GET',
//         headers: {
//             'X-Requested-With': 'XMLHttpRequest',
//             'Accept': 'application/json'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         // Mettre à jour le localStorage avec la valeur exacte du serveur
//         localStorage.setItem('cartCount', data.count.toString());
        
//         // Mettre à jour le badge visuellement
//         updateCartBadge(data.count);
//     })
//     .catch(error => {
//         console.error('Erreur lors de la récupération du nombre d\'éléments du panier:', error);
//     });
// }

// // Configurer un observateur de mutations pour surveiller les changements dans le DOM
// function setupMutationObserver() {
//     // Créer un observateur qui surveille les changements dans le DOM
//     const observer = new MutationObserver((mutations) => {
//         for (const mutation of mutations) {
//             // Si des nœuds sont supprimés, vérifier si le badge est toujours présent
//             if (mutation.removedNodes.length > 0) {
//                 const badge = document.querySelector('.cart-badge');
//                 const cartCount = parseInt(localStorage.getItem('cartCount') || '0');
                
//                 // Si le badge devrait être visible mais ne l'est pas
//                 if (cartCount > 0 && !badge) {
//                     updateCartBadge(cartCount);
//                     break;
//                 }
//             }
//         }
//     });
    
//     // Observer le corps du document pour tout changement
//     observer.observe(document.body, { 
//         childList: true, 
//         subtree: true 
//     });
    
//     // Sauvegarder l'observateur pour pouvoir le déconnecter si nécessaire
//     window.cartBadgeObserver = observer;
// }

// // CORRECTION: Fonction pour ajouter une formation au panier avec mise à jour immédiate du badge
// function addToCart(formationId) {
//     // METTRE À JOUR IMMÉDIATEMENT le compteur LOCAL
//     const currentCount = parseInt(localStorage.getItem('cartCount') || '0');
//     const newCount = currentCount + 1;
    
//     // Mettre à jour le stockage local et le badge AVANT l'appel au serveur
//     localStorage.setItem('cartCount', newCount.toString());
//     updateCartBadge(newCount);
    
//     // Envoyer la requête au serveur
//     fetch('/panier/ajouter', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             formation_id: formationId
//         })
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Erreur lors de l\'ajout au panier');
//         }
//         return response.json();
//     })
//     .then(data => {
//         console.log('Formation ajoutée au panier avec succès:', formationId);
        
//         // Mettre à jour le badge avec le nombre exact fourni par le serveur
//         if (data.cartCount !== undefined) {
//             localStorage.setItem('cartCount', data.cartCount.toString());
//             updateCartBadge(data.cartCount);
//         }
        
//         // Gérer les formations associées dans l'interface
//         handleRelatedFormations(formationId);
        
//         // Afficher un message de confirmation
//         if (data.message) {
//             window.showConfirmationToast(data.message);
//         } else {
//             window.showConfirmationToast('Formation ajoutée au panier');
//         }
//     })
//     .catch(error => {
//         console.error('Erreur:', error);
//         // En cas d'erreur, revenir au compteur précédent
//         localStorage.setItem('cartCount', currentCount.toString());
//         updateCartBadge(currentCount);
//         window.showConfirmationToast('Erreur lors de l\'ajout au panier');
//     });
// }

// // Gérer la suppression des formations associées déjà ajoutées
// function handleRelatedFormations(formationId) {
//     const relatedFormationCard = document.querySelector(`.related-formation-card[data-id="${formationId}"]`);
//     if (relatedFormationCard) {
//         relatedFormationCard.remove();
        
//         // Vérifier s'il reste des formations dans la section
//         const remainingCards = document.querySelectorAll('.related-formation-card');
//         if (remainingCards.length === 0) {
//             // Masquer la section "Vous pouvez acheter" s'il n'y a plus de formations
//             const relatedSection = document.querySelector('.related-formations');
//             if (relatedSection) {
//                 relatedSection.style.display = 'none';
//             }
//         }
//     }
// }

// // Ajouter des styles CSS pour le badge
// function addCartStyles() {
//     // Vérifier si les styles existent déjà
//     if (document.getElementById('cart-badge-styles')) return;
    
//     const styleEl = document.createElement('style');
//     styleEl.id = 'cart-badge-styles';
//     styleEl.textContent = `
//         .cart-badge {
//             position: absolute;
//             top: -10px;
//             right: -10px;
//             background-color: #ff0000;
//             color: white;
//             border-radius: 50%;
//             min-width: 18px;
//             height: 18px;
//             padding: 0 5px;
//             font-size: 12px;
//             font-weight: bold;
//             display: flex !important;
//             align-items: center;
//             justify-content: center;
//             z-index: 1000;
//             box-shadow: 0 2px 5px rgba(0,0,0,0.2);
//             pointer-events: none;
//         }
//     `;
//     document.head.appendChild(styleEl);
// }

// // Fonction pour être compatible avec les appels existants
// function updateCartCounter() {
//     fetchCartItemsCount();
// }

// // Fonction pour être compatible avec les appels existants
// function updateCartCounterFromServer(count) {
//     if (count !== undefined && count !== null) {
//         localStorage.setItem('cartCount', count.toString());
//         updateCartBadge(count);
//     } else {
//         fetchCartItemsCount();
//     }
// }

// // Exposer les fonctions nécessaires globalement
// window.updateCartCounter = updateCartCounter;
// window.updateCartCounterFromServer = updateCartCounterFromServer;
// window.addToCart = addToCart;
// window.checkIfInCart = checkIfInCart;
// window.updateCartButtons = updateCartButtons;

// window.extractFormationDataFromCard = extractFormationDataFromCard;

















// window.cartFormations = [];

// document.addEventListener('DOMContentLoaded', function() {
//     // Initialisation
//     initCartCore();
//     // Vérifier l'état du badge immédiatement
//     initCartBadge();
// });

// function initCartCore() {
//     setupAddToCartListeners();
//     updateCartButtons();
// }

// function setupAddToCartListeners() {
//     document.addEventListener('click', function(e) {
//         // Vérifier si on a cliqué sur un bouton d'ajout au panier
//         if (e.target.classList.contains('btn-add-to-cart') || 
//             e.target.closest('.btn-add-to-cart')) {
            
//             e.preventDefault();
            
//             // Masquer immédiatement le panneau de détail
//             $('#formation-detail-panel').removeClass('active').css('opacity', 0);
            
//             handleAddToCart(e);
//         }
        
//         if (e.target.classList.contains('add-related-btn')) {
//             e.preventDefault();
//             const formationId = e.target.getAttribute('data-id');
//             const formationCard = e.target.closest('.related-formation-card');
            
//             try {
//                 // Extraire les données de la formation associée
//                 const formationData = {
//                     id: formationId,
//                     title: formationCard.querySelector('.related-formation-title')?.textContent || 'Formation',
//                     instructor: formationCard.querySelector('.related-formation-instructor')?.textContent || 'Instructeur',
//                     image: formationCard.querySelector('.related-formation-image')?.src || '',
//                     price: formationCard.querySelector('.final-price')?.textContent || '0 DT',
//                     isBestseller: formationCard.querySelector('.badge-bestseller-small') !== null
//                 };    
                
//                 // Récupération sécurisée des éléments de notation
//                 const ratingElement = formationCard.querySelector('.related-formation-rating');
//                 if (ratingElement) {
//                     formationData.rating = ratingElement.querySelector('.rating-value')?.textContent || '0';
//                     formationData.ratingStars = ratingElement.querySelector('.rating-stars')?.innerHTML || '';
//                     formationData.ratingCount = ratingElement.querySelector('.rating-count')?.textContent || '(0)';
//                 } else {
//                     formationData.rating = '0';
//                     formationData.ratingStars = '';
//                     formationData.ratingCount = '(0)';
//                 }
                
//                 // Vérifier s'il y a une remise
//                 const originalPriceElement = formationCard.querySelector('.original-price');
//                 if (originalPriceElement) {
//                     formationData.hasDiscount = true;
//                     formationData.originalPrice = originalPriceElement.textContent;
//                     formationData.discountPercentage = formationCard.querySelector('.discount-percentage')?.textContent || '';
//                 } else {
//                     formationData.hasDiscount = false;
//                 }
                    
//                 // Ajouter au panier (appel API)
//                 addToCart(formationId);
                
//                 // Ajouter à la liste des formations dans la modale
//                 window.addFormationToCartDisplay(formationData);
                
//                 // Supprimer la formation de la section "Fréquemment achetés ensemble"
//                 formationCard.remove();
                
//                 // Afficher le toast de confirmation
//                 window.showConfirmationToast('Formation ajoutée au panier');
                
//                 console.log("Formation associée ajoutée avec succès:", formationId);
//             } catch (error) {
//                 console.error("Erreur lors de l'ajout de la formation associée:", error);
//             }
//         }
//     });
// }

// function handleAddToCart(e) {
//     // Déterminer d'où vient le clic (carte ou panneau)
//     const target = e.target.closest('.btn-add-to-cart');
//     if (!target) return;
    
//     let formationData;
//     const isFromPanel = target.closest('.panel-content') !== null;
    
//     if (isFromPanel) {
//         console.log("Ajout depuis le panneau de détail");
//         // Pour les clics depuis le panneau, récupérer les données depuis la carte survolée
//         const hoveredCard = document.querySelector('.formation-card:hover');
//         if (hoveredCard) {
//             formationData = extractFormationDataFromCard(hoveredCard);
//         } else {
//             // Récupérer certaines données du panneau et essayer de trouver la carte correspondante
//             const panelContent = target.closest('.panel-content');
//             const title = panelContent.querySelector('h3').textContent;
            
//             // Essayer de trouver la carte qui correspond au titre
//             const allCards = document.querySelectorAll('.formation-card');
//             const matchingCard = Array.from(allCards).find(card => 
//                 card.querySelector('.formation-title').textContent.trim() === title.trim()
//             );
            
//             if (matchingCard) {
//                 formationData = extractFormationDataFromCard(matchingCard);
//             } else {
//                 // Fallback avec des données limitées du panneau
//                 formationData = {
//                     id: '0',
//                     title: title,
//                     instructor: 'Instructeur',
//                     image: '',
//                     price: '0 DT',
//                     rating: '0',
//                     ratingStars: '',
//                     ratingCount: '(0)',
//                     isBestseller: false,
//                     hasDiscount: false,
//                     originalPrice: '',
//                     discountPercentage: '',
//                     category: ''
//                 };
//             }
//         }
//     } else {
//         console.log("Ajout depuis la carte de formation");
//         const formationCard = target.closest('.formation-card') || 
//                               target.closest('.formation-card-container')?.querySelector('.formation-card');
        
//         if (!formationCard) {
//             console.error("Impossible de trouver la carte de formation");
//             return;
//         }
        
//         formationData = extractFormationDataFromCard(formationCard);
//     }
//     console.log("Données de formation extraites:", formationData);
//     // Stocker la formation principale
//     window.cartFormations.unshift(formationData);
//     // Ajouter au panier (API call)
//     addToCart(formationData.id);
    
//     // Réinitialiser la zone d'affichage des formations dans la modale
//     document.getElementById('cart-added-formations').innerHTML = '';
//     const existingFormationIndex = window.cartFormations.findIndex(f => f.id === formationData.id);
//     if (existingFormationIndex === -1) {
//         window.cartFormations.unshift(formationData);
//     }
        
//     // Remplir les informations dans la modale
//     window.populateModal(formationData);
        
//     // Charger les formations associées de la même catégorie, en excluant la formation actuelle
//     window.loadRelatedFormations(formationData.category, formationData.id);
        
//     // Configurer les boutons d'action
//     window.setupActionButtons();
    
//     // Masquer le panneau de détail avant d'afficher la modal
//     $('#formation-detail-panel').removeClass('active').css('opacity', 0);
    
//     // Afficher la modale
//     document.getElementById('add-to-cart-modal').style.display = 'block';
// }

// function extractFormationDataFromCard(card) {
//     // Extraire le titre
//     const titleElement = card.querySelector('.formation-title');
//     const title = titleElement ? titleElement.textContent.trim() : 'Formation';
    
//     // Extraire l'instructeur
//     const instructorElement = card.querySelector('.formation-instructor');
//     const instructor = instructorElement ? instructorElement.textContent.trim() : 'Instructeur';
    
//     // Extraire l'image
//     let image = '';
//     const imgElement = card.querySelector('img');
//     if (imgElement && imgElement.src) {
//         image = imgElement.src;
//     }
    
//     // Extraire les informations de prix et remises
//     let finalPrice = '0 DT';
//     let hasDiscount = false;
//     let originalPrice = '';
//     let discountPercentage = '';
    
//     // Vérifier si nous avons un prix final
//     const finalPriceElement = card.querySelector('.final-price');
//     if (finalPriceElement) {
//         finalPrice = finalPriceElement.textContent.trim();
        
//         // Vérifier s'il y a une remise
//         const originalPriceElement = card.querySelector('.original-price');
//         if (originalPriceElement) {
//             hasDiscount = true;
//             originalPrice = originalPriceElement.textContent.trim();
            
//             // Chercher le pourcentage de remise s'il existe
//             const discountElement = card.querySelector('.discount-percentage');
//             if (discountElement) {
//                 discountPercentage = discountElement.textContent.trim();
//             } else {
//                 // Calculer le pourcentage si non disponible
//                 try {
//                     const finalPriceValue = parseFloat(finalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
//                     const originalPriceValue = parseFloat(originalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
                    
//                     if (originalPriceValue > 0) {
//                         const discount = ((originalPriceValue - finalPriceValue) / originalPriceValue) * 100;
//                         discountPercentage = `-${Math.round(discount)}%`;
//                     }
//                 } catch (e) {
//                     console.error("Erreur lors du calcul de la remise:", e);
//                 }
//             }
//         }
//     }
    
//     // Informations de notation
//     let rating = '0';
//     let ratingStars = '';
//     let ratingCount = '(0)';
    
//     const ratingValueElement = card.querySelector('.rating-value');
//     if (ratingValueElement) {
//         rating = ratingValueElement.textContent.trim();
        
//         const starsElement = card.querySelector('.rating-stars');
//         if (starsElement) {
//             ratingStars = starsElement.innerHTML;
//         } else {
//             ratingStars = window.generateStars(parseFloat(rating));
//         }
        
//         const countElement = card.querySelector('.rating-count');
//         if (countElement) {
//             ratingCount = countElement.textContent.trim();
//         }
//     }
//     const isBestseller = card.querySelector('.badge-bestseller') !== null;
    
//     // Essayer d'extraire l'ID de la formation
//     let formationId = '0';
    
//     // Méthode 1: Depuis un attribut data-id
//     if (card.hasAttribute('data-id')) {
//         formationId = card.getAttribute('data-id');
//     } 
//     // Méthode 2: Depuis les boutons d'action
//     else {
//         const actionElements = card.closest('.formation-card-container')?.querySelectorAll('.action-item');
//         if (actionElements && actionElements.length) {
//             for (const action of actionElements) {
//                 if (action.hasAttribute('data-delete-url')) {
//                     const url = action.getAttribute('data-delete-url');
//                     const matches = url.match(/\/formation\/(\d+)$/);
//                     if (matches && matches[1]) {
//                         formationId = matches[1];
//                         break;
//                     }
//                 } else if (action.hasAttribute('data-edit-url')) {
//                     const url = action.getAttribute('data-edit-url');
//                     const matches = url.match(/\/formation\/(\d+)\/edit$/);
//                     if (matches && matches[1]) {
//                         formationId = matches[1];
//                         break;
//                     }
//                 }
//             }
//         }
//     }

//     // Extraire la catégorie de la formation
//     let category = '';
//     // Rechercher d'abord dans les attributs data-
//     if (card.hasAttribute('data-category')) {
//         category = card.getAttribute('data-category');
//     } else {
//         // Essayer de trouver un élément contenant la catégorie
//         const categoryElement = card.querySelector('.formation-category');
//         if (categoryElement) {
//             category = categoryElement.textContent.trim();
//         } else {
//             // On peut aussi essayer de récupérer la catégorie depuis l'URL 
//             const currentPath = window.location.pathname;
//             const categoryMatch = currentPath.match(/\/category\/([^\/]+)/);
//             if (categoryMatch && categoryMatch[1]) {
//                 category = decodeURIComponent(categoryMatch[1]);
//             }
//         }
//     }
    
//     return {
//         id: formationId,
//         title: title,
//         instructor: instructor,
//         image: image,
//         price: finalPrice,
//         rating: rating,
//         ratingStars: ratingStars,
//         ratingCount: ratingCount,
//         isBestseller: isBestseller,
//         hasDiscount: hasDiscount,
//         originalPrice: originalPrice,
//         discountPercentage: discountPercentage,
//         category: category
//     };
// }

// function checkIfInCart(formationId, callback) {
//     fetch('/panier/check', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             formation_id: formationId
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (callback && typeof callback === 'function') {
//             callback(data.inCart || false);
//         }
//     })
//     .catch(error => {
//         console.error('Erreur lors de la vérification du panier:', error);
//         if (callback && typeof callback === 'function') {
//             callback(false);
//         }
//     });
// }

// function updateCartButtons() {
//     const cartButtons = document.querySelectorAll('.btn-add-to-cart');
    
//     cartButtons.forEach(button => {
//         const formationCard = button.closest('.formation-card') || 
//                              button.closest('.formation-card-container')?.querySelector('.formation-card');
                         
//         if (!formationCard) return;
        
//         const formationId = formationCard.getAttribute('data-id');
//         if (!formationId) return;
        
//         checkIfInCart(formationId, (inCart) => {
//             if (inCart) {
//                 button.innerHTML = '<i class="fas fa-shopping-cart"></i> Accéder au panier';
//                 button.classList.add('in-cart');
                
//                 // Changer l'action du bouton
//                 button.removeEventListener('click', handleAddToCart);
//                 button.addEventListener('click', function(e) {
//                     e.preventDefault();
//                     window.location.href = '/panier';
//                 });
//             } else {
//                 button.innerHTML = '<i class="fas fa-cart-plus"></i> Ajouter au panier';
//                 button.classList.remove('in-cart');
//             }
//         });
//     });
// }

// // ----- IMPLÉMENTATION AMÉLIORÉE POUR LE BADGE DU PANIER -----

// // Initialiser le badge du panier
// function initCartBadge() {
//     // Charger les styles CSS immédiatement
//     addCartStyles();
    
//     // Vérifier le localStorage en premier pour une réponse immédiate
//     const storedCount = parseInt(localStorage.getItem('cartCount') || '0');
//     updateCartBadge(storedCount);
    
//     // Puis vérifier avec le serveur pour s'assurer que c'est exact
//     fetchCartItemsCount();
    
//     // Configurer l'observateur de mutations
//     setupMutationObserver();
// }

// // NOUVELLE FONCTION: UpdateCartBadge simplifiée sans animation et sans recréation
// function updateCartBadge(count) {
//     const cartContainer = document.querySelector('.cart-container');
    
//     if (!cartContainer) {
//         console.error("Conteneur de panier introuvable");
//         return;
//     }
    
//     // Rechercher le badge existant
//     let cartBadge = document.querySelector('.cart-badge');
    
//     // Si le count est 0, supprimer le badge s'il existe
//     if (count <= 0) {
//         if (cartBadge) {
//             cartBadge.remove();
//         }
//         return;
//     }
    
//     // Si le badge existe déjà, simplement mettre à jour son contenu
//     if (cartBadge) {
//         // Mettre à jour le texte sans modifier l'élément
//         cartBadge.textContent = count.toString();
//     } else {
//         // Créer un nouveau badge si aucun n'existe
//         cartBadge = document.createElement('span');
//         cartBadge.className = 'cart-badge';
//         cartBadge.id = 'cart-badge';
//         cartBadge.textContent = count.toString();
        
//         // Appliquer les styles directement pour s'assurer qu'il est visible immédiatement
//         applyPermanentStyles(cartBadge);
        
//         // Ajouter le badge au conteneur
//         cartContainer.appendChild(cartBadge);
//     }
// }

// // Appliquer des styles permanents au badge
// function applyPermanentStyles(badge) {
//     badge.style.display = 'flex';
//     badge.style.visibility = 'visible';
//     badge.style.opacity = '1';
//     badge.style.position = 'absolute';
//     badge.style.top = '-10px';
//     badge.style.right = '-10px';
//     badge.style.backgroundColor = '#ff0000';
//     badge.style.color = 'white';
//     badge.style.borderRadius = '50%';
//     badge.style.minWidth = '18px';
//     badge.style.height = '18px';
//     badge.style.padding = '0 5px';
//     badge.style.fontSize = '12px';
//     badge.style.fontWeight = 'bold';
//     badge.style.alignItems = 'center';
//     badge.style.justifyContent = 'center';
//     badge.style.zIndex = '1000';
//     badge.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
//     badge.style.pointerEvents = 'none'; // Éviter que le badge interfère avec les clics
// }

// // Fonction améliorée pour mettre à jour le compteur depuis le serveur
// function fetchCartItemsCount() {
//     fetch('/panier/items-count', {
//         method: 'GET',
//         headers: {
//             'X-Requested-With': 'XMLHttpRequest',
//             'Accept': 'application/json'
//         }
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Erreur réseau');
//         }
//         return response.json();
//     })
//     .then(data => {
//         // Mettre à jour le localStorage avec la valeur exacte du serveur
//         localStorage.setItem('cartCount', data.count.toString());
        
//         // Mettre à jour le badge visuellement
//         updateCartBadge(data.count);
//     })
//     .catch(error => {
//         console.error('Erreur lors de la récupération du nombre d\'éléments du panier:', error);
//         // En cas d'erreur, garder la valeur du localStorage
//         const storedCount = parseInt(localStorage.getItem('cartCount') || '0');
//         updateCartBadge(storedCount);
//     });
// }

// // Configurer un observateur de mutations pour surveiller les changements dans le DOM
// function setupMutationObserver() {
//     // Créer un observateur qui surveille les changements dans le DOM
//     const observer = new MutationObserver((mutations) => {
//         for (const mutation of mutations) {
//             // Si des nœuds sont supprimés, vérifier si le badge est toujours présent
//             if (mutation.removedNodes.length > 0) {
//                 const badge = document.querySelector('.cart-badge');
//                 const cartCount = parseInt(localStorage.getItem('cartCount') || '0');
                
//                 // Si le badge devrait être visible mais ne l'est pas
//                 if (cartCount > 0 && !badge) {
//                     updateCartBadge(cartCount);
//                     break;
//                 }
//             }
//         }
//     });
    
//     // Observer le corps du document pour tout changement
//     observer.observe(document.body, { 
//         childList: true, 
//         subtree: true 
//     });
    
//     // Sauvegarder l'observateur pour pouvoir le déconnecter si nécessaire
//     window.cartBadgeObserver = observer;
// }

// // CORRECTION: Fonction pour ajouter une formation au panier avec mise à jour immédiate du badge
// function addToCart(formationId) {
//     // METTRE À JOUR IMMÉDIATEMENT le compteur LOCAL
//     const currentCount = parseInt(localStorage.getItem('cartCount') || '0');
//     const newCount = currentCount + 1;
    
//     // Mettre à jour le stockage local et le badge AVANT l'appel au serveur
//     localStorage.setItem('cartCount', newCount.toString());
//     updateCartBadge(newCount);
    
//     // Envoyer la requête au serveur
//     fetch('/panier/ajouter', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             formation_id: formationId
//         })
//     })
//     .then(response => {
//         if (!response.ok) {
//             // En cas d'erreur, revenir au compteur précédent
//             localStorage.setItem('cartCount', currentCount.toString());
//             updateCartBadge(currentCount);
//             throw new Error('Erreur lors de l\'ajout au panier');
//         }
//         return response.json();
//     })
//     .then(data => {
//         console.log('Formation ajoutée au panier avec succès:', formationId);
        
//         // Mettre à jour le badge avec le nombre exact fourni par le serveur
//         if (data.cartCount !== undefined) {
//             localStorage.setItem('cartCount', data.cartCount.toString());
//             updateCartBadge(data.cartCount);
//         }
        
//         // Gérer les formations associées dans l'interface
//         handleRelatedFormations(formationId);
        
//         // Afficher un message de confirmation
//         if (data.message) {
//             window.showConfirmationToast(data.message);
//         } else {
//             window.showConfirmationToast('Formation ajoutée au panier');
//         }
//     })
//     .catch(error => {
//         console.error('Erreur:', error);
//         window.showConfirmationToast('Erreur lors de l\'ajout au panier');
//     });
// }

// // Gérer la suppression des formations associées déjà ajoutées
// function handleRelatedFormations(formationId) {
//     const relatedFormationCard = document.querySelector(`.related-formation-card[data-id="${formationId}"]`);
//     if (relatedFormationCard) {
//         relatedFormationCard.remove();
        
//         // Vérifier s'il reste des formations dans la section
//         const remainingCards = document.querySelectorAll('.related-formation-card');
//         if (remainingCards.length === 0) {
//             // Masquer la section "Vous pouvez acheter" s'il n'y a plus de formations
//             const relatedSection = document.querySelector('.related-formations');
//             if (relatedSection) {
//                 relatedSection.style.display = 'none';
//             }
//         }
//     }
// }

// // Ajouter des styles CSS pour le badge
// function addCartStyles() {
//     // Vérifier si les styles existent déjà
//     if (document.getElementById('cart-badge-styles')) return;
    
//     const styleEl = document.createElement('style');
//     styleEl.id = 'cart-badge-styles';
//     styleEl.textContent = `
//         .cart-badge {
//             position: absolute;
//             top: -10px;
//             right: -10px;
//             background-color: #ff0000;
//             color: white;
//             border-radius: 50%;
//             min-width: 18px;
//             height: 18px;
//             padding: 0 5px;
//             font-size: 12px;
//             font-weight: bold;
//             display: flex !important;
//             align-items: center;
//             justify-content: center;
//             z-index: 1000;
//             box-shadow: 0 2px 5px rgba(0,0,0,0.2);
//             pointer-events: none;
//         }
//     `;
//     document.head.appendChild(styleEl);
// }

// // Fonction pour être compatible avec les appels existants
// function updateCartCounter() {
//     fetchCartItemsCount();
// }

// // Fonction pour être compatible avec les appels existants
// function updateCartCounterFromServer(count) {
//     if (count !== undefined && count !== null) {
//         localStorage.setItem('cartCount', count.toString());
//         updateCartBadge(count);
//     } else {
//         fetchCartItemsCount();
//     }
// }

// // Exposer les fonctions nécessaires globalement
// window.updateCartCounter = updateCartCounter;
// window.updateCartCounterFromServer = updateCartCounterFromServer;
// window.addToCart = addToCart;
// window.checkIfInCart = checkIfInCart;
// window.updateCartButtons = updateCartButtons;
// window.extractFormationDataFromCard = extractFormationDataFromCard;





window.cartFormations = [];

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation
    initCartCore();
    // Vérifier l'état du badge immédiatement
    initCartBadge();
});

function initCartCore() {
    setupAddToCartListeners();
    updateCartButtons();
}

function setupAddToCartListeners() {
    document.addEventListener('click', function(e) {
        // Vérifier si on a cliqué sur un bouton d'ajout au panier
        if (e.target.classList.contains('btn-add-to-cart') || 
            e.target.closest('.btn-add-to-cart')) {
            
            e.preventDefault();
            
            // Masquer immédiatement le panneau de détail
            $('#formation-detail-panel').removeClass('active').css('opacity', 0);
            
            handleAddToCart(e);
        }
        
        if (e.target.classList.contains('add-related-btn')) {
            e.preventDefault();
            const formationId = e.target.getAttribute('data-id');
            const formationCard = e.target.closest('.related-formation-card');
            
            try {
                // Extraire les données de la formation associée
                const formationData = {
                    id: formationId,
                    title: formationCard.querySelector('.related-formation-title')?.textContent || 'Formation',
                    instructor: formationCard.querySelector('.related-formation-instructor')?.textContent || 'Instructeur',
                    image: formationCard.querySelector('.related-formation-image')?.src || '',
                    price: formationCard.querySelector('.final-price')?.textContent || '0 DT',
                    isBestseller: formationCard.querySelector('.badge-bestseller-small') !== null
                };    
                
                // Récupération sécurisée des éléments de notation
                const ratingElement = formationCard.querySelector('.related-formation-rating');
                if (ratingElement) {
                    formationData.rating = ratingElement.querySelector('.rating-value')?.textContent || '0';
                    formationData.ratingStars = ratingElement.querySelector('.rating-stars')?.innerHTML || '';
                    formationData.ratingCount = ratingElement.querySelector('.rating-count')?.textContent || '(0)';
                } else {
                    formationData.rating = '0';
                    formationData.ratingStars = '';
                    formationData.ratingCount = '(0)';
                }
                
                // Vérifier s'il y a une remise
                const originalPriceElement = formationCard.querySelector('.original-price');
                if (originalPriceElement) {
                    formationData.hasDiscount = true;
                    formationData.originalPrice = originalPriceElement.textContent;
                    formationData.discountPercentage = formationCard.querySelector('.discount-percentage')?.textContent || '';
                } else {
                    formationData.hasDiscount = false;
                }
                    
                // Ajouter au panier (appel API)
                addToCart(formationId);
                
                // Ajouter à la liste des formations dans la modale
                window.addFormationToCartDisplay(formationData);
                
                // Supprimer la formation de la section "Fréquemment achetés ensemble"
                formationCard.remove();
                
                // Afficher le toast de confirmation
                window.showConfirmationToast('Formation ajoutée au panier');
                
                console.log("Formation associée ajoutée avec succès:", formationId);
            } catch (error) {
                console.error("Erreur lors de l'ajout de la formation associée:", error);
            }
        }
    });
}

function handleAddToCart(e) {
    // Déterminer d'où vient le clic (carte ou panneau)
    const target = e.target.closest('.btn-add-to-cart');
    if (!target) return;
    
    let formationData;
    const isFromPanel = target.closest('.panel-content') !== null;
    
    if (isFromPanel) {
        console.log("Ajout depuis le panneau de détail");
        // Pour les clics depuis le panneau, récupérer les données depuis la carte survolée
        const hoveredCard = document.querySelector('.formation-card:hover');
        if (hoveredCard) {
            formationData = extractFormationDataFromCard(hoveredCard);
        } else {
            // Récupérer certaines données du panneau et essayer de trouver la carte correspondante
            const panelContent = target.closest('.panel-content');
            const title = panelContent.querySelector('h3').textContent;
            
            // Essayer de trouver la carte qui correspond au titre
            const allCards = document.querySelectorAll('.formation-card');
            const matchingCard = Array.from(allCards).find(card => 
                card.querySelector('.formation-title').textContent.trim() === title.trim()
            );
            
            if (matchingCard) {
                formationData = extractFormationDataFromCard(matchingCard);
            } else {
                // Fallback avec des données limitées du panneau
                formationData = {
                    id: '0',
                    title: title,
                    instructor: 'Instructeur',
                    image: '',
                    price: '0 DT',
                    rating: '0',
                    ratingStars: '',
                    ratingCount: '(0)',
                    isBestseller: false,
                    hasDiscount: false,
                    originalPrice: '',
                    discountPercentage: '',
                    category: ''
                };
            }
        }
    } else {
        console.log("Ajout depuis la carte de formation");
        const formationCard = target.closest('.formation-card') || 
                              target.closest('.formation-card-container')?.querySelector('.formation-card');
        
        if (!formationCard) {
            console.error("Impossible de trouver la carte de formation");
            return;
        }
        
        formationData = extractFormationDataFromCard(formationCard);
    }
    console.log("Données de formation extraites:", formationData);
    // Stocker la formation principale
    window.cartFormations.unshift(formationData);
    // Ajouter au panier (API call)
    addToCart(formationData.id);
    
    // Réinitialiser la zone d'affichage des formations dans la modale
    document.getElementById('cart-added-formations').innerHTML = '';
    const existingFormationIndex = window.cartFormations.findIndex(f => f.id === formationData.id);
    if (existingFormationIndex === -1) {
        window.cartFormations.unshift(formationData);
    }
        
    // Remplir les informations dans la modale
    window.populateModal(formationData);
        
    // Charger les formations associées de la même catégorie, en excluant la formation actuelle
    window.loadRelatedFormations(formationData.category, formationData.id);
        
    // Configurer les boutons d'action
    window.setupActionButtons();
    
    // Masquer le panneau de détail avant d'afficher la modal
    $('#formation-detail-panel').removeClass('active').css('opacity', 0);
    
    // Afficher la modale
    document.getElementById('add-to-cart-modal').style.display = 'block';
}

function extractFormationDataFromCard(card) {
    // Extraire le titre
    const titleElement = card.querySelector('.formation-title');
    const title = titleElement ? titleElement.textContent.trim() : 'Formation';
    
    // Extraire l'instructeur
    const instructorElement = card.querySelector('.formation-instructor');
    const instructor = instructorElement ? instructorElement.textContent.trim() : 'Instructeur';
    
    // Extraire l'image
    let image = '';
    const imgElement = card.querySelector('img');
    if (imgElement && imgElement.src) {
        image = imgElement.src;
    }
    
    // Extraire les informations de prix et remises
    let finalPrice = '0 DT';
    let hasDiscount = false;
    let originalPrice = '';
    let discountPercentage = '';
    
    // Vérifier si nous avons un prix final
    const finalPriceElement = card.querySelector('.final-price');
    if (finalPriceElement) {
        finalPrice = finalPriceElement.textContent.trim();
        
        // Vérifier s'il y a une remise
        const originalPriceElement = card.querySelector('.original-price');
        if (originalPriceElement) {
            hasDiscount = true;
            originalPrice = originalPriceElement.textContent.trim();
            
            // Chercher le pourcentage de remise s'il existe
            const discountElement = card.querySelector('.discount-percentage');
            if (discountElement) {
                discountPercentage = discountElement.textContent.trim();
            } else {
                // Calculer le pourcentage si non disponible
                try {
                    const finalPriceValue = parseFloat(finalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
                    const originalPriceValue = parseFloat(originalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
                    
                    if (originalPriceValue > 0) {
                        const discount = ((originalPriceValue - finalPriceValue) / originalPriceValue) * 100;
                        discountPercentage = `-${Math.round(discount)}%`;
                    }
                } catch (e) {
                    console.error("Erreur lors du calcul de la remise:", e);
                }
            }
        }
    }
    
    // Informations de notation
    let rating = '0';
    let ratingStars = '';
    let ratingCount = '(0)';
    
    const ratingValueElement = card.querySelector('.rating-value');
    if (ratingValueElement) {
        rating = ratingValueElement.textContent.trim();
        
        const starsElement = card.querySelector('.rating-stars');
        if (starsElement) {
            ratingStars = starsElement.innerHTML;
        } else {
            ratingStars = window.generateStars(parseFloat(rating));
        }
        
        const countElement = card.querySelector('.rating-count');
        if (countElement) {
            ratingCount = countElement.textContent.trim();
        }
    }
    const isBestseller = card.querySelector('.badge-bestseller') !== null;
    
    // Essayer d'extraire l'ID de la formation
    let formationId = '0';
    
    // Méthode 1: Depuis un attribut data-id
    if (card.hasAttribute('data-id')) {
        formationId = card.getAttribute('data-id');
    } 
    // Méthode 2: Depuis les boutons d'action
    else {
        const actionElements = card.closest('.formation-card-container')?.querySelectorAll('.action-item');
        if (actionElements && actionElements.length) {
            for (const action of actionElements) {
                if (action.hasAttribute('data-delete-url')) {
                    const url = action.getAttribute('data-delete-url');
                    const matches = url.match(/\/formation\/(\d+)$/);
                    if (matches && matches[1]) {
                        formationId = matches[1];
                        break;
                    }
                } else if (action.hasAttribute('data-edit-url')) {
                    const url = action.getAttribute('data-edit-url');
                    const matches = url.match(/\/formation\/(\d+)\/edit$/);
                    if (matches && matches[1]) {
                        formationId = matches[1];
                        break;
                    }
                }
            }
        }
    }

    // Extraire la catégorie de la formation
    let category = '';
    // Rechercher d'abord dans les attributs data-
    if (card.hasAttribute('data-category')) {
        category = card.getAttribute('data-category');
    } else {
        // Essayer de trouver un élément contenant la catégorie
        const categoryElement = card.querySelector('.formation-category');
        if (categoryElement) {
            category = categoryElement.textContent.trim();
        } else {
            // On peut aussi essayer de récupérer la catégorie depuis l'URL 
            const currentPath = window.location.pathname;
            const categoryMatch = currentPath.match(/\/category\/([^\/]+)/);
            if (categoryMatch && categoryMatch[1]) {
                category = decodeURIComponent(categoryMatch[1]);
            }
        }
    }
    
    return {
        id: formationId,
        title: title,
        instructor: instructor,
        image: image,
        price: finalPrice,
        rating: rating,
        ratingStars: ratingStars,
        ratingCount: ratingCount,
        isBestseller: isBestseller,
        hasDiscount: hasDiscount,
        originalPrice: originalPrice,
        discountPercentage: discountPercentage,
        category: category
    };
}

function checkIfInCart(formationId, callback) {
    fetch('/panier/check', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            formation_id: formationId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (callback && typeof callback === 'function') {
            callback(data.inCart || false);
        }
    })
    .catch(error => {
        console.error('Erreur lors de la vérification du panier:', error);
        if (callback && typeof callback === 'function') {
            callback(false);
        }
    });
}

function updateCartButtons() {
    const cartButtons = document.querySelectorAll('.btn-add-to-cart');
    
    cartButtons.forEach(button => {
        const formationCard = button.closest('.formation-card') || 
                             button.closest('.formation-card-container')?.querySelector('.formation-card');
                         
        if (!formationCard) return;
        
        const formationId = formationCard.getAttribute('data-id');
        if (!formationId) return;
        
        checkIfInCart(formationId, (inCart) => {
            if (inCart) {
                button.innerHTML = '<i class="fas fa-shopping-cart"></i> Accéder au panier';
                button.classList.add('in-cart');
                
                // Changer l'action du bouton
                button.removeEventListener('click', handleAddToCart);
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = '/panier';
                });
            } else {
                button.innerHTML = '<i class="fas fa-cart-plus"></i> Ajouter au panier';
                button.classList.remove('in-cart');
            }
        });
    });
}

// ----- IMPLÉMENTATION AMÉLIORÉE POUR LE BADGE DU PANIER -----

// Initialiser le badge du panier
function initCartBadge() {
    // Charger les styles CSS immédiatement
    addCartStyles();
    
    // Vérifier le localStorage en premier pour une réponse immédiate
    const storedCount = parseInt(localStorage.getItem('cartCount') || '0');
    
    // S'assurer que le badge est mis à jour correctement
    if (storedCount > 0) {
        updateCartBadge(storedCount);
    }
    
    // Puis vérifier avec le serveur pour s'assurer que c'est exact
    fetchCartItemsCount();
    
    // Configurer l'observateur de mutations pour surveiller les changements du DOM
    setupMutationObserver();
    
    // Ajouter un écouteur d'événements pour la visibilité de la page
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            // Quand la page redevient visible, vérifier que le badge est correct
            const currentCount = parseInt(localStorage.getItem('cartCount') || '0');
            if (currentCount > 0) {
                updateCartBadge(currentCount);
            }
        }
    });
}

// Fonction optimisée pour updateCartBadge
function updateCartBadge(count) {
    const cartContainer = document.querySelector('.cart-container');
    
    if (!cartContainer) {
        console.error("Conteneur de panier introuvable");
        return;
    }
    
    // Convertir count en nombre pour éviter toute confusion
    count = parseInt(count);
    
    // Rechercher le badge existant
    let cartBadge = document.querySelector('.cart-badge');
    
    // Si le count est 0, supprimer le badge s'il existe
    if (count <= 0) {
        if (cartBadge) {
            cartBadge.remove();
        }
        return;
    }
    
    // Si le badge existe déjà, simplement mettre à jour son contenu
    if (cartBadge) {
        // S'assurer que le badge est visible
        cartBadge.style.display = 'flex';
        cartBadge.style.visibility = 'visible';
        cartBadge.style.opacity = '1';
        
        // Mettre à jour le texte
        cartBadge.textContent = count.toString();
    } else {
        // Créer un nouveau badge si aucun n'existe
        cartBadge = document.createElement('span');
        cartBadge.className = 'cart-badge';
        cartBadge.id = 'cart-badge';
        cartBadge.textContent = count.toString();
        
        // Appliquer les styles directement pour s'assurer qu'il est visible immédiatement
        applyPermanentStyles(cartBadge);
        
        // Ajouter le badge au conteneur
        cartContainer.appendChild(cartBadge);
        
        // Forcer un reflow pour s'assurer que le badge est rendu
        cartBadge.offsetHeight;
    }
    
    // Vérifier après un court délai que le badge est toujours visible
    setTimeout(() => {
        const currentBadge = document.querySelector('.cart-badge');
        if (!currentBadge && count > 0) {
            // Si le badge a disparu, le recréer
            updateCartBadge(count);
        }
    }, 100);
}

// Appliquer des styles permanents au badge
function applyPermanentStyles(badge) {
    badge.style.display = 'flex';
    badge.style.visibility = 'visible';
    badge.style.opacity = '1';
    badge.style.position = 'absolute';
    badge.style.top = '-10px';
    badge.style.right = '-10px';
    badge.style.backgroundColor = '#ff0000';
    badge.style.color = 'white';
    badge.style.borderRadius = '50%';
    badge.style.minWidth = '18px';
    badge.style.height = '18px';
    badge.style.padding = '0 5px';
    badge.style.fontSize = '12px';
    badge.style.fontWeight = 'bold';
    badge.style.alignItems = 'center';
    badge.style.justifyContent = 'center';
    badge.style.zIndex = '1000';
    badge.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
    badge.style.pointerEvents = 'none'; // Éviter que le badge interfère avec les clics
}

// Fonction améliorée pour mettre à jour le compteur depuis le serveur
function fetchCartItemsCount() {
    fetch('/panier/items-count', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        return response.json();
    })
    .then(data => {
        // Mettre à jour le localStorage avec la valeur exacte du serveur
        localStorage.setItem('cartCount', data.count.toString());
        
        // Mettre à jour le badge visuellement
        updateCartBadge(data.count);
    })
    .catch(error => {
        console.error('Erreur lors de la récupération du nombre d\'éléments du panier:', error);
        // En cas d'erreur, garder la valeur du localStorage
        const storedCount = parseInt(localStorage.getItem('cartCount') || '0');
        updateCartBadge(storedCount);
    });
}

// Configurer un observateur de mutations pour surveiller les changements dans le DOM
function setupMutationObserver() {
    // Créer un observateur qui surveille les changements dans le DOM
    const observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            // Vérifier si un changement affecte le badge
            if (mutation.type === 'childList' || mutation.type === 'attributes') {
                const cartCount = parseInt(localStorage.getItem('cartCount') || '0');
                const badge = document.querySelector('.cart-badge');
                
                // Si le badge devrait être visible mais ne l'est pas, ou s'il a été modifié
                if (cartCount > 0 && (!badge || badge.textContent !== cartCount.toString())) {
                    updateCartBadge(cartCount);
                    break;
                }
            }
        }
    });
    
    // Observer le corps du document pour tout changement
    observer.observe(document.body, { 
        childList: true, 
        subtree: true,
        attributes: true,
        characterData: true
    });
    
    // Sauvegarder l'observateur pour pouvoir le déconnecter si nécessaire
    window.cartBadgeObserver = observer;
}

// Fonction corrigée pour ajouter une formation au panier avec mise à jour immédiate du badge
function addToCart(formationId) {
    // METTRE À JOUR IMMÉDIATEMENT le compteur LOCAL
    const currentCount = parseInt(localStorage.getItem('cartCount') || '0');
    const newCount = currentCount + 1;
    
    // Mettre à jour le stockage local et le badge AVANT l'appel au serveur
    localStorage.setItem('cartCount', newCount.toString());
    
    // S'assurer que la mise à jour du badge se fait correctement
    updateCartBadge(newCount);
    
    // Envoyer la requête au serveur
    fetch('/panier/ajouter', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            formation_id: formationId
        })
    })
    .then(response => {
        if (!response.ok) {
            // En cas d'erreur, revenir au compteur précédent
            localStorage.setItem('cartCount', currentCount.toString());
            updateCartBadge(currentCount);
            throw new Error('Erreur lors de l\'ajout au panier');
        }
        return response.json();
    })
    .then(data => {
        console.log('Formation ajoutée au panier avec succès:', formationId);
        
        // Mettre à jour le badge avec le nombre exact fourni par le serveur
        if (data.cartCount !== undefined) {
            localStorage.setItem('cartCount', data.cartCount.toString());
            updateCartBadge(data.cartCount);
        }
        
        // Gérer les formations associées dans l'interface
        handleRelatedFormations(formationId);
        
        // Afficher un message de confirmation
        if (data.message) {
            window.showConfirmationToast(data.message);
        } else {
            window.showConfirmationToast('Formation ajoutée au panier');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        window.showConfirmationToast('Erreur lors de l\'ajout au panier');
    });
}

// Gérer la suppression des formations associées déjà ajoutées
function handleRelatedFormations(formationId) {
    const relatedFormationCard = document.querySelector(`.related-formation-card[data-id="${formationId}"]`);
    if (relatedFormationCard) {
        relatedFormationCard.remove();
        
        // Vérifier s'il reste des formations dans la section
        const remainingCards = document.querySelectorAll('.related-formation-card');
        if (remainingCards.length === 0) {
            // Masquer la section "Vous pouvez acheter" s'il n'y a plus de formations
            const relatedSection = document.querySelector('.related-formations');
            if (relatedSection) {
                relatedSection.style.display = 'none';
            }
        }
    }
}

// Ajouter des styles CSS pour le badge
function addCartStyles() {
    // Vérifier si les styles existent déjà
    if (document.getElementById('cart-badge-styles')) return;
    
    const styleEl = document.createElement('style');
    styleEl.id = 'cart-badge-styles';
    styleEl.textContent = `
        .cart-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #ff0000;
            color: white;
            border-radius: 50%;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            font-size: 12px;
            font-weight: bold;
            display: flex !important;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            pointer-events: none;
        }
    `;
    document.head.appendChild(styleEl);
}

// Fonction pour être compatible avec les appels existants
function updateCartCounter() {
    fetchCartItemsCount();
}

// Fonction pour être compatible avec les appels existants
function updateCartCounterFromServer(count) {
    if (count !== undefined && count !== null) {
        localStorage.setItem('cartCount', count.toString());
        updateCartBadge(count);
    } else {
        fetchCartItemsCount();
    }
}

// Exposer les fonctions nécessaires globalement
window.updateCartCounter = updateCartCounter;
window.updateCartCounterFromServer = updateCartCounterFromServer;
window.addToCart = addToCart;
window.checkIfInCart = checkIfInCart;
window.updateCartButtons = updateCartButtons;
window.extractFormationDataFromCard = extractFormationDataFromCard;