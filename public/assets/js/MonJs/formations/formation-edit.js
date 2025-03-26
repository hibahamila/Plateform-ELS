

document.addEventListener('DOMContentLoaded', function() {
    // Gestion du statut (publié/non publié)
    const statusToggle = document.getElementById('statusToggle');
    const statusLabel = document.getElementById('statusLabel');

    if (statusToggle) {
        statusToggle.addEventListener('change', function() {
            statusLabel.textContent = this.checked ? 'Publié' : 'Non publié';
        });
    }

    // Gestion de l'image
    const deleteImageButton = document.getElementById('deleteImage');
    const imageUploadInput = document.getElementById('imageUpload');
    const deleteImageInput = document.getElementById('deleteImageInput');
    const currentImageContainer = document.getElementById('currentImageContainer');
    const newImagePreview = document.getElementById('newImagePreview');
    const previewImage = document.getElementById('previewImage');
    const restoreButton = document.getElementById('restoreImage');

    // Supprimer l'image
    if (deleteImageButton) {
        deleteImageButton.addEventListener('click', function() {
            deleteImageInput.value = 1; // Marquer pour suppression
            currentImageContainer.style.display = 'none'; // Cacher l'image actuelle
            imageUploadInput.style.display = 'block'; // Afficher l'input de fichier
            restoreButton.style.display = 'block'; // Afficher le bouton de restauration
            // Si une nouvelle image a déjà été prévisualisée, on la cache aussi
            newImagePreview.style.display = 'none';
        });
    }

    // Restaurer l'image originale
    if (restoreButton) {
        restoreButton.addEventListener('click', function() {
            deleteImageInput.value = 0; // Annuler la suppression
            currentImageContainer.style.display = 'flex'; // Réafficher l'image actuelle
            imageUploadInput.style.display = 'none'; // Cacher l'input de fichier
            newImagePreview.style.display = 'none'; // Cacher la prévisualisation
            restoreButton.style.display = 'none'; // Cacher le bouton de restauration
            imageUploadInput.value = ''; // Vider l'input de fichier
        });
    }

    // Prévisualisation de la nouvelle image
    if (imageUploadInput) {
        imageUploadInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    newImagePreview.style.display = 'flex'; // Afficher la prévisualisation
                    restoreButton.style.display = 'block'; // Afficher le bouton de restauration
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});







document.addEventListener('DOMContentLoaded', function() {
    const currentImageContainer = document.getElementById('currentImageContainer');
    const newImagePreview = document.getElementById('newImagePreview');
    const imageUpload = document.getElementById('imageUpload');
    const imageIcon = document.getElementById('imageIcon');
    const deleteImageButton = document.getElementById('deleteImage');
    const restoreImageButton = document.getElementById('restoreImage');
    const deleteImageInput = document.getElementById('deleteImageInput');

    if (deleteImageButton) {
        deleteImageButton.addEventListener('click', function() {
            // Masquer l'image actuelle
            if (currentImageContainer) {
                currentImageContainer.style.display = 'none';
            }

            // Afficher le champ de téléchargement d'image et l'icône
            imageUpload.style.display = 'block';
            imageIcon.style.display = 'inline-flex';

            // Afficher le bouton de restauration
            restoreImageButton.style.display = 'block';

            // Mettre à jour l'input hidden pour indiquer que l'image doit être supprimée
            deleteImageInput.value = '1';
        });
    }

    if (restoreImageButton) {
        restoreImageButton.addEventListener('click', function() {
            // Réafficher l'image actuelle
            if (currentImageContainer) {
                currentImageContainer.style.display = 'flex'; // Utiliser flex pour centrer
                currentImageContainer.style.justifyContent = 'center'; // Centrer horizontalement
                currentImageContainer.style.alignItems = 'center'; // Centrer verticalement
            }

            // Masquer le champ de téléchargement d'image et l'icône
            imageUpload.style.display = 'none';
            imageIcon.style.display = 'none';

            // Masquer le bouton de restauration
            restoreImageButton.style.display = 'none';

            // Réinitialiser l'input hidden
            deleteImageInput.value = '0';
        });
    }

    // Gestion de la prévisualisation de la nouvelle image
    if (imageUpload) {
        imageUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('previewImage');
                    previewImage.src = e.target.result;
                    newImagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});








