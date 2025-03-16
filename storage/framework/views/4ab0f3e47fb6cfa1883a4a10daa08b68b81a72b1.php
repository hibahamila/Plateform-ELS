
 

<?php $__env->startSection('title'); ?> Ajouter une Formation <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Ajouter une Formation</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Formations</li>
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

                        <div class="form theme-form">
                            <form class="needs-validation" action="<?php echo e(route('formationstore')); ?>" method="POST" enctype="multipart/form-data" novalidate >
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="titre">Titre</label>
                                            <input class="form-control" type="text" id="titre" name="titre" placeholder="Titre" value="<?php echo e(old('titre')); ?>" required />
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" rows="4" name="description" placeholder="Description" required ><?php echo e(old('description')); ?></textarea>
                                            <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="duree">Durée (HH:mm)</label>
                                            <input class="form-control" type="text" id="duree" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="<?php echo e(old('duree')); ?>" required />
                                            <div class="invalid-feedback">Veuillez entrer la durée au format HH:mm.</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="type">Type</label>
                                            <input class="form-control" type="text" id="type" name="type" placeholder="Type" value="<?php echo e(old('type')); ?>" required />
                                            <div class="invalid-feedback">Veuillez entrer un type valide.</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="prix">Prix</label>
                                            <input class="form-control" type="number" id="prix" name="prix" placeholder="Prix" step="0.01" value="<?php echo e(old('prix')); ?>" required />
                                            <div class="invalid-feedback">Veuillez entrer un prix valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Image</label>
                                            <input class="form-control" type="file" id="image" name="image" accept="image/*" required />
                                            <div class="invalid-feedback">Veuillez télécharger une image valide.</div>
                                        </div>
                                    </div>
                                </div>

                                
                                

                                
                          

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="categorie_id">Catégorie</label>
                                            <select class="form-select select2-categorie" id="categorie_id" name="categorie_id" required>
                                                <option value="" selected disabled>Choisir une catégorie</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id') == $categorie->id ? 'selected' : ''); ?>>
                                                        <?php echo e($categorie->titre); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une catégorie valide.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('formations')); ?>'">Annuler</button>
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

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation/form-validation.js')); ?>"></script>

    
    <script>
    
    </script>
    

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/formation/formationcreate.blade.php ENDPATH**/ ?>