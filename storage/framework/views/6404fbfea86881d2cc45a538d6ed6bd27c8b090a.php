

<?php $__env->startSection('title'); ?> Modifier un Chapitre <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Modifier un Chapitre</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Chapitre</li>
        <li class="breadcrumb-item active">Modifier</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Affichage des messages d'erreur -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Affichage du message flash de succès -->
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('chapitreupdate', $chapitre->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre</label>
                                        <input type="text" name="titre" class="form-control" value="<?php echo e(old('titre', $chapitre->titre)); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4" required><?php echo e(old('description', $chapitre->description)); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="duree" class="form-label">Durée (HH:mm)</label>
                                        <input type="text" name="duree" class="form-control" value="<?php echo e(old('duree', \Carbon\Carbon::parse($chapitre->duree)->format('H:i'))); ?>" pattern="\d{2}:\d{2}" title="Format: HH:mm" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cours_id" class="form-label">Cours</label>
                                        <select name="cours_id" class="form-control" required>
                                            <?php $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($coursItem->id); ?>" 
                                                    <?php echo e(old('cours_id', $chapitre->cours_id) == $coursItem->id ? 'selected' : ''); ?>>
                                                    <?php echo e($coursItem->titre); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('chapitres')); ?>'">Annuler</button>
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
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/admin/apps/chapitre/chapitreedit.blade.php ENDPATH**/ ?>