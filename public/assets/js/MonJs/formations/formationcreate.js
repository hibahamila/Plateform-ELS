
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de la prévisualisation de l'image
    var imageInput = document.getElementById('image');
    var imagePreviewContainer = document.getElementById('imagePreviewContainer');
    var imagePreview = document.getElementById('imagePreview');
    var deleteImageButton = document.getElementById('deleteImage');
    
    // Afficher la prévisualisation lorsqu'une image est sélectionnée
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
    
    // Supprimer l'image sélectionnée
    if (deleteImageButton) {
        deleteImageButton.addEventListener('click', function() {
            imageInput.value = ''; // Réinitialiser l'input file
            imagePreviewContainer.classList.add('hidden'); // Cacher la prévisualisation
        });
    }

    // Gérer le bouton switch pour le statut
    const statusToggle = document.getElementById('statusToggle');
    const statusLabel = document.getElementById('statusLabel');

    if (statusToggle) {
        statusToggle.addEventListener('change', function() {
            if (this.checked) {
                statusLabel.textContent = 'Publié';
            } else {
                statusLabel.textContent = 'Non publié';
            }
        });

        // Initialiser le texte du label au chargement
        if (statusToggle.checked) {
            statusLabel.textContent = 'Publié';
        } else {
            statusLabel.textContent = 'Non publié';
        }
    }
});