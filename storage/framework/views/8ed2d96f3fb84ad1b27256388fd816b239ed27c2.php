

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <h2 class="text-center mb-4">Ajouter une Leçon</h2>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('lessons.store')); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" class="form-control" name="titre" value="<?php echo e(old('titre')); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4" required><?php echo e(old('description')); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Durée (HH:mm)</label>
                <input type="text" name="duree" class="form-control" value="<?php echo e(old('duree')); ?>" pattern="\d{2}:\d{2}" title="Format: HH:mm" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Chapitre</label>
                <select class="form-select" name="chapitre_id" required>
                    <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($chapitre->id); ?>"><?php echo e($chapitre->titre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn custom-btn px-4">Ajouter</button>
                <a href="<?php echo e(route('lessons.index')); ?>" class="btn btn-secondary px-4">Annuler</a>
            </div>
        </form>
    </div>
</div>

<style>
    .custom-btn {
        background-color: #2b786a; /* Vert foncé */
        color: white; /* Texte en blanc */
        border-color: #2b786a; /* Border avec la même couleur */
    }

    .custom-btn:hover {
        background-color: #1f5c4d; /* Couleur encore plus foncée au survol */
        color: white; /* Texte en blanc */

        border-color: #1f5c4d;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/lessons/create.blade.php ENDPATH**/ ?>