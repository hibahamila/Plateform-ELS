// (function() {
//     // Attendre que le DOM soit chargé
//     document.addEventListener('DOMContentLoaded', initCartModal);
//     // Stocker les formations ajoutées au panier
//     const cartFormations = [];
//     // Point d'entrée principal
//     function initCartModal() {
//         createModalIfNeeded();
//         setupModalEventListeners();
//         setupAddToCartListeners();
//         updateCartButtons(); // Ajoutez cette ligne

//     }

//     function checkIfInCart(formationId, callback) {
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

// // Mettre à jour l'affichage du bouton selon l'état du panier
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
//     // Créer la structure de la modale si elle n'existe pas déjà
//     function createModalIfNeeded() {
//         if (!document.getElementById('add-to-cart-modal')) {
//             const modalHTML = `
//                 <div id="add-to-cart-modal" class="modal">
//                     <div class="modal-content">
//                         <div class="modal-header">
//                             <h2>Ajouté au panier</h2>
//                             <span class="close-modal">&times;</span>
//                         </div>
//                         <div class="modal-body">
//                             <div class="formation-details">
//                                 <div class="formation-image-container">
//                                     <img class="formation-image" src="" alt="Image de formation">
//                                 </div>
//                                 <div class="formation-info">
//                                     <h3 class="formation-title"></h3>
//                                     <p class="formation-instructor"></p>
//                                     <div class="formation-rating"></div>
//                                     <div class="formation-price">
//                                         <span class="final-price"></span>
//                                         <div class="discount-info">
//                                             <span class="original-price"></span>
//                                             <span class="discount-percentage"></span>
//                                         </div>
//                                     </div>
//                                     <div class="badge-container"></div>
//                                 </div>
//                             </div>
//                             <div id="cart-added-formations">
//                                 <!-- Les formations ajoutées s'afficheront ici -->
//                             </div>
//                             <div class="modal-actions">
//                                 <button class="btn-pay">Payer <i class="fas fa-arrow-right"></i></button>
//                                 <button class="btn-view-cart">Accéder au panier <i class="fas fa-shopping-cart"></i></button>
//                             </div>
//                             <div class="related-formations">
//                                 <h3>Vous pouvez achetez </h3>
//                                 <div class="related-formations-container"></div>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             <link rel="stylesheet" href="/assets/css/MonCss/cart-modal.css">
//             `;
//             document.body.insertAdjacentHTML('beforeend', modalHTML);
//         }
//     }
//     function setupModalEventListeners() {
//         const modal = document.getElementById('add-to-cart-modal');
//         const closeModalBtn = document.querySelector('.close-modal');
        
//         // Masquer le panneau de détail lorsque la modal est ouverte
//         if (modal) {
//             modal.addEventListener('show', function() {
//                 $('#formation-detail-panel').removeClass('active').css('opacity', 0);
//             });
//         }
        
//         if (closeModalBtn) {
//             closeModalBtn.addEventListener('click', function() {
//                 modal.style.display = 'none';
//             });
//         }
        
//         // Fermer la modale en cliquant en dehors
//         window.addEventListener('click', function(event) {
//             if (event.target === modal) {
//                 modal.style.display = 'none';
//             }
//         });
    
//         // Toast de confirmation
//         if (!document.getElementById('confirmation-toast')) {
//             const toastHTML = `
//                 <div id="confirmation-toast">
//                     <div class="toast-content">
//                         <i class="fas fa-check-circle"></i>
//                         <span class="toast-message"></span>
//                     </div>
//                 </div>
//             `;
//             document.body.insertAdjacentHTML('beforeend', toastHTML);
//         }
//     }

//     function setupAddToCartListeners() {
//         // document.addEventListener('click', function(e) {
//         //     // Vérifier si on a cliqué sur un bouton d'ajout au panier
//         //     const targetBtn = e.target.classList.contains('btn-add-to-cart') ? 
//         //                     e.target : e.target.closest('.btn-add-to-cart');
            
//         //     if (targetBtn) {
//         //         e.preventDefault();
                
//         //         // Vérifier si le bouton est marqué comme "in-cart"
//         //         if (targetBtn.classList.contains('in-cart')) {
//         //             // Si déjà dans le panier, rediriger vers la page du panier
//         //             window.location.href = '/panier';
//         //         } else {
//         //             // Sinon, ajouter au panier
//         //             // Masquer immédiatement le panneau de détail
//         //             $('#formation-detail-panel').removeClass('active').css('opacity', 0);
                    
//         //             handleAddToCart(e);
//         //         }
//         //     }

//         document.addEventListener('click', function(e) {
//             // Trouver le bouton d'ajout au panier
//             const addToCartBtn = e.target.classList.contains('btn-add-to-cart') ? 
//                                 e.target : e.target.closest('.btn-add-to-cart');
            
//             if (addToCartBtn) {
//                 e.preventDefault();
                
//                 // Si le bouton indique que l'article est déjà dans le panier
//                 if (addToCartBtn.classList.contains('in-cart')) {
//                     // Rediriger vers la page du panier
//                     window.location.href = '/panier';
//                 } else {
//                     // Masquer immédiatement le panneau de détail
//                     $('#formation-detail-panel').removeClass('active').css('opacity', 0);
//                     // Ajouter au panier
//                     handleAddToCart(e);
//                 }
//             }
//         // document.addEventListener('click', function(e) {
//         //     // Vérifier si on a cliqué sur un bouton d'ajout au panier
//         //     if (e.target.classList.contains('btn-add-to-cart') || 
//         //         e.target.closest('.btn-add-to-cart')) {
                
//         //         e.preventDefault();
                
//         //         // Masquer immédiatement le panneau de détail
//         //         $('#formation-detail-panel').removeClass('active').css('opacity', 0);
                
//         //         handleAddToCart(e);
//         //     }
            
//             if (e.target.classList.contains('add-related-btn')) {
//                 e.preventDefault();
//             const formationId = e.target.getAttribute('data-id');
//             const formationCard = e.target.closest('.related-formation-card');
            
//             try {
//                 // Extraire les données de la formation associée avec vérification
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
//                 addFormationToCartDisplay(formationData);
                
//                 // Supprimer la formation de la section "Fréquemment achetés ensemble"
//                 formationCard.remove();
                
//                 // Afficher le toast de confirmation
//                 showConfirmationToast('Formation ajoutée au panier');
                
//                 console.log("Formation associée ajoutée avec succès:", formationId);
//             } catch (error) {
//                 console.error("Erreur lors de l'ajout de la formation associée:", error);
//             }
//             }
//         });
//     }
//     function handleAddToCart(e) {
//         // Déterminer d'où vient le clic (carte ou panneau)
//         const target = e.target.closest('.btn-add-to-cart');
//         if (!target) return;
        
//         let formationData;
//         const isFromPanel = target.closest('.panel-content') !== null;
        
//         if (isFromPanel) {
//             console.log("Ajout depuis le panneau de détail");
//             // Pour les clics depuis le panneau, récupérer les données depuis la carte survolée
//             const hoveredCard = document.querySelector('.formation-card:hover');
//             if (hoveredCard) {
//                 formationData = extractFormationDataFromCard(hoveredCard);
//             } else {
//                 // Récupérer certaines données du panneau et essayer de trouver la carte correspondante
//                 const panelContent = target.closest('.panel-content');
//                 const title = panelContent.querySelector('h3').textContent;
                
//                 // Essayer de trouver la carte qui correspond au titre
//                 const allCards = document.querySelectorAll('.formation-card');
//                 const matchingCard = Array.from(allCards).find(card => 
//                     card.querySelector('.formation-title').textContent.trim() === title.trim()
//                 );
                
//                 if (matchingCard) {
//                     formationData = extractFormationDataFromCard(matchingCard);
//                 } else {
//                     // Fallback avec des données limitées du panneau
//                     formationData = {
//                         id: '0',
//                         title: title,
//                         instructor: 'Instructeur',
//                         image: '',
//                         price: '0 DT',
//                         rating: '0',
//                         ratingStars: '',
//                         ratingCount: '(0)',
//                         isBestseller: false,
//                         hasDiscount: false,
//                         originalPrice: '',
//                         discountPercentage: '',
//                         category: ''
//                     };
//                 }
//             }
//         } else {
//             console.log("Ajout depuis la carte de formation");
//             const formationCard = target.closest('.formation-card') || 
//                                   target.closest('.formation-card-container')?.querySelector('.formation-card');
            
//             if (!formationCard) {
//                 console.error("Impossible de trouver la carte de formation");
//                 return;
//             }
            
//             formationData = extractFormationDataFromCard(formationCard);
//         }
//         console.log("Données de formation extraites:", formationData);
//         // Stocker la formation principale
//         cartFormations.unshift(formationData);
//         // Ajouter au panier (API call simulé)
//         addToCart(formationData.id);
        
//         // Réinitialiser la zone d'affichage des formations dans la modale
//             document.getElementById('cart-added-formations').innerHTML = '';
//             const existingFormationIndex = cartFormations.findIndex(f => f.id === formationData.id);
//             if (existingFormationIndex === -1) {
//                 cartFormations.unshift(formationData);
//             }
            
            
//             // Remplir les informations dans la modale
//             populateModal(formationData);
            
//             // Charger les formations associées de la même catégorie, en excluant la formation actuelle
//             loadRelatedFormations(formationData.category, formationData.id);
            
//             // Configurer les boutons d'action
//         setupActionButtons();
        
//         // AJOUT ICI: Masquer le panneau de détail avant d'afficher la modal
//         $('#formation-detail-panel').removeClass('active').css('opacity', 0);
        
//         // Afficher la modale
//         document.getElementById('add-to-cart-modal').style.display = 'block';
//     }

//     // Extraire les données de formation à partir d'une carte de formation
//     function extractFormationDataFromCard(card) {
//         // Extraire le titre
//         const titleElement = card.querySelector('.formation-title');
//         const title = titleElement ? titleElement.textContent.trim() : 'Formation';
        
//         // Extraire l'instructeur
//         const instructorElement = card.querySelector('.formation-instructor');
//         const instructor = instructorElement ? instructorElement.textContent.trim() : 'Instructeur';
        
//         // Extraire l'image
//         let image = '';
//         const imgElement = card.querySelector('img');
//         if (imgElement && imgElement.src) {
//             image = imgElement.src;
//         }
        
//         // Extraire les informations de prix et remises
//         let finalPrice = '0 DT';
//         let hasDiscount = false;
//         let originalPrice = '';
//         let discountPercentage = '';
        
//         // Vérifier si nous avons un prix final
//         const finalPriceElement = card.querySelector('.final-price');
//         if (finalPriceElement) {
//             finalPrice = finalPriceElement.textContent.trim();
            
//             // Vérifier s'il y a une remise
//             const originalPriceElement = card.querySelector('.original-price');
//             if (originalPriceElement) {
//                 hasDiscount = true;
//                 originalPrice = originalPriceElement.textContent.trim();
                
//                 // Chercher le pourcentage de remise s'il existe
//                 const discountElement = card.querySelector('.discount-percentage');
//                 if (discountElement) {
//                     discountPercentage = discountElement.textContent.trim();
//                 } else {
//                     // Calculer le pourcentage si non disponible
//                     // Assurez-vous de convertir les prix en nombres (supprimer les symboles monétaires)
//                     try {
//                         const finalPriceValue = parseFloat(finalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
//                         const originalPriceValue = parseFloat(originalPrice.replace(/[^\d.,]/g, '').replace(',', '.'));
                        
//                         if (originalPriceValue > 0) {
//                             const discount = ((originalPriceValue - finalPriceValue) / originalPriceValue) * 100;
//                             discountPercentage = `-${Math.round(discount)}%`;
//                         }
//                     } catch (e) {
//                         console.error("Erreur lors du calcul de la remise:", e);
//                     }
//                 }
//             }
//         }
        
//         // Informations de notation
//         let rating = '0';
//         let ratingStars = '';
//         let ratingCount = '(0)';
        
//         const ratingValueElement = card.querySelector('.rating-value');
//         if (ratingValueElement) {
//             rating = ratingValueElement.textContent.trim();
            
//             const starsElement = card.querySelector('.rating-stars');
//             if (starsElement) {
//                 ratingStars = starsElement.innerHTML;
//             } else {
//                 ratingStars = generateStars(parseFloat(rating));
//             }
            
//             const countElement = card.querySelector('.rating-count');
//             if (countElement) {
//                 ratingCount = countElement.textContent.trim();
//             }
//         }
//         const isBestseller = card.querySelector('.badge-bestseller') !== null;
        
//         // Essayer d'extraire l'ID de la formation
//         let formationId = '0';
        
//         // Méthode 1: Depuis un attribut data-id
//         if (card.hasAttribute('data-id')) {
//             formationId = card.getAttribute('data-id');
//         } 
//         // Méthode 2: Depuis les boutons d'action
//         else {
//             const actionElements = card.closest('.formation-card-container')?.querySelectorAll('.action-item');
//             if (actionElements && actionElements.length) {
//                 for (const action of actionElements) {
//                     if (action.hasAttribute('data-delete-url')) {
//                         const url = action.getAttribute('data-delete-url');
//                         const matches = url.match(/\/formation\/(\d+)$/);
//                         if (matches && matches[1]) {
//                             formationId = matches[1];
//                             break;
//                         }
//                     } else if (action.hasAttribute('data-edit-url')) {
//                         const url = action.getAttribute('data-edit-url');
//                         const matches = url.match(/\/formation\/(\d+)\/edit$/);
//                         if (matches && matches[1]) {
//                             formationId = matches[1];
//                             break;
//                         }
//                     }
//                 }
//             }
//         }

//         // Extraire la catégorie de la formation
//         let category = '';
//         // Rechercher d'abord dans les attributs data-
//         if (card.hasAttribute('data-category')) {
//             category = card.getAttribute('data-category');
//         } else {
//             // Essayer de trouver un élément contenant la catégorie
//             const categoryElement = card.querySelector('.formation-category');
//             if (categoryElement) {
//                 category = categoryElement.textContent.trim();
//             } else {
//                 // On peut aussi essayer de récupérer la catégorie depuis l'URL ou autre méthode
//                 // Par exemple, si on est sur une page de catégorie, on peut récupérer depuis l'URL
//                 const currentPath = window.location.pathname;
//                 const categoryMatch = currentPath.match(/\/category\/([^\/]+)/);
//                 if (categoryMatch && categoryMatch[1]) {
//                     category = decodeURIComponent(categoryMatch[1]);
//                 }
//             }
//         }
        
//         return {
//             id: formationId,
//             title: title,
//             instructor: instructor,
//             image: image,
//             price: finalPrice,
//             rating: rating,
//             ratingStars: ratingStars,
//             ratingCount: ratingCount,
//             isBestseller: isBestseller,
//             hasDiscount: hasDiscount,
//             originalPrice: originalPrice,
//             discountPercentage: discountPercentage,
//             category: category
//         };
//     }

//     function populateModal(formationData) {
//         document.querySelector('#add-to-cart-modal .formation-title').textContent = formationData.title;
//         document.querySelector('#add-to-cart-modal .formation-instructor').textContent = formationData.instructor;
        
//         // Afficher le prix final
//         const finalPriceElement = document.querySelector('#add-to-cart-modal .final-price');
//         finalPriceElement.textContent = formationData.price;
        
//         // Gérer l'affichage de la remise
//         const discountInfoElement = document.querySelector('#add-to-cart-modal .discount-info');
//         const originalPriceElement = document.querySelector('#add-to-cart-modal .original-price');
//         const discountPercentageElement = document.querySelector('#add-to-cart-modal .discount-percentage');
        
//         if (formationData.hasDiscount) {
//             // Afficher le prix original barré
//             originalPriceElement.textContent = formationData.originalPrice;
//             originalPriceElement.style.textDecoration = 'line-through';
//             originalPriceElement.style.color = '#6a6f73';
//             originalPriceElement.style.marginRight = '8px';
            
//             // Afficher le pourcentage de remise en rouge
//             discountPercentageElement.textContent = formationData.discountPercentage;
//             discountPercentageElement.style.color = '#a10000';
//             discountPercentageElement.style.fontWeight = 'bold';
            
//             // S'assurer que le conteneur de remise est visible
//             discountInfoElement.style.display = 'inline-block';
//         } else {
//             // Cacher les éléments de remise s'il n'y en a pas
//             discountInfoElement.style.display = 'none';
//         }
        
//         const imageElement = document.querySelector('#add-to-cart-modal .formation-image');
//         if (formationData.image && formationData.image !== '') {
//             imageElement.src = formationData.image;
//             imageElement.style.display = 'block';
//         } else {
//             imageElement.src = '/api/placeholder/200/120'; // Image par défaut
//             imageElement.style.display = 'block';
//         }
        
//         // Récupérer les dimensions de l'image principale pour les utiliser plus tard
//         const mainImageWidth = imageElement.clientWidth || 200;
//         const mainImageHeight = imageElement.clientHeight || 120;
        
//         // Stocker ces dimensions dans des attributs data pour les utiliser plus tard
//         document.querySelector('#add-to-cart-modal').setAttribute('data-main-image-width', mainImageWidth);
//         document.querySelector('#add-to-cart-modal').setAttribute('data-main-image-height', mainImageHeight);
        
//         // Afficher ou masquer le badge bestseller
//         const badgeContainer = document.querySelector('#add-to-cart-modal .badge-container');
//         badgeContainer.innerHTML = formationData.isBestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : '';
        
//         // Afficher la note et les étoiles
//         const ratingContainer = document.querySelector('#add-to-cart-modal .formation-rating');
//         if (parseFloat(formationData.rating) > 0) {
//             ratingContainer.innerHTML = `
//                 <span class="rating-value">${formationData.rating}</span>
//                 <span class="rating-stars">${formationData.ratingStars || generateStars(parseFloat(formationData.rating))}</span>
//                 <span class="rating-count">${formationData.ratingCount}</span>
//             `;
//             ratingContainer.style.display = 'flex';
//         } else {
//             ratingContainer.style.display = 'none';
//         }
//     }

// function addFormationToCartDisplay(formationData) {
//     // Vérifier si cette formation est déjà dans la liste en utilisant une comparaison stricte
//     const existingFormationIndex = cartFormations.findIndex(f => f.id === formationData.id);
    
//     if (existingFormationIndex === -1) {
//         // Ajouter à notre liste de suivi seulement si elle n'existe pas déjà
//         cartFormations.push(formationData);
//     } else {
//         // Si la formation existe déjà, pas besoin de l'ajouter à nouveau
//         console.log("Formation déjà dans le panier:", formationData.id);
//         return;
//     }
//      // Créer l'élément HTML pour la formation
//     const cartFormationElement = document.createElement('div');
//     cartFormationElement.className = 'formation-details';
//     cartFormationElement.setAttribute('data-id', formationData.id);
    
//     // Préparer l'affichage du prix avec remise si applicable
//     let priceHTML = '';
//     if (formationData.hasDiscount) {
//         priceHTML = `
//             <div class="formation-price">
//                 <span class="final-price">${formationData.price}</span>
//                 <div class="discount-info">
//                     <span class="original-price">${formationData.originalPrice}</span>
//                     <span class="discount-percentage">${formationData.discountPercentage}</span>
//                 </div>
//             </div>
//         `;
//     } else {
//         priceHTML = `<div class="formation-price"><span class="final-price">${formationData.price}</span></div>`;
//     }
    
//     // Gérer correctement l'affichage de la notation
//     let ratingHTML = '';
//     if (parseFloat(formationData.rating) > 0) {
//         ratingHTML = `
//             <div class="formation-rating">
//                 <span class="rating-value">${formationData.rating}</span>
//                 <span class="rating-stars">${formationData.ratingStars || generateStars(parseFloat(formationData.rating))}</span>
//                 <span class="rating-count">${formationData.ratingCount}</span>
//             </div>
//         `;
//     }
    
//     // HTML de la formation ajoutée
//     cartFormationElement.innerHTML = `
//         <div class="formation-image-container">
//             <img class="formation-image" src="${formationData.image}" alt="${formationData.title}">
//         </div>
//         <div class="formation-info">
//             <h3 class="formation-title">${formationData.title}</h3>
//             <p class="formation-instructor">${formationData.instructor}</p>
//             ${ratingHTML}
//             ${priceHTML}
//             <div class="badge-container">
//                 ${formationData.isBestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : ''}
//             </div>
//         </div>
//     `;
    
//     // Ajouter un séparateur avant la nouvelle formation (sauf pour la première)
//     const container = document.getElementById('cart-added-formations');
//     if (container.children.length > 0) {
//         const divider = document.createElement('div');
//         divider.className = 'formation-divider';
//         divider.style.height = '1px';
//         divider.style.backgroundColor = '#e0e0e0';
//         divider.style.margin = '20px 0';
//         container.appendChild(divider);
//     }
    
//     // Ajouter au DOM
//     container.appendChild(cartFormationElement);
    

//     // Supprimer cette formation de la section "Vous pouvez acheter" si elle y est présente
//     const relatedFormationCard = document.querySelector(`.related-formation-card[data-id="${formationData.id}"]`);
//     if (relatedFormationCard) {
//         relatedFormationCard.remove();
        
//         // Vérifier s'il reste des formations dans la section
//         const remainingCards = document.querySelectorAll('.related-formation-card');
//         if (remainingCards.length === 0) {
//             // Masquer la section "Vous pouvez acheter" s'il n'y a plus de formations
//             hideRelatedFormationsSection();
//         }
//     }
    
//     // Debug pour confirmer l'ajout
//     console.log("Formation ajoutée à l'affichage:", formationData.id, formationData.title);
// }

// // Améliorer la fonction getFormationsFromPage pour mieux détecter les formations de même catégorie
// function getFormationsFromPage(currentFormationId, count, category) {
//     const allCards = document.querySelectorAll('.formation-card');
//     console.log("Cartes trouvées sur la page:", allCards.length);
//     console.log("Formation actuelle ID:", currentFormationId);
//     console.log("Catégorie recherchée:", category);
    
//     // Filtrer pour exclure la formation actuelle, celles déjà dans le panier
//     const availableCards = Array.from(allCards).filter(card => {
//         const cardId = (card.getAttribute('data-id') || '0').toString();
        
//         // Exclure la formation actuelle
//         if (cardId === currentFormationId.toString()) {
//             return false;
//         }
        
//         // Exclure les formations déjà dans le panier
//         for (let i = 0; i < cartFormations.length; i++) {
//             if (cartFormations[i].id.toString() === cardId) {
//                 return false;
//             }
//         }
        
//         // Vérifier la catégorie de la carte (plusieurs méthodes)
//         if (category && category.trim() !== '') {
//             // Méthode 1: attribut data-category
//             const cardCategory = card.getAttribute('data-category') || '';
            
//             // Méthode 2: élément de catégorie dans la carte
//             const categoryElement = card.querySelector('.formation-category');
//             const elementCategory = categoryElement ? categoryElement.textContent.trim() : '';
            
//             // Méthode 3: vérifier si on est sur une page de catégorie
//             const currentPath = window.location.pathname;
//             const pathCategory = currentPath.match(/\/category\/([^\/]+)/) ? 
//                 decodeURIComponent(currentPath.match(/\/category\/([^\/]+)/)[1]) : '';
            
//             // Si une des méthodes trouve la bonne catégorie, on garde la carte
//             return (cardCategory.trim() === category.trim()) || 
//                    (elementCategory === category.trim()) || 
//                    (pathCategory === category.trim());
//         }
        
//         return true;
//     });
    
//     console.log("Cartes disponibles après filtrage:", availableCards.length);
    
//     if (availableCards.length > 0) {
//         // Mélanger et prendre les 'count' premières cartes
//         const shuffled = availableCards.sort(() => 0.5 - Math.random());
//         const numToSelect = Math.min(count, shuffled.length);
//         const selected = shuffled.slice(0, numToSelect);
        
//         // Extraire les données des cartes sélectionnées
//         const relatedFormations = selected.map(card => extractFormationDataFromCard(card));
//         console.log("Formations à afficher:", relatedFormations.map(f => f.id));
        
//         // Afficher les formations
//         displayRelatedFormations(relatedFormations);
//         return true;
//     }
    
//     return false;
// }


// // Fonction pour masquer la section "Vous pouvez acheter"
// function hideRelatedFormationsSection() {
//     const relatedSection = document.querySelector('.related-formations');
//     if (relatedSection) {
//         relatedSection.style.display = 'none';
//     }
// }


// // Rechercher des formations sur la page actuelle
// // function getFormationsFromPage(currentFormationId, count, category) {
// //     const allCards = document.querySelectorAll('.formation-card');
// //     console.log("Cartes trouvées sur la page:", allCards.length);
// //     console.log("Formation actuelle ID:", currentFormationId);
// //     console.log("Catégorie recherchée:", category);
    
// //     // Filtrer pour exclure la formation actuelle, celles déjà dans le panier, et inclure seulement celles de la même catégorie
// //     const availableCards = Array.from(allCards).filter(card => {
// //         const cardId = (card.getAttribute('data-id') || '0').toString();
        
// //         // Exclure la formation actuelle
// //         if (cardId === currentFormationId.toString()) {
// //             return false;
// //         }
        
// //         // Exclure les formations déjà dans le panier
// //         for (let i = 0; i < cartFormations.length; i++) {
// //             if (cartFormations[i].id.toString() === cardId) {
// //                 return false;
// //             }
// //         }
        
// //         // Vérifier la catégorie de la carte (si elle est spécifiée)
// //         if (category && category.trim() !== '') {
// //             const cardCategory = card.getAttribute('data-category') || '';
// //             // Ne garder que les cartes de la même catégorie
// //             if (cardCategory.trim() !== category.trim()) {
// //                 return false;
// //             }
// //         }
        
// //         return true;
// //     });
    
// //     console.log("Cartes disponibles après filtrage:", availableCards.length);
    
// //     if (availableCards.length > 0) {
// //         // Mélanger et prendre les 'count' premières cartes (ou moins si pas assez)
// //         const shuffled = availableCards.sort(() => 0.5 - Math.random());
// //         const numToSelect = Math.min(count, shuffled.length);
// //         const selected = shuffled.slice(0, numToSelect);
        
// //         // Extraire les données des cartes sélectionnées
// //         const relatedFormations = selected.map(card => extractFormationDataFromCard(card));
// //         console.log("Formations à afficher:", relatedFormations.map(f => f.id));
// //         displayRelatedFormations(relatedFormations);
// //         return true;
// //     } else {
// //         // Si aucune formation n'est trouvée, masquer la section "Vous pouvez acheter"
// //         hideRelatedFormationsSection();
// //         return false;
// //     }
// // }
   
//     // Afficher les formations associées dans la modale
//     // function displayRelatedFormations(relatedFormations) {
//     //     const relatedContainer = document.querySelector('.related-formations-container');
//     //     relatedContainer.innerHTML = '';
        
//     //     // Récupérer les dimensions de l'image principale
//     //     const mainImageWidth = document.querySelector('#add-to-cart-modal').getAttribute('data-main-image-width') || 200;
//     //     const mainImageHeight = document.querySelector('#add-to-cart-modal').getAttribute('data-main-image-height') || 120;
        
//     //     relatedFormations.forEach(formation => {
//     //         // Préparer l'affichage du prix avec remise si applicable
//     //         let priceHTML = '';
//     //         if (formation.hasDiscount) {
//     //             priceHTML = `
//     //                 <div class="related-formation-price">
//     //                     <span class="final-price">${formation.price}</span>
//     //                     <span class="original-price" style="text-decoration: line-through; color: #6a6f73; font-size: 0.9em;">${formation.originalPrice}</span>
//     //                     <span class="discount-percentage" style="color: #a10000; font-weight: bold;">${formation.discountPercentage}</span>
//     //                 </div>
//     //             `;
//     //         } else {
//     //             priceHTML = `<div class="related-formation-price">${formation.price}</div>`;
//     //         }
            
//     //         const cardHTML = `
//     //             <div class="related-formation-card" data-id="${formation.id}">
//     //                 ${formation.isBestseller ? '<span class="badge-bestseller-small">Meilleure vente</span>' : ''}
//     //                 <img class="related-formation-image" src="${formation.image}" alt="${formation.title}" 
//     //                      style="width: ${mainImageWidth}px; height: ${mainImageHeight}px; object-fit: cover;">
//     //                 <div class="related-formation-info">
//     //                     <h4 class="related-formation-title">${formation.title}</h4>
//     //                     <p class="related-formation-instructor">${formation.instructor}</p>
//     //                     <div class="related-formation-rating">
//     //                         <span class="rating-value">${formation.rating}</span>
//     //                         <span class="rating-stars">${generateStars(formation.rating)}</span>
//     //                         <span class="rating-count">(${formation.ratingCount})</span>
//     //                     </div>
//     //                     ${priceHTML}
//     //                     <button class="add-related-btn" data-id="${formation.id}">+</button>
//     //                 </div>
//     //             </div>
//     //         `;
            
//     //         relatedContainer.insertAdjacentHTML('beforeend', cardHTML);
//     //     });
//     // }
//     // Modifier cette fonction pour afficher/masquer la section correctement
// function loadRelatedFormations(category, currentFormationId) {
//     console.log("Chargement des formations de la catégorie:", category);
    
//     // Référence à la section complète
//     const relatedSection = document.querySelector('.related-formations');
    
//     // Si pas de catégorie, masquer la section et sortir
//     if (!category || category.trim() === '') {
//         if (relatedSection) relatedSection.style.display = 'none';
//         return;
//     }

//     // Essayer d'abord de trouver des formations sur la page
//     const allCards = document.querySelectorAll('.formation-card');
//     console.log("Cartes trouvées sur la page:", allCards.length);
    
//     // Filtrer pour exclure la formation actuelle, celles déjà dans le panier
//     const availableCards = Array.from(allCards).filter(card => {
//         const cardId = (card.getAttribute('data-id') || '0').toString();
        
//         // Exclure la formation actuelle
//         if (cardId === currentFormationId.toString()) {
//             return false;
//         }
        
//         // Exclure les formations déjà dans le panier
//         for (let i = 0; i < cartFormations.length; i++) {
//             if (cartFormations[i].id.toString() === cardId) {
//                 return false;
//             }
//         }
        
//         // Vérifier la catégorie de la carte (plusieurs méthodes)
//         if (category && category.trim() !== '') {
//             // Méthode 1: attribut data-category
//             const cardCategory = card.getAttribute('data-category') || '';
            
//             // Méthode 2: élément de catégorie dans la carte
//             const categoryElement = card.querySelector('.formation-category');
//             const elementCategory = categoryElement ? categoryElement.textContent.trim() : '';
            
//             // Méthode 3: vérifier si on est sur une page de catégorie
//             const currentPath = window.location.pathname;
//             const pathCategory = currentPath.match(/\/category\/([^\/]+)/) ? 
//                 decodeURIComponent(currentPath.match(/\/category\/([^\/]+)/)[1]) : '';
            
//             // Si une des méthodes trouve la bonne catégorie, on garde la carte
//             return (cardCategory.trim() === category.trim()) || 
//                    (elementCategory === category.trim()) || 
//                    (pathCategory === category.trim());
//         }
        
//         return true;
//     });
    
//     console.log("Cartes disponibles après filtrage:", availableCards.length);
    
//     if (availableCards.length > 0) {
//         // La section devrait être visible
//         if (relatedSection) {
//             relatedSection.style.display = 'block';
            
//             // Mettre à jour le titre
//             const titleElement = relatedSection.querySelector('h3');
//             if (titleElement) {
//                 titleElement.textContent = 'Fréquemment achetés ensemble';
//             }
//         }
        
//         // Mélanger et prendre jusqu'à 2 formations
//         const shuffled = availableCards.sort(() => 0.5 - Math.random());
//         const selected = shuffled.slice(0, Math.min(2, shuffled.length));
        
//         // Extraire les données des cartes sélectionnées
//         const relatedFormations = selected.map(card => extractFormationDataFromCard(card));
//         console.log("Formations à afficher:", relatedFormations.map(f => f.id));
        
//         // Afficher les formations
//         displayRelatedFormations(relatedFormations);
//     } else {
//         // Pas de formations trouvées, masquer la section
//         if (relatedSection) relatedSection.style.display = 'none';
        
//         // Essayer l'API comme fallback (si vous avez une API fonctionnelle)
//         tryLoadFromAPI(category, currentFormationId);
//     }
// }

// // Fonction auxiliaire pour essayer de charger via API (optionnel)
// function tryLoadFromAPI(category, currentFormationId) {
//     fetch(`/api/formations?category=${encodeURIComponent(category)}&exclude=${currentFormationId}`)
//         .then(response => {
//             if (response.ok) return response.json();
//             throw new Error('API non disponible');
//         })
//         .then(data => {
//             if (data && Array.isArray(data) && data.length > 0) {
//                 // Filtrer pour exclure les formations déjà dans le panier
//                 const filteredData = data.filter(formation => {
//                     const formationId = formation.id.toString();
//                     if (formationId === currentFormationId.toString()) return false;
                    
//                     for (let i = 0; i < cartFormations.length; i++) {
//                         if (cartFormations[i].id.toString() === formationId) return false;
//                     }
//                     return true;
//                 });
                
//                 if (filteredData.length > 0) {
//                     // Sélectionner aléatoirement 2 formations max
//                     const selected = filteredData.sort(() => 0.5 - Math.random()).slice(0, 2);
                    
//                     // Rendre la section visible
//                     const relatedSection = document.querySelector('.related-formations');
//                     if (relatedSection) {
//                         relatedSection.style.display = 'block';
                        
//                         // Mettre à jour le titre
//                         const titleElement = relatedSection.querySelector('h3');
//                         if (titleElement) {
//                             titleElement.textContent = 'Fréquemment achetés ensemble';
//                         }
//                     }
                    
//                     displayRelatedFormations(selected);
//                 }
//             }
//         })
//         .catch(error => {
//             console.warn("Erreur API:", error);
//             // Garder la section masquée en cas d'erreur
//         });
// }

// // Assurez-vous que cette fonction est simplifiée et prête à recevoir des données
// function displayRelatedFormations(relatedFormations) {
//     const relatedContainer = document.querySelector('.related-formations-container');
//     if (!relatedContainer) return;
    
//     relatedContainer.innerHTML = '';
    
//     // Récupérer les dimensions de l'image principale ou utiliser des valeurs par défaut
//     const mainImageWidth = 200;
//     const mainImageHeight = 120;
    
//     relatedFormations.forEach(formation => {
//         // Préparer l'affichage du prix avec remise si applicable
//         let priceHTML = '';
//         if (formation.hasDiscount) {
//             priceHTML = `
//                 <div class="related-formation-price">
//                     <span class="final-price">${formation.price}</span>
//                     <span class="original-price" style="text-decoration: line-through; color: #6a6f73; font-size: 0.9em;">${formation.originalPrice}</span>
//                     <span class="discount-percentage" style="color: #a10000; font-weight: bold;">${formation.discountPercentage}</span>
//                 </div>
//             `;
//         } else {
//             priceHTML = `<div class="related-formation-price">${formation.price}</div>`;
//         }
        
//         const cardHTML = `
//             <div class="related-formation-card" data-id="${formation.id}">
//                 ${formation.isBestseller ? '<span class="badge-bestseller-small">Meilleure vente</span>' : ''}
//                 <img class="related-formation-image" src="${formation.image}" alt="${formation.title}" 
//                      style="width: ${mainImageWidth}px; height: ${mainImageHeight}px; object-fit: cover;">
//                 <div class="related-formation-info">
//                     <h4 class="related-formation-title">${formation.title}</h4>
//                     <p class="related-formation-instructor">${formation.instructor}</p>
//                     <div class="related-formation-rating">
//                         <span class="rating-value">${formation.rating}</span>
//                         <span class="rating-stars">${generateStars(parseFloat(formation.rating))}</span>
//                         <span class="rating-count">${formation.ratingCount}</span>
//                     </div>
//                     ${priceHTML}
//                     <button class="add-related-btn" data-id="${formation.id}">+</button>
//                 </div>
//             </div>
//         `;
        
//         relatedContainer.insertAdjacentHTML('beforeend', cardHTML);
//     });
    
//     // Assurer que la section est visible
//     const relatedSection = document.querySelector('.related-formations');
//     if (relatedSection && relatedFormations.length > 0) {
//         relatedSection.style.display = 'block';
//     } else if (relatedSection) {
//         relatedSection.style.display = 'none';
//     }
// }

//     // Configurer les boutons d'action dans la modale
//     function setupActionButtons() {
//         const payBtn = document.querySelector('#add-to-cart-modal .btn-pay');
//         const cartBtn = document.querySelector('#add-to-cart-modal .btn-view-cart');
        
//         // Supprimer les écouteurs d'événements existants
//         payBtn.replaceWith(payBtn.cloneNode(true));
//         cartBtn.replaceWith(cartBtn.cloneNode(true));
        
//         // Ajouter de nouveaux écouteurs
//         document.querySelector('#add-to-cart-modal .btn-pay').addEventListener('click', function() {
//             window.location.href = '/checkout';
//         });
        
//         document.querySelector('#add-to-cart-modal .btn-view-cart').addEventListener('click', function() {
//             window.location.href = '/panier';
//         });
//     }

//     // Fonction pour générer des étoiles en fonction de la note
//     function generateStars(rating) {
//         const fullStars = Math.floor(rating);
//         const decimalPart = rating - fullStars;
//         const hasHalfStar = decimalPart >= 0.25;
        
//         let starsHtml = '';
//         for (let i = 1; i <= 5; i++) {
//             if (i <= fullStars) {
//                 starsHtml += '<i class="fas fa-star"></i>';
//             } else if (i === fullStars + 1 && hasHalfStar) {
//                 starsHtml += '<i class="fas fa-star-half-alt"></i>';
//             } else {
//                 starsHtml += '<i class="far fa-star"></i>';
//             }
//         }
//         return starsHtml;
//     }

//     // Fonction pour ajouter une formation au panier
// function addToCart(formationId) {
//     // Envoyer une requête AJAX pour ajouter la formation au panier côté serveur
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
        
//         // Mettre à jour le compteur du panier dans l'interface
//         updateCartCounter();
//          // Mettre à jour l'état des boutons d'ajout au panier
//         updateCartButtons(); // Ajoutez cette ligne
//         // Supprimer cette formation de la section "Vous pouvez acheter" si elle y est présente
//         const relatedFormationCard = document.querySelector(`.related-formation-card[data-id="${formationId}"]`);
//         if (relatedFormationCard) {
//             relatedFormationCard.remove();
            
//             // Vérifier s'il reste des formations dans la section
//             const remainingCards = document.querySelectorAll('.related-formation-card');
//             if (remainingCards.length === 0) {
//                 // Masquer la section "Vous pouvez acheter" s'il n'y a plus de formations
//                 const relatedSection = document.querySelector('.related-formations');
//                 if (relatedSection) {
//                     relatedSection.style.display = 'none';
//                 }
//             }
//         }
        
//         // Option: Afficher un message de succès personnalisé si le serveur en renvoie un
//         if (data.message) {
//             showConfirmationToast(data.message);
//         }
//     })
//     .catch(error => {
//         console.error('Erreur:', error);
//         showConfirmationToast('Erreur lors de l\'ajout au panier');
//     });
// }

//     // Mettre à jour le compteur du panier dans l'interface (si disponible)
//     function updateCartCounter() {
//         const cartCounterElement = document.querySelector('.cart-counter');
//         if (cartCounterElement) {
//             // Obtenir le nombre actuel et l'incrémenter
//             let currentCount = parseInt(cartCounterElement.textContent) || 0;
//             cartCounterElement.textContent = currentCount + 1;
            
//             // Assurer la visibilité du compteur
//             cartCounterElement.style.display = 'inline-block';
//         }
//     }
//     // Afficher un toast de confirmation
//     function showConfirmationToast(message) {
//         const toast = document.getElementById('confirmation-toast');
//         const toastMessage = document.querySelector('.toast-message');
//         if (toast && toastMessage) {
//             toastMessage.textContent = message;
//             toast.style.display = 'block';
//             toast.style.animation = 'none';
//             toast.offsetHeight; // Forcer un reflow
//             toast.style.animation = 'toastIn 0.3s, toastOut 0.3s 2.7s';
            
//             setTimeout(function() {
//                 toast.style.display = 'none';
//             }, 3000);
//         }
//     }
//     updateCartButtons();

// })();