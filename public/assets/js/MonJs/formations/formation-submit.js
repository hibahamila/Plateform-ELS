
// document.addEventListener('DOMContentLoaded', function() {
    
//     // Gestion de l'affichage du prix selon le type
//     const typeSelect = document.getElementById('type');
//     const priceContainer = document.getElementById('priceContainer');
//     const priceInput = document.getElementById('price');
//     function displayFreeLabels() {
//         // Sélectionner toutes les cartes de formation
//         const formationCards = document.querySelectorAll('.card, .formation-item');

//         formationCards.forEach(card => {
//             // Vérifier si cette carte a un élément de prix ou un attribut de type
//             const priceElement = card.querySelector('.card-price, .price');
//             const typeElement = card.querySelector('[data-type]');
//             const type = typeElement ? typeElement.getAttribute('data-type') : null;
            
//             // Condition pour déterminer si la formation est gratuite
//             const isZeroPrice = priceElement && (
//                 priceElement.textContent.trim() === '0.000' || 
//                 priceElement.textContent.trim() === '0.000 $US' || 
//                 priceElement.textContent.trim() === '0.00' || 
//                 priceElement.textContent.trim() === '0.00 $US'
//             );
//             const isTypeGratuite = type === 'gratuite';
            
//             // Si la formation est gratuite (par le prix ou le type)
//             if (isZeroPrice || isTypeGratuite) {
//                 // Masquer l'affichage du prix si nécessaire
//                 if (priceElement) {
//                     priceElement.style.display = 'none';
//                 }
                
//                 // Créer et ajouter le badge "Gratuite"
//                 const freeLabel = document.createElement('div');
//                 freeLabel.className = 'free-badge';
//                 freeLabel.textContent = 'Gratuite';
//                 freeLabel.style.cssText = `
//                     position: absolute;
//                     top: 10px;
//                     right: 10px;
//                     background-color: #4CAF50;
//                     color: white;
//                     padding: 5px 10px;
//                     border-radius: 4px;
//                     font-weight: bold;
//                     z-index: 10;
//                 `;
                
//                 // S'assurer que la carte a une position relative pour le positionnement absolu
//                 card.style.position = 'relative';
//                 card.appendChild(freeLabel);
//             }
//         });
//     }
    
//     // Exécuter la fonction après le chargement complet de la page
//     displayFreeLabels();

//     function togglePriceField() {
//         if (typeSelect.value === 'payante') {
//             priceContainer.style.display = 'flex';
//             priceInput.required = true;
//         } else {
//             priceContainer.style.display = 'none';
//             priceInput.required = false;
//             priceInput.value = '';
//         }
//     }

//     // Écouteur d'événement pour le changement de type
//     if (typeSelect) {
//         typeSelect.addEventListener('change', togglePriceField);
//         // Initialisation au chargement
//         togglePriceField();
        
//         // Si ancienne valeur en session, afficher le champ correspondant
//         if (document.querySelector('input[name="_old_input"]') && document.querySelector('input[name="_old_input"]').value === 'payante') {
//             priceContainer.style.display = 'flex';
//         }
//     }

//     // Duration Picker Functionality
//     // const hoursInput = document.querySelector('.duration-hours');
//     // const minutesInput = document.querySelector('.duration-minutes');
//     // const durationHiddenInput = document.getElementById('duration');
    
//     // if (hoursInput && minutesInput && durationHiddenInput) {
//     //     // Set initial value if exists
//     //     const oldDuration = document.querySelector('input[name="duration"]') ? document.querySelector('input[name="duration"]').value : '';
//     //     if (oldDuration && oldDuration.includes(':')) {
//     //         const [hours, minutes] = oldDuration.split(':');
//     //         hoursInput.value = hours;
//     //         minutesInput.value = minutes;
//     //     }
        
//     //     // Update hidden input on change
//     //     function updateDuration() {
//     //         const hours = hoursInput.value.padStart(2, '0');
//     //         const minutes = minutesInput.value.padStart(2, '0');
//     //         durationHiddenInput.value = `${hours}:${minutes}`;
//     //     }
        
//     //     hoursInput.addEventListener('change', function() {
//     //         if (this.value < 0) this.value = 0;
//     //         if (this.value > 23) this.value = 23;
//     //         updateDuration();
//     //     });
        
//     //     minutesInput.addEventListener('change', function() {
//     //         if (this.value < 0) this.value = 0;
//     //         if (this.value > 59) this.value = 59;
//     //         updateDuration();
//     //     });
        
//     //     // Initialize if empty
//     //     if (!hoursInput.value && !minutesInput.value) {
//     //         hoursInput.value = '00';
//     //         minutesInput.value = '00';
//     //         updateDuration();
//     //     }
//     // }

//     // Formatage automatique du prix
//     if (priceInput) {
//         priceInput.addEventListener('blur', function() {
//             let value = parseFloat(this.value);
//             if (!isNaN(value)) {
//                 this.value = value.toFixed(3);
//             }
//         });
//     }

//     // Show/hide publication date based on radio button selection
//     const publishNowRadio = document.getElementById('publishNow');
//     const publishLaterRadio = document.getElementById('publishLater');
//     const publishDateContainer = document.getElementById('publishDateContainer');
//     const publishDateInput = document.getElementById('publish_date');

//     if (publishNowRadio && publishLaterRadio && publishDateContainer) {
//         function togglePublishDate() {
//             if (publishLaterRadio.checked) {
//                 publishDateContainer.style.display = 'block';
//                 publishDateInput.required = true;
//             } else {
//                 publishDateContainer.style.display = 'none';
//                 publishDateInput.required = false;
//                 publishDateInput.value = '';
//             }
//         }

//         publishNowRadio.addEventListener('change', togglePublishDate);
//         publishLaterRadio.addEventListener('change', togglePublishDate);

//         // Initial state
//         togglePublishDate();
//     }

//     // Image preview functionality
//     const imageInput = document.getElementById('image');
//     const imagePreviewContainer = document.getElementById('imagePreviewContainer');
//     const imagePreview = document.getElementById('imagePreview');
//     const deleteImageBtn = document.getElementById('deleteImage');

//     if (imageInput && imagePreviewContainer && imagePreview) {
//         imageInput.addEventListener('change', function(e) {
//             if (e.target.files.length > 0) {
//                 const file = e.target.files[0];
//                 const reader = new FileReader();
                
//                 reader.onload = function(event) {
//                     imagePreview.src = event.target.result;
//                     imagePreviewContainer.classList.remove('hidden');
//                 };
                
//                 reader.readAsDataURL(file);
//             }
//         });
//     }

//     if (deleteImageBtn) {
//         deleteImageBtn.addEventListener('click', function() {
//             imageInput.value = '';
//             imagePreview.src = '#';
//             imagePreviewContainer.classList.add('hidden');
//         });
//     }

//     // Gérer le bouton switch pour le statut
//     const statusToggle = document.getElementById('statusToggle');
//     const statusLabel = document.getElementById('statusLabel');
    
//     if (statusToggle && statusLabel) {
//         statusToggle.addEventListener('change', function() {
//             if (this.checked) {
//                 statusLabel.textContent = 'Publié';
//             } else {
//                 statusLabel.textContent = 'Non publié';
//             }
//         });
        
//         // Initialiser le texte du label au chargement
//         if (statusToggle.checked) {
//             statusLabel.textContent = 'Publié';
//         } else {
//             statusLabel.textContent = 'Non publié';
//         }
//     }
            
// });



document.addEventListener('DOMContentLoaded', function() {
    
    // Gestion de l'affichage du prix selon le type
    const typeSelect = document.getElementById('type');
    const priceContainer = document.getElementById('priceContainer');
    const priceInput = document.getElementById('price');
    
    function togglePriceField() {
        if (typeSelect.value === 'payante') {
            priceContainer.style.display = 'flex';
            priceInput.required = true;
        } else {
            priceContainer.style.display = 'none';
            priceInput.required = false;
            priceInput.value = '';
        }
    }

    // Écouteur d'événement pour le changement de type
    if (typeSelect) {
        typeSelect.addEventListener('change', togglePriceField);
        // Initialisation au chargement
        togglePriceField();
        
        // Si ancienne valeur en session, afficher le champ correspondant
        if (typeSelect.value === 'payante') {
            priceContainer.style.display = 'flex';
        }
    }

    // Formatage automatique du prix avec 3 décimales
    if (priceInput) {
        priceInput.addEventListener('blur', function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                this.value = value.toFixed(3);
            }
        });
    }

    // Show/hide publication date based on radio button selection
    const publishNowRadio = document.getElementById('publishNow');
    const publishLaterRadio = document.getElementById('publishLater');
    const publishDateContainer = document.getElementById('publishDateContainer');
    const publishDateInput = document.getElementById('publish_date');

    if (publishNowRadio && publishLaterRadio && publishDateContainer) {
        function togglePublishDate() {
            if (publishLaterRadio.checked) {
                publishDateContainer.style.display = 'block';
                publishDateInput.required = true;
            } else {
                publishDateContainer.style.display = 'none';
                publishDateInput.required = false;
                publishDateInput.value = '';
            }
        }

        publishNowRadio.addEventListener('change', togglePublishDate);
        publishLaterRadio.addEventListener('change', togglePublishDate);

        // Initial state
        togglePublishDate();
    }

    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const deleteImageBtn = document.getElementById('deleteImage');

    if (imageInput && imagePreviewContainer && imagePreview) {
        imageInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                };
                
                reader.readAsDataURL(file);
            }
        });
    }

    if (deleteImageBtn) {
        deleteImageBtn.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.src = '#';
            imagePreviewContainer.classList.add('hidden');
        });
    }

    // Validation de la date de fin après la date de début
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    
    if (startDateInput && endDateInput) {
        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
            
            // Si la date de fin est avant la date de début, la réinitialiser
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
        });
        
        // Initialisation au chargement
        if (startDateInput.value) {
            endDateInput.min = startDateInput.value;
        }
    }
});