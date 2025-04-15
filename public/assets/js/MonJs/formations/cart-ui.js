// cart-ui.js - Fonctions d'interface utilisateur du panier

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation UI
    initCartUI();
});

function initCartUI() {
    createModalIfNeeded();
    setupModalEventListeners();
}

function createModalIfNeeded() {
    if (!document.getElementById('add-to-cart-modal')) {
        const modalHTML = `
            <div id="add-to-cart-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Ajouté au panier</h2>
                        <span class="close-modal">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="formation-details">
                            <div class="formation-image-container">
                                <img class="formation-image" src="" alt="Image de formation">
                            </div>
                            <div class="formation-info">
                                <h3 class="formation-title"></h3>
                                <p class="formation-instructor"></p>
                                <div class="formation-rating"></div>
                                <div class="formation-price">
                                    <span class="final-price"></span>
                                    <div class="discount-info">
                                        <span class="original-price"></span>
                                        <span class="discount-percentage"></span>
                                    </div>
                                </div>
                                <div class="badge-container"></div>
                            </div>
                        </div>
                        <div id="cart-added-formations">
                            <!-- Les formations ajoutées s'afficheront ici -->
                        </div>
                        <div class="modal-actions">
                            <button class="btn-pay">Réserver <i class="fas fa-arrow-right"></i></button>
                            <button class="btn-view-cart">Accéder au panier <i class="fas fa-shopping-cart"></i></button>
                        </div>
                        <div class="related-formations">
                            <h3>Vous pouvez achetez </h3>
                            <div class="related-formations-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        <link rel="stylesheet" href="/assets/css/MonCss/cart-modal.css">
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }
    
    // Toast de confirmation
    if (!document.getElementById('confirmation-toast')) {
        const toastHTML = `
            <div id="confirmation-toast">
                <div class="toast-content">
                    <i class="fas fa-check-circle"></i>
                    <span class="toast-message"></span>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', toastHTML);
    }
}

function setupModalEventListeners() {
    const modal = document.getElementById('add-to-cart-modal');
    const closeModalBtn = document.querySelector('.close-modal');
    
    // Masquer le panneau de détail lorsque la modal est ouverte
    if (modal) {
        modal.addEventListener('show', function() {
            $('#formation-detail-panel').removeClass('active').css('opacity', 0);
        });
    }
    
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }
    
    // Fermer la modale en cliquant en dehors
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

function populateModal(formationData) {
    document.querySelector('#add-to-cart-modal .formation-title').textContent = formationData.title;
    document.querySelector('#add-to-cart-modal .formation-instructor').textContent = formationData.instructor;
    
    // Afficher le prix final
    const finalPriceElement = document.querySelector('#add-to-cart-modal .final-price');
    finalPriceElement.textContent = formationData.price;
    
    // Gérer l'affichage de la remise
    const discountInfoElement = document.querySelector('#add-to-cart-modal .discount-info');
    const originalPriceElement = document.querySelector('#add-to-cart-modal .original-price');
    const discountPercentageElement = document.querySelector('#add-to-cart-modal .discount-percentage');
    
    if (formationData.hasDiscount) {
        // Afficher le prix original barré
        originalPriceElement.textContent = formationData.originalPrice;
        originalPriceElement.style.textDecoration = 'line-through';
        originalPriceElement.style.color = '#6a6f73';
        originalPriceElement.style.marginRight = '8px';
        
        // Afficher le pourcentage de remise en rouge
        discountPercentageElement.textContent = formationData.discountPercentage;
        discountPercentageElement.style.color = '#a10000';
        discountPercentageElement.style.fontWeight = 'bold';
        
        // S'assurer que le conteneur de remise est visible
        discountInfoElement.style.display = 'inline-block';
    } else {
        // Cacher les éléments de remise s'il n'y en a pas
        discountInfoElement.style.display = 'none';
    }
    
    const imageElement = document.querySelector('#add-to-cart-modal .formation-image');
    if (formationData.image && formationData.image !== '') {
        imageElement.src = formationData.image;
        imageElement.style.display = 'block';
    } else {
        imageElement.src = '/api/placeholder/200/120'; // Image par défaut
        imageElement.style.display = 'block';
    }
    
    // Récupérer les dimensions de l'image principale pour les utiliser plus tard
    const mainImageWidth = imageElement.clientWidth || 200;
    const mainImageHeight = imageElement.clientHeight || 120;
    
    // Stocker ces dimensions dans des attributs data pour les utiliser plus tard
    document.querySelector('#add-to-cart-modal').setAttribute('data-main-image-width', mainImageWidth);
    document.querySelector('#add-to-cart-modal').setAttribute('data-main-image-height', mainImageHeight);
    
    // Afficher ou masquer le badge bestseller
    const badgeContainer = document.querySelector('#add-to-cart-modal .badge-container');
    badgeContainer.innerHTML = formationData.isBestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : '';
    
    // Afficher la note et les étoiles
    const ratingContainer = document.querySelector('#add-to-cart-modal .formation-rating');
    if (parseFloat(formationData.rating) > 0) {
        ratingContainer.innerHTML = `
            <span class="rating-value">${formationData.rating}</span>
            <span class="rating-stars">${formationData.ratingStars || generateStars(parseFloat(formationData.rating))}</span>
            <span class="rating-count">${formationData.ratingCount}</span>
        `;
        ratingContainer.style.display = 'flex';
    } else {
        ratingContainer.style.display = 'none';
    }
}

function addFormationToCartDisplay(formationData) {
    // Vérifier si cette formation est déjà dans la liste en utilisant une comparaison stricte
    const existingFormationIndex = window.cartFormations.findIndex(f => f.id === formationData.id);
    
    if (existingFormationIndex === -1) {
        // Ajouter à notre liste de suivi seulement si elle n'existe pas déjà
        window.cartFormations.push(formationData);
    } else {
        // Si la formation existe déjà, pas besoin de l'ajouter à nouveau
        console.log("Formation déjà dans le panier:", formationData.id);
        return;
    }
     // Créer l'élément HTML pour la formation
    const cartFormationElement = document.createElement('div');
    cartFormationElement.className = 'formation-details';
    cartFormationElement.setAttribute('data-id', formationData.id);
    
    // Préparer l'affichage du prix avec remise si applicable
    let priceHTML = '';
    if (formationData.hasDiscount) {
        priceHTML = `
            <div class="formation-price">
                <span class="final-price">${formationData.price}</span>
                <div class="discount-info">
                    <span class="original-price">${formationData.originalPrice}</span>
                    <span class="discount-percentage">${formationData.discountPercentage}</span>
                </div>
            </div>
        `;
    } else {
        priceHTML = `<div class="formation-price"><span class="final-price">${formationData.price}</span></div>`;
    }
    
    // Gérer correctement l'affichage de la notation
    let ratingHTML = '';
    if (parseFloat(formationData.rating) > 0) {
        ratingHTML = `
            <div class="formation-rating">
                <span class="rating-value">${formationData.rating}</span>
                <span class="rating-stars">${formationData.ratingStars || generateStars(parseFloat(formationData.rating))}</span>
                <span class="rating-count">${formationData.ratingCount}</span>
            </div>
        `;
    }
    
    // HTML de la formation ajoutée
    cartFormationElement.innerHTML = `
        <div class="formation-image-container">
            <img class="formation-image" src="${formationData.image}" alt="${formationData.title}">
        </div>
        <div class="formation-info">
            <h3 class="formation-title">${formationData.title}</h3>
            <p class="formation-instructor">${formationData.instructor}</p>
            ${ratingHTML}
            ${priceHTML}
            <div class="badge-container">
                ${formationData.isBestseller ? '<span class="badge-bestseller">Meilleure vente</span>' : ''}
            </div>
        </div>
    `;
    
    // Ajouter un séparateur avant la nouvelle formation (sauf pour la première)
    const container = document.getElementById('cart-added-formations');
    if (container.children.length > 0) {
        const divider = document.createElement('div');
        divider.className = 'formation-divider';
        divider.style.height = '1px';
        divider.style.backgroundColor = '#e0e0e0';
        divider.style.margin = '20px 0';
        container.appendChild(divider);
    }
    
    // Ajouter au DOM
    container.appendChild(cartFormationElement);
    

    // Supprimer cette formation de la section "Vous pouvez acheter" si elle y est présente
    const relatedFormationCard = document.querySelector(`.related-formation-card[data-id="${formationData.id}"]`);
    if (relatedFormationCard) {
        relatedFormationCard.remove();
        
        // Vérifier s'il reste des formations dans la section
        const remainingCards = document.querySelectorAll('.related-formation-card');
        if (remainingCards.length === 0) {
            // Masquer la section "Vous pouvez acheter" s'il n'y a plus de formations
            hideRelatedFormationsSection();
        }
    }
    
    // Debug pour confirmer l'ajout
    console.log("Formation ajoutée à l'affichage:", formationData.id, formationData.title);
}

function hideRelatedFormationsSection() {
    const relatedSection = document.querySelector('.related-formations');
    if (relatedSection) {
        relatedSection.style.display = 'none';
    }
}

function loadRelatedFormations(category, currentFormationId) {
    console.log("Chargement des formations de la catégorie:", category);
    
    // Si pas de catégorie, masquer la section et sortir
    if (!category || category.trim() === '') {
        const relatedSection = document.querySelector('.related-formations');
        if (relatedSection) {
            relatedSection.style.display = 'none';
        }
        return;
    }

    console.log("Formations actuellement dans le panier:", window.cartFormations.map(f => f.id));
    
    // Simuler un appel AJAX avec fetch pour obtenir les formations associées
    fetch(`/api/formations?category=${encodeURIComponent(category)}&exclude=${currentFormationId}`)
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            // En cas d'erreur ou si l'API n'existe pas, on utilise des cartes de la page
            throw new Error('API non disponible');
        })
        .then(data => {
            if (data && Array.isArray(data) && data.length > 0) {
                // Filtrer pour exclure les formations déjà dans le panier ET la formation actuelle
                const filteredData = data.filter(formation => {
                    const formationId = formation.id.toString();
                    // Exclure la formation actuelle
                    if (formationId === currentFormationId.toString()) {
                        return false;
                    }
                    // Exclure toutes les formations déjà dans le panier
                    for (let i = 0; i < window.cartFormations.length; i++) {
                        if (window.cartFormations[i].id.toString() === formationId) {
                            return false;
                        }
                    }
                    // S'assurer que la formation appartient à la même catégorie
                    return formation.category === category;
                });
                
                console.log("Formations filtrées:", filteredData.length);
                
                if (filteredData.length > 0) {
                    // Sélectionner aléatoirement 2 formations
                    const shuffled = filteredData.sort(() => 0.5 - Math.random());
                    const selected = shuffled.slice(0, 2);
                    displayRelatedFormations(selected);
                } else {
                    // Pas de formations à afficher, masquer la section
                    hideRelatedFormationsSection();
                }
            } else {
                // Pas de formations trouvées via l'API, chercher sur la page
                const foundFormations = getFormationsFromPage(currentFormationId, 2, category);
                if (!foundFormations) {
                    hideRelatedFormationsSection();
                }
            }
        })
        .catch(error => {
            console.warn("Erreur lors du chargement des formations associées:", error);
            // En cas d'erreur, chercher sur la page
            const foundFormations = getFormationsFromPage(currentFormationId, 2, category);
            if (!foundFormations) {
                hideRelatedFormationsSection();
            }
        });
}

// Rechercher des formations sur la page actuelle
function getFormationsFromPage(currentFormationId, count, category) {
    const allCards = document.querySelectorAll('.formation-card');
    console.log("Cartes trouvées sur la page:", allCards.length);
    console.log("Formation actuelle ID:", currentFormationId);
    console.log("Catégorie recherchée:", category);
    
    // Filtrer pour exclure la formation actuelle, celles déjà dans le panier, et inclure seulement celles de la même catégorie
    const availableCards = Array.from(allCards).filter(card => {
        const cardId = (card.getAttribute('data-id') || '0').toString();
        
        // Exclure la formation actuelle
        if (cardId === currentFormationId.toString()) {
            return false;
        }
        
        // Exclure les formations déjà dans le panier
        for (let i = 0; i < window.cartFormations.length; i++) {
            if (window.cartFormations[i].id.toString() === cardId) {
                return false;
            }
        }
        
        // Vérifier la catégorie de la carte (si elle est spécifiée)
        if (category && category.trim() !== '') {
            const cardCategory = card.getAttribute('data-category') || '';
            // Ne garder que les cartes de la même catégorie
            if (cardCategory.trim() !== category.trim()) {
                return false;
            }
        }
        
        return true;
    });
    
    console.log("Cartes disponibles après filtrage:", availableCards.length);
    
    if (availableCards.length > 0) {
        // Mélanger et prendre les 'count' premières cartes (ou moins si pas assez)
        const shuffled = availableCards.sort(() => 0.5 - Math.random());
        const numToSelect = Math.min(count, shuffled.length);
        const selected = shuffled.slice(0, numToSelect);
        
        // Extraire les données des cartes sélectionnées
        const relatedFormations = selected.map(card => extractFormationDataFromCard(card));
        console.log("Formations à afficher:", relatedFormations.map(f => f.id));
        displayRelatedFormations(relatedFormations);
        return true;
    } else {
        // Si aucune formation n'est trouvée, masquer la section "Vous pouvez acheter"
        hideRelatedFormationsSection();
        return false;
    }
}

// Afficher les formations associées dans la modale
function displayRelatedFormations(relatedFormations) {
    const relatedContainer = document.querySelector('.related-formations-container');
    relatedContainer.innerHTML = '';
    
    // Récupérer les dimensions de l'image principale
    const mainImageWidth = document.querySelector('#add-to-cart-modal').getAttribute('data-main-image-width') || 200;
    const mainImageHeight = document.querySelector('#add-to-cart-modal').getAttribute('data-main-image-height') || 120;
    
    relatedFormations.forEach(formation => {
        // Préparer l'affichage du prix avec remise si applicable
        let priceHTML = '';
        if (formation.hasDiscount) {
            priceHTML = `
                <div class="related-formation-price">
                    <span class="final-price">${formation.price}</span>
                    <span class="original-price" style="text-decoration: line-through; color: #6a6f73; font-size: 0.9em;">${formation.originalPrice}</span>
                    <span class="discount-percentage" style="color: #a10000; font-weight: bold;">${formation.discountPercentage}</span>
                </div>
            `;
        } else {
            priceHTML = `<div class="related-formation-price">${formation.price}</div>`;
        }
        
        const cardHTML = `
            <div class="related-formation-card" data-id="${formation.id}">
                ${formation.isBestseller ? '<span class="badge-bestseller-small">Meilleure vente</span>' : ''}
                <img class="related-formation-image" src="${formation.image}" alt="${formation.title}" 
                     style="width: ${mainImageWidth}px; height: ${mainImageHeight}px; object-fit: cover;">
                <div class="related-formation-info">
                    <h4 class="related-formation-title">${formation.title}</h4>
                    <p class="related-formation-instructor">${formation.instructor}</p>
                    <div class="related-formation-rating">
                        <span class="rating-value">${formation.rating}</span>
                        <span class="rating-stars">${generateStars(formation.rating)}</span>
                        <span class="rating-count">(${formation.ratingCount})</span>
                    </div>
                    ${priceHTML}
                    <button class="add-related-btn" data-id="${formation.id}">+</button>
                </div>
            </div>
        `;
        
        relatedContainer.insertAdjacentHTML('beforeend', cardHTML);
    });
}

// Configurer les boutons d'action dans la modale
function setupActionButtons() {
    const payBtn = document.querySelector('#add-to-cart-modal .btn-pay');
    const cartBtn = document.querySelector('#add-to-cart-modal .btn-view-cart');
    
    // Supprimer les écouteurs d'événements existants
    payBtn.replaceWith(payBtn.cloneNode(true));
    cartBtn.replaceWith(cartBtn.cloneNode(true));
    
    // Ajouter de nouveaux écouteurs
    document.querySelector('#add-to-cart-modal .btn-pay').addEventListener('click', function() {
        window.location.href = '/checkout';
    });
    
    document.querySelector('#add-to-cart-modal .btn-view-cart').addEventListener('click', function() {
        window.location.href = '/panier';
    });
}

// Fonction pour générer des étoiles en fonction de la note
function generateStars(rating) {
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
    return starsHtml;
}

// Afficher un toast de confirmation
function showConfirmationToast(message) {
    const toast = document.getElementById('confirmation-toast');
    const toastMessage = document.querySelector('.toast-message');
    if (toast && toastMessage) {
        toastMessage.textContent = message;
        toast.style.backgroundColor = '#2B6ED4';
        toast.style.bottom = '600px';  // ou toute autre valeur

        toast.style.display = 'block';
        toast.style.animation = 'none';
        toast.offsetHeight; // Forcer un reflow
        toast.style.animation = 'toastIn 0.3s, toastOut 0.3s 2.7s';
        
        setTimeout(function() {
            toast.style.display = 'none';
        }, 3000);
    }
}

// Fonction pour extraire les données de formation à partir d'une carte de formation
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
                // Assurez-vous de convertir les prix en nombres (supprimer les symboles monétaires)
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
            ratingStars = generateStars(parseFloat(rating));
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
            // On peut aussi essayer de récupérer la catégorie depuis l'URL ou autre méthode
            // Par exemple, si on est sur une page de catégorie, on peut récupérer depuis l'URL
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