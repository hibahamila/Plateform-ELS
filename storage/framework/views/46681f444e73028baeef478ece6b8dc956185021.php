



<?php $__env->startSection('title'); ?> Modifier une Formation <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/formationedit.css')); ?>">
  
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
                                                    <textarea class="form-control" id="description" rows="4" name="description" placeholder="Description" required><?php echo e(old('description', $formation->description)); ?></textarea>
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
                                                    <input class="form-control" type="number" id="price" name="price" placeholder="Prix" step="0.01" value="<?php echo e(old('price', $formation->price)); ?>" required />
                                                </div>
                                                <div class="invalid-feedback">Veuillez entrer un Prix valide.</div>
                                            </div>
                                        </div>

                                        <!-- Catégorie -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Catégorie <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="input-group-text"><i class="fa fa-folder"></i></span>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select select2-categorie" id="categorie_id" name="categorie_id" required>
                                                        <option value="" disabled>Choisir une catégorie</option>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id', $formation->categorie_id) == $categorie->id ? 'selected' : ''); ?>>
                                                                <?php echo e($categorie->title); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

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
                                                    <!-- Icône de l'image (masquée si une image est déjà présente) -->
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
                                        <!-- Bouton switch pour le statut -->
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Statut <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="form-switch">
                                                    <input class="form-check-input" type="checkbox" id="statusToggle" name="status" 
                                                        value="1" <?php echo e(old('status', $formation->status) ? 'checked' : ''); ?>>
                                                    <span class="slider"></span> <!-- Ajoutez le slider personnalisé -->
                                                    <label class="form-check-label" for="statusToggle">
                                                        <span id="statusLabel"><?php echo e(old('status', $formation->status) ? 'Publié' : 'Non publié'); ?></span>
                                                    </label>
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

   
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/formation/formationedit.blade.php ENDPATH**/ ?>