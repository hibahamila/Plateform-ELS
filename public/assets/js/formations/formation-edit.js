// assets/js/formation.js
document.addEventListener("DOMContentLoaded", function() {
    let deleteButton = document.getElementById("deleteImage");
    let currentImageContainer = document.getElementById("currentImageContainer");
    let imageUpload = document.getElementById("imageUpload");
    let deleteImageInput = document.getElementById("deleteImageInput");
    
    // Créer un bouton pour revenir à l'image actuelle
    let restoreButton = document.createElement("button");
    restoreButton.type = "button";
    restoreButton.className = "btn btn-primary mt-2";
    restoreButton.id = "restoreImage";
    restoreButton.innerHTML = '<i class="fa fa-undo"></i> Revenir à l\'image actuelle';
    restoreButton.style.display = "none";
    
    // Ajouter le bouton après le champ de téléchargement
    imageUpload.parentNode.insertBefore(restoreButton, imageUpload.nextSibling);

    if (deleteButton) {
        deleteButton.addEventListener("click", function() {
            currentImageContainer.style.display = "none";
            imageUpload.style.display = "block";
            restoreButton.style.display = "block";
            deleteImageInput.value = "1";
        });
    }
    
    // Ajouter un écouteur d'événement pour le bouton de restauration
    restoreButton.addEventListener("click", function() {
        currentImageContainer.style.display = "block";
        imageUpload.style.display = "none";
        restoreButton.style.display = "none";
        deleteImageInput.value = "0";
        // Réinitialiser le champ de téléchargement
        imageUpload.value = "";
    });
    
    // Écouter les changements sur le champ de téléchargement
    imageUpload.addEventListener("change", function() {
        if (imageUpload.files.length > 0) {
            // Si une nouvelle image est sélectionnée, on s'assure que deleteImageInput est à 0
            // pour permettre le remplacement par la nouvelle image
            deleteImageInput.value = "0";
            restoreButton.style.display = "none"; // Cacher le bouton de restauration
        }
    });
});



