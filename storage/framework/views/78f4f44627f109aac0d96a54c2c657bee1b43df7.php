



















<?php $__env->startSection('title'); ?> Modifier une Formation <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/formationedit.css')); ?>">
    <style>
        #publishDateContainer {
            display: none;
        }
        .text-success {
            color: #28a745;
        }
        .text-muted {
            color: #6c757d;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier une formation</h5>
                        <span>Complétez les informations pour modifier la formation</span>
                    </div>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="form theme-form">
                            <form class="needs-validation" action="<?php echo e(route('formationupdate', $formation->id)); ?>" method="POST" enctype="multipart/form-data" novalidate>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="row">
                                    <div class="col">
                                        <!-- Titre -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                                    <input class="form-control" type="text" id="title" name="title" placeholder="Titre" value="<?php echo e(old('title', $formation->title)); ?>" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer un Titre valide.</div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-align-left"></i></span>
                                                    <textarea class="form-control" id="description" name="description" placeholder="Description" required><?php echo e(old('description', $formation->description)); ?></textarea>
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                            </div>
                                        </div>

                                        <!-- Durée -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Durée (HH:mm) <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="icon-timer"></i></span>
                                                    <input class="form-control" type="text" id="duration" name="duration" placeholder="Ex: 02:30" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="<?php echo e(old('duration', \Carbon\Carbon::parse($formation->duration)->format('H:i'))); ?>" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
                                            </div>
                                        </div>

                                        <!-- Type -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                                    <input class="form-control" type="text" id="type" name="type" placeholder="Type" value="<?php echo e(old('type', $formation->type)); ?>" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer un type valide.</div>
                                            </div>
                                        </div>

                                        <!-- Prix -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Prix <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text">Dt</span>
                                                    <input class="form-control" 
                                                           type="number" 
                                                           id="price" 
                                                           name="price" 
                                                           placeholder="Ex: 50.000" 
                                                           step="0.001" 
                                                           min="0"
                                                           value="<?php echo e(old('price', $formation->price)); ?>" 
                                                           required />
                                                </div>
                                                <small class="text-muted">Format: 000.000 (3 décimales obligatoires)</small>
                                                <div class="invalid-feedback">Veuillez entrer un prix valide (ex: 50.000 ou 45.500)</div>
                                            </div>
                                        </div>

                                        <!-- Catégorie -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Catégorie <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <select class="form-select select2-categorie" id="categorie_id" name="categorie_id" required>
                                                        <option value="" disabled>Choisir une catégorie</option>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id', $formation->categorie_id) == $categorie->id ? 'selected' : ''); ?>>
                                                                <?php echo e($categorie->title); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Veuillez sélectionner une catégorie valide.</div>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Image <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <?php if($formation->image): ?>
                                                    <div id="currentImageContainer" class="image-container">
                                                        <img src="<?php echo e(asset('storage/' . $formation->image)); ?>?v=<?php echo e(time()); ?>" alt="image" class="centered-image" id="currentImage" />
                                                        <div class="image-actions">
                                                            <button type="button" class="btn" id="deleteImage">
                                                                <i class="fa fa-trash trash-icon" title="Supprimer l'image"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div id="newImagePreview" class="image-preview-container" style="display: none;">
                                                    <img id="previewImage" src="#" alt="Prévisualisation de la nouvelle image" class="image-preview" />
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="imageIcon" style="<?php echo e($formation->image ? 'display: none;' : ''); ?>">
                                                        <i class="fa fa-image"></i>
                                                    </span>
                                                    <input class="form-control" type="file" id="imageUpload" name="image" accept="image/*" style="<?php echo e($formation->image ? 'display: none;' : ''); ?>">
                                                </div>
                                                <button id="restoreImage" type="button" class="btn" style="display: none;">
                                                    <i class="fa fa-undo"></i> Revenir à l'image actuelle
                                                </button>
                                                <input type="hidden" name="delete_image" id="deleteImageInput" value="0">
                                                <small class="text-muted">Formats acceptés: JPG, PNG, GIF. Taille max: 2Mo</small>
                                            </div>
                                        </div>

                                        <!-- Publication Section -->
                                        <div class="mb-3 row">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                        <div class="radio radio-primary mx-2">
                                                            <input id="publishNow" type="radio" name="publication_type" value="now" 
                                                                <?php echo e(($formation->status || !$formation->publish_date) ? 'checked' : ''); ?>

                                                                <?php echo e(($formation->status) ? 'disabled' : ''); ?>>
                                                            <label class="mb-0" for="publishNow">
                                                                <?php echo e(($formation->status) ? 'Déjà publiée' : 'Publier immédiatement'); ?>

                                                            </label>
                                                        </div>
                                                        <div class="radio radio-primary mx-2">
                                                            <input id="publishLater" type="radio" name="publication_type" value="later" 
                                                                <?php echo e((!$formation->status && $formation->publish_date) ? 'checked' : ''); ?>

                                                                <?php echo e(($formation->status) ? 'disabled' : ''); ?>>
                                                            <label class="mb-0" for="publishLater">
                                                                <?php echo e(($formation->status) ? 'Non publiée' : 'Programmer la publication'); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Publication Date Container -->
                                                <div id="publishDateContainer" class="mt-3 text-center" 
                                                    style="<?php echo e((!$formation->status && $formation->publish_date) ? 'display: block;' : 'display: none;'); ?>">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="input-group" style="max-width:500px;">
                                                            <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                            <input class="form-control" 
                                                                type="datetime-local" 
                                                                id="publish_date" 
                                                                name="publish_date" 
                                                                value="<?php echo e(old('publish_date', $formation->publish_date ? \Carbon\Carbon::parse($formation->publish_date)->format('Y-m-d\TH:i') : '')); ?>"
                                                                min="<?php echo e(now()->format('Y-m-d\TH:i')); ?>"
                                                                <?php echo e(($formation->status) ? 'disabled' : ''); ?>>
                                                        </div>
                                                    </div>
                                                    <?php if($formation->status && $formation->publish_date): ?>
                                                        <small class="text-success">Publiée le <?php echo e(\Carbon\Carbon::parse($formation->publish_date)->format('d/m/Y H:i')); ?></small>
                                                    <?php elseif($formation->publish_date): ?>
                                                        <small class="text-muted">Programmée pour le <?php echo e(\Carbon\Carbon::parse($formation->publish_date)->format('d/m/Y H:i')); ?></small>
                                                    <?php else: ?>
                                                        <small class="text-muted">Sélectionnez la date et l'heure de publication</small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Boutons de soumission -->
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end mt-4">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fa fa-save"></i> Enregistrer
                                                    </button>
                                                    <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('formations')); ?>'">
                                                        <i class="fa fa-times"></i> Annuler
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/form-validation/form-validation.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/formation-edit.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/description/description.js')); ?>"></script>
    <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        // Formatage automatique du prix
        document.getElementById('price').addEventListener('blur', function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                this.value = value.toFixed(3);
            }
        });

        // Gestion de la date de publication
        document.addEventListener('DOMContentLoaded', function() {
            const publishNowRadio = document.getElementById('publishNow');
            const publishLaterRadio = document.getElementById('publishLater');
            const publishDateContainer = document.getElementById('publishDateContainer');
            const publishDateInput = document.getElementById('publish_date');
            
            // Vérifie si la formation est déjà publiée
            const isPublished = <?php echo e($formation->status ? 'true' : 'false'); ?>;

            function togglePublishDate() {
                if (!isPublished) {
                    if (publishLaterRadio.checked) {
                        publishDateContainer.style.display = 'block';
                        publishDateInput.required = true;
                        publishDateInput.disabled = false;
                    } else {
                        publishDateContainer.style.display = 'none';
                        publishDateInput.required = false;
                        publishDateInput.value = '';
                    }
                }
            }

            if (!isPublished) {
                publishNowRadio.addEventListener('change', togglePublishDate);
                publishLaterRadio.addEventListener('change', togglePublishDate);
                togglePublishDate(); // Initial state
            }

            // Gestion de l'image
            const deleteImageBtn = document.getElementById('deleteImage');
            const restoreImageBtn = document.getElementById('restoreImage');
            const imageUpload = document.getElementById('imageUpload');
            const currentImageContainer = document.getElementById('currentImageContainer');
            const newImagePreview = document.getElementById('newImagePreview');
            const deleteImageInput = document.getElementById('deleteImageInput');
            const imageIcon = document.getElementById('imageIcon');

            if (deleteImageBtn) {
                deleteImageBtn.addEventListener('click', function() {
                    currentImageContainer.style.display = 'none';
                    imageUpload.style.display = 'block';
                    imageIcon.style.display = 'flex';
                    deleteImageInput.value = '1';
                    restoreImageBtn.style.display = 'block';
                });
            }

            if (restoreImageBtn) {
                restoreImageBtn.addEventListener('click', function() {
                    currentImageContainer.style.display = 'block';
                    imageUpload.style.display = 'none';
                    imageIcon.style.display = 'none';
                    deleteImageInput.value = '0';
                    restoreImageBtn.style.display = 'none';
                    newImagePreview.style.display = 'none';
                    imageUpload.value = '';
                });
            }

            if (imageUpload) {
                imageUpload.addEventListener('change', function(e) {
                    if (e.target.files && e.target.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            newImagePreview.style.display = 'block';
                            document.getElementById('previewImage').src = event.target.result;
                        };
                        reader.readAsDataURL(e.target.files[0]);
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\projet PFE\plateformeEls\resources\views/admin/apps/formation/formationedit.blade.php ENDPATH**/ ?>