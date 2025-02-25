





<?php $__env->startSection('title'); ?> Ajouter une Leçon <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<!-- Ajout de tout CSS nécessaire, comme dropzone ou autre -->
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
                        <!-- Affichage des erreurs -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Formulaire d'ajout de leçon -->
                        <form action="<?php echo e(route('lessonstore')); ?>" method="POST" class="form theme-form">
                            <?php echo csrf_field(); ?>

                            <!-- Titre -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Titre</label>
                                        <input class="form-control" type="text" name="titre" value="<?php echo e(old('titre')); ?>" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="4" name="description" required><?php echo e(old('description')); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Durée -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Durée (HH:mm)</label>
                                        <input class="form-control" type="text" name="duree" value="<?php echo e(old('duree')); ?>" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Chapitre -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Chapitre</label>
                                        <select class="form-select" name="chapitre_id" required>
                                            <option value="" selected disabled>Choisir un chapitre</option>
                                            <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($chapitre->id); ?>" <?php echo e(old('chapitre_id') == $chapitre->id ? 'selected' : ''); ?>>
                                                    <?php echo e($chapitre->titre); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons de soumission et annulation -->
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
<!-- Ajout de tout script nécessaire -->
<?php $__env->stopPush(); ?>

<style>
    .custom-btn {
        background-color: #2b786a; /* Vert foncé */
        color: white; /* Texte en blanc */
        border-color: #2b786a; /* Border avec la même couleur */
    }

    .custom-btn:hover {
        background-color: #1f5c4d; /* Couleur encore plus foncée au survol */
        border-color: #1f5c4d;
        color: white; /* Texte en blanc */
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/admin/apps/lesson/lessoncreate.blade.php ENDPATH**/ ?>