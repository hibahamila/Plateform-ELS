
 

 <?php $__env->startSection('title'); ?> Ajouter une Leçon <?php $__env->stopSection(); ?>
 
 <?php $__env->startPush('css'); ?>
 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
 <style>
     #success-message, #delete-message, #create-message {
         opacity: 0;
         transition: opacity 0.3s ease;
     }
     .alert-success {
         background-color: #d4edda;
         border-color: #c3e6cb;
         color: #155724;
     }
     .alert-danger {
         background-color: #f8d7da;
         border-color: #f5c6cb;
         color: #721c24;
     }
     .alert-info {
         background-color: #d1ecf1;
         border-color: #bee5eb;
         color: #0c5460;
     }
     .custom-btn {
         background-color: #2b786a;
         color: white;
         border-color: #2b786a;
     }
     .custom-btn:hover {
         background-color: #1f5c4d;
         border-color: #1f5c4d;
         color: white;
     }
     .invalid-feedback {
         display: block;
     }
 </style>
 <?php $__env->stopPush(); ?>
 
 <?php $__env->startSection('content'); ?>
     <?php $__env->startComponent('components.breadcrumb'); ?>
         <?php $__env->slot('breadcrumb_title'); ?>
             <h3>Ajouter une Leçon</h3>
         <?php $__env->endSlot(); ?>
         <li class="breadcrumb-item">Leçons</li>
         <li class="breadcrumb-item active">Ajouter</li>
     <?php echo $__env->renderComponent(); ?>
 
     <div class="container-fluid">
         <div class="row">
             <div class="col-sm-12">
                 <div class="card">
                     <div class="card-body">
                         <?php if($errors->any()): ?>
                             <div class="alert alert-danger">
                                 <ul>
                                     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <li><?php echo e($error); ?></li>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </ul>
                             </div>
                         <?php endif; ?>
 
                         <form action="<?php echo e(route('lessonstore')); ?>" method="POST" class="form theme-form needs-validation" enctype="multipart/form-data" novalidate>
                             <?php echo csrf_field(); ?>
 
                             <div class="row">
                                 <div class="col">
                                     <div class="mb-3">
                                         <label class="form-label">Titre</label>
                                         <input class="form-control" type="text" name="titre" placeholder="Titre" value="<?php echo e(old('titre')); ?>" required />
                                         <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                     </div>
                                 </div>
                             </div>
 
                             <div class="row">
                                 <div class="col">
                                     <div class="mb-3">
                                         <label class="form-label">Description</label>
                                         <textarea class="form-control" rows="4" name="description" placeholder="Description" required><?php echo e(old('description')); ?></textarea>
                                         <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                     </div>
                                 </div>
                             </div>
 
                             <div class="row">
                                 <div class="col">
                                     <div class="mb-3">
                                         <label class="form-label">Durée (HH:mm)</label>
                                         <input class="form-control" type="text" name="duree" value="<?php echo e(old('duree')); ?>" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                         <div class="invalid-feedback">Veuillez entrer une durée valide (HH:mm).</div>
                                     </div>
                                 </div>
                             </div>
 
                             <div class="row">
                                 <div class="col">
                                     <div class="mb-3">
                                         <label class="form-label">Chapitre</label>
                                         <?php if(isset($chapitreId) && $chapitreId): ?>  <!-- Si chapitre_id existe -->
                                             <!-- Afficher uniquement le titre du chapitre, sans possibilité de modification -->
                                             <input type="text" class="form-control bg-light" value="<?php echo e($chapitres->find($chapitreId)->titre); ?>" readonly />
                                             <input type="hidden" name="chapitre_id" value="<?php echo e($chapitreId); ?>"> <!-- Ajouter un champ caché pour envoyer le chapitre_id -->
                                         <?php else: ?>
                                             <!-- Si aucun chapitre n'est sélectionné, afficher la liste déroulante -->
                                             <select class="form-select select2-chapitre" name="chapitre_id" required>
                                                 <option value="" selected disabled>Choisir un chapitre</option>
                                                 <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <option value="<?php echo e($chapitre->id); ?>" <?php echo e(old('chapitre_id') == $chapitre->id ? 'selected' : ''); ?>><?php echo e($chapitre->titre); ?></option>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </select>
                                         <?php endif; ?>
                                         <div class="invalid-feedback">Veuillez sélectionner un chapitre valide.</div>
                                     </div>
                                 </div>
                             </div>
 
                             <div class="row">
                                 <div class="col">
                                     <div class="mb-3">
                                         <label class="form-label">Fichier</label>
                                         <input class="form-control" type="file" name="file_path" value="<?php echo e(old('file_path')); ?>" required />
                                         <div class="invalid-feedback">Veuillez sélectionner un fichier valide.</div>
                                     </div>
                                 </div>
                             </div>
 
                             <!-- Champ pour entrer plusieurs liens -->
                             <div class="form-group">
                                 <label for="link">Liens (un par ligne)</label>
                                 <textarea class="form-control" name="link" id="link" rows="5" placeholder="Entrez un lien par ligne" required><?php echo e(old('link')); ?></textarea>
                                 <small class="form-text text-muted">Entrez des liens valides, un par ligne.</small>
                             </div>
 
                             <div class="row">
                                 <div class="col text-end">
                                     <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                     <a href="<?php echo e(route('lessons')); ?>" class="btn btn-danger px-4">Annuler</a>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 
 <?php $__env->startPush('scripts'); ?>
 <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
 <script src="<?php echo e(asset('assets/js/select2-init/single-select.js')); ?>"></script>
 
 <script src="<?php echo e(asset('assets/js/form-validation/form-validation.js')); ?>"></script>
 <script>
    function validateLinks() {
    var linksField = document.getElementById("link");
    var links = linksField.value.trim(); // Supprimer les espaces avant et après la chaîne

    // Si le champ est vide, on accepte
    if (links === "") {
        linksField.setCustomValidity("");
        return true;
    }

    // Diviser les liens séparés par des sauts de ligne
    var linksArray = links.split("\n");
    var valid = true;

    linksArray.forEach(function(link) {
        var trimmedLink = link.trim(); // Supprimer les espaces autour de chaque lien
        if (trimmedLink === "") return; // Ignorer les entrées vides
        
        // Vérifier si le lien commence par http:// ou https://
        if (!trimmedLink.startsWith('http://') && !trimmedLink.startsWith('https://')) {
            valid = false;
        }
    });

    // Si des liens invalides sont trouvés
    if (!valid) {
        linksField.setCustomValidity("Veuillez entrer des liens valides (commençant par http:// ou https://).");
        return false;
    }

    // Si tous les liens sont valides, réinitialiser la validation personnalisée
    linksField.setCustomValidity(""); 
    return true;
}

// Valider les liens lors de la saisie
document.getElementById("link").addEventListener("input", validateLinks);

// Ajout d'un écouteur d'événement sur le formulaire pour valider avant la soumission
document.querySelector("form").addEventListener("submit", function(event) {
    if (!validateLinks()) {
        event.preventDefault();  // Empêcher la soumission du formulaire si les liens ne sont pas valides
    }
});
    // document.querySelector("form").addEventListener("submit", function(event) {
    //     const links = document.getElementById("link").value.split(",");
    //     const regex = /^(https?:\/\/[^\s]+)$/; // Validation simple pour http(s)
    //     let valid = true;

    //     // Vérifie chaque lien
    //     for (let link of links) {
    //         if (!regex.test(link.trim())) {
    //             valid = false;
    //             alert("Un des liens n'est pas valide. Assurez-vous que tous les liens commencent par http:// ou https://.");
    //             break;
    //         }
    //     }

    //     if (!valid) {
    //         event.preventDefault();
    //     }
    // });
</script>

 <?php $__env->stopPush(); ?>
 
 <?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/lesson/lessoncreate.blade.php ENDPATH**/ ?>