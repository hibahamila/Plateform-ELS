window.cartFormations = [];
// Variable globale pour le compteur de panier
window.globalCartCount = 0;

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation
    initCartCore();
    // Vérifier l'état du badge immédiatement
    initCartBadge();
    
    // Vérifier l'état du badge après un court délai pour s'assurer qu'il est bien rendu
    setTimeout(function() {
        const storedCount = parseInt(localStorage.getItem('cartCount') || '0');
        if (storedCount > 0) {
            forceUpdateCartBadge(storedCount);
        }
    }, 500);
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
    // Charger la feuille de style CSS externe
    loadCartStyles();
    
    // Vérifier le localStorage en premier pour une réponse immédiate
    const storedCount = parseInt(localStorage.getItem('cartCount') || '0');
    window.globalCartCount = storedCount; // Synchroniser avec la variable globale
    
    // S'assurer que le badge est mis à jour correctement
    if (storedCount > 0) {
        forceUpdateCartBadge(storedCount);
    }
    
    // Puis vérifier avec le serveur pour s'assurer que c'est exact
    fetchCartItemsCount();
    
    // Ajouter un écouteur d'événements pour la visibilité de la page
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            // Quand la page redevient visible, vérifier que le badge est correct
            refreshCartBadge();
        }
    });
    
    // Vérifier régulièrement que le badge est présent et correct
    setInterval(refreshCartBadge, 2000);
}

// Fonction pour charger la feuille de style CSS externe
function loadCartStyles() {
    // Vérifier si les styles sont déjà chargés
    if (document.getElementById('cart-badge-styles')) return;
    
    const link = document.createElement('link');
    link.id = 'cart-badge-styles';
    link.rel = 'stylesheet';
    link.href = '/css/MonCss/cart-badge-panier.css'; // Chemin vers le fichier CSS séparé

    document.head.appendChild(link);
}

// Nouvelle fonction pour forcer la mise à jour du badge
function forceUpdateCartBadge(count) {
    // Convertir count en nombre entier pour être sûr
    count = parseInt(count) || 0;
    
    // Ne pas afficher de badge si le compteur est 0
    if (count <= 0) {
        const existingBadge = document.querySelector('.cart-badge');
        if (existingBadge) {
            existingBadge.remove();
        }
        return;
    }
    
    // Trouver le conteneur du panier
    const cartContainer = document.querySelector('.cart-container');
    if (!cartContainer) {
        console.error("Conteneur de panier introuvable");
        return;
    }
    
    // Supprimer l'ancien badge s'il existe
    const existingBadge = document.querySelector('.cart-badge');
    if (existingBadge) {
        existingBadge.remove();
    }
    
    // Créer un nouveau badge
    const newBadge = document.createElement('span');
    newBadge.className = 'cart-badge';
    newBadge.id = 'cart-badge';
    newBadge.textContent = count.toString();
    
    // Ajouter le badge au conteneur
    cartContainer.appendChild(newBadge);
    
    // Forcer un reflow pour que le badge soit immédiatement visible
    void newBadge.offsetHeight;
    
    // Mettre à jour la variable globale
    window.globalCartCount = count;
    
    // Debug pour vérifier la visibilité
    console.log(`Badge mis à jour: ${count} éléments dans le panier`);
}

// Nouvelle fonction pour rafraîchir le badge
function refreshCartBadge() {
    const count = parseInt(localStorage.getItem('cartCount') || '0');
    const badge = document.querySelector('.cart-badge');
    
    // Si le badge devrait être présent mais ne l'est pas
    if (count > 0 && !badge) {
        console.log("Besoin de recréer le badge - le badge manque");
        forceUpdateCartBadge(count);
    }
    // Si le badge est présent mais avec une valeur incorrecte
    else if (badge && badge.textContent !== count.toString()) {
        console.log("Besoin de mettre à jour le badge - valeur incorrecte");
        forceUpdateCartBadge(count);
    }
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
        const count = parseInt(data.count) || 0;
        localStorage.setItem('cartCount', count.toString());
        window.globalCartCount = count;
        
        // Mettre à jour le badge visuellement
        forceUpdateCartBadge(count);
        console.log(`Compteur récupéré du serveur: ${count}`);
    })
    .catch(error => {
        console.error('Erreur lors de la récupération du nombre d\'éléments du panier:', error);
        // En cas d'erreur, garder la valeur du localStorage
        refreshCartBadge();
    });
}

// Fonction complètement réécrite pour ajouter au panier
function addToCart(formationId) {
    // Vérifier les valeurs actuelles
    console.log("État avant ajout:", {
        storedCount: localStorage.getItem('cartCount'),
        globalCount: window.globalCartCount
    });
    
    // Récupérer le compteur actuel
    const currentCount = parseInt(localStorage.getItem('cartCount') || '0');
    
    // Incrémenter avant d'envoyer au serveur
    const newCount = currentCount + 1;
    
    // Mettre à jour le stockage local immédiatement
    localStorage.setItem('cartCount', newCount.toString());
    
    // Mettre à jour immédiatement le badge de manière fiable
    console.log(`Mise à jour du badge à ${newCount} avant appel serveur`);
    forceUpdateCartBadge(newCount);
    
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
            forceUpdateCartBadge(currentCount);
            throw new Error('Erreur lors de l\'ajout au panier');
        }
        return response.json();
    })
    .then(data => {
        console.log('Formation ajoutée au panier avec succès:', formationId);
        console.log('Réponse du serveur:', data);
        
        // Mettre à jour le badge avec le nombre exact fourni par le serveur
        if (data.cartCount !== undefined) {
            const serverCount = parseInt(data.cartCount) || 0;
            console.log(`Compte du serveur: ${serverCount}`);
            localStorage.setItem('cartCount', serverCount.toString());
            window.globalCartCount = serverCount;
            forceUpdateCartBadge(serverCount);
        }
        
        // Gérer les formations associées dans l'interface
        handleRelatedFormations(formationId);
        
        // Afficher un message de confirmation
        if (data.message) {
            window.showConfirmationToast(data.message);
        } else {
            window.showConfirmationToast('Formation ajoutée au panier');
        }
        
        // Vérifier à nouveau le badge après un court délai
        setTimeout(refreshCartBadge, 500);
    })
    .catch(error => {
        console.error('Erreur:', error);
        window.showConfirmationToast('Erreur lors de l\'ajout au panier');
        refreshCartBadge();
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

// Fonction pour être compatible avec les appels existants
function updateCartCounter() {
    fetchCartItemsCount();
}

// Fonction pour être compatible avec les appels existants
function updateCartCounterFromServer(count) {
    if (count !== undefined && count !== null) {
        const countValue = parseInt(count) || 0;
        localStorage.setItem('cartCount', countValue.toString());
        window.globalCartCount = countValue;
        forceUpdateCartBadge(countValue);
    } else {
        fetchCartItemsCount();
    }
}

// ----- FONCTION DE SUPPRESSION DU PANIER -----

function removeFromCart(formationId) {
    // Log pour vérifier que la fonction est appelée
    console.log('Tentative de suppression de la formation ID:', formationId);
    
    fetch('/panier/supprimer', {
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
            throw new Error('Erreur lors de la suppression du panier');
        }
        return response.json();
    })
    .then(response => {
        console.log('Réponse du serveur:', response);
        
        if (response.success) {
            // Supprimer l'élément du DOM
            const formationItem = document.querySelector(`.formation-item[data-formation-id="${formationId}"]`);
            if (formationItem) {
                // Effet de fade out avec setTimeout
                formationItem.style.opacity = '0';
                formationItem.style.transition = 'opacity 300ms';
                
                setTimeout(() => {
                    formationItem.remove();
                    
                    // Mettre à jour le nombre d'éléments dans le panier
                    const panierCountElement = document.querySelector('.panier-count');
                    if (panierCountElement) {
                        panierCountElement.textContent = `${response.cartCount} formation(s)`;
                    }
                    
                    // Mettre à jour le compteur et badge du panier
                    localStorage.setItem('cartCount', response.cartCount.toString());
                    window.globalCartCount = response.cartCount;
                    forceUpdateCartBadge(response.cartCount);
                    
                    // Mettre à jour le résumé du panier
                    updateCartSummary(response);
                    
                    // Si le panier est vide, afficher le message correspondant
                    if (response.cartCount === 0) {
                        const panierContent = document.querySelector('.panier-content');
                        if (panierContent) {
                            panierContent.outerHTML = `
                                <div class="empty-cart">
                                    <i class="fas fa-shopping-cart"></i>
                                    <p>Votre panier est vide</p>
                                    <a href="formation/formations">Découvrir des formations</a>

                                </div>
                            `;
                        }
                    }
                }, 300);
            }
            
            // Afficher un message de confirmation
            window.showConfirmationToast(response.message || 'Formation supprimée du panier');
        } else {
            window.showConfirmationToast(response.message || 'Erreur lors de la suppression de la formation');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        window.showConfirmationToast('Erreur lors de la suppression de la formation');
    });
}

// Fonction pour mettre à jour l'affichage du résumé du panier
function updateCartSummary(response) {
    console.log('Mise à jour du résumé:', response);
    
    if (response.cartCount === 0) {
        return; // La gestion du panier vide est déjà faite dans la fonction principale
    }
    
    // Mise à jour du prix total
    const totalPriceElement = document.querySelector('.total-price');
    if (totalPriceElement) {
        totalPriceElement.textContent = response.totalPrice + ' DT';
    }
    
    // S'il y a une remise, mettre à jour l'affichage
    if (response.hasDiscount && parseFloat(response.discountedItemsOriginalPrice) > 0) {
        // Vérifier si les éléments existent déjà
        let originalPriceElement = document.querySelector('.original-price');
        let discountElement = document.querySelector('.discount-percentage');
        
        if (originalPriceElement) {
            originalPriceElement.textContent = response.discountedItemsOriginalPrice + ' DT';
        } else if (totalPriceElement) {
            // Créer l'élément pour le prix original
            originalPriceElement = document.createElement('div');
            originalPriceElement.className = 'original-price';
            originalPriceElement.textContent = response.discountedItemsOriginalPrice + ' DT';
            totalPriceElement.insertAdjacentElement('afterend', originalPriceElement);
        }
        
        if (discountElement) {
            discountElement.textContent = response.discountPercentage + '% off';
        } else if (originalPriceElement) {
            // Créer l'élément pour le pourcentage de remise
            discountElement = document.createElement('div');
            discountElement.className = 'discount-percentage';
            discountElement.textContent = response.discountPercentage + '% off';
            originalPriceElement.insertAdjacentElement('afterend', discountElement);
        }
    } else {
        // Supprimer les éléments de remise s'ils existent
        const originalPrice = document.querySelector('.original-price');
        const discountPercentage = document.querySelector('.discount-percentage');
        
        if (originalPrice) originalPrice.remove();
        if (discountPercentage) discountPercentage.remove();
    }
}

// Ajouter ceci à votre fonction initCartCore()
function initCartCore() {
    setupAddToCartListeners();
    setupRemoveFromCartListeners(); // Ajouter cette ligne
    updateCartButtons();
}

// Nouvelle fonction pour configurer les écouteurs d'événements de suppression
function setupRemoveFromCartListeners() {
    document.addEventListener('click', function(e) {
        const removeLink = e.target.closest('.remove-link');
        if (removeLink) {
            e.preventDefault();
            
            const formationId = removeLink.getAttribute('data-formation-id');
            if (formationId) {
                removeFromCart(formationId);
            }
        }
        
        // Pour la fonctionnalité "Sauvegarder pour plus tard"
        const saveForLater = e.target.closest('.save-for-later');
        if (saveForLater) {
            e.preventDefault();
            alert('Fonctionnalité à implémenter: Sauvegarder pour plus tard');
        }
    });
}

// Exposer la fonction au niveau global
window.removeFromCart = removeFromCart;
window.updateCartSummary = updateCartSummary;
// Exposer les fonctions nécessaires globalement
window.updateCartCounter = updateCartCounter;
window.updateCartCounterFromServer = updateCartCounterFromServer;
window.addToCart = addToCart;
window.checkIfInCart = checkIfInCart;
window.updateCartButtons = updateCartButtons;
window.extractFormationDataFromCard = extractFormationDataFromCard;
window.forceUpdateCartBadge = forceUpdateCartBadge;
window.refreshCartBadge = refreshCartBadge;



