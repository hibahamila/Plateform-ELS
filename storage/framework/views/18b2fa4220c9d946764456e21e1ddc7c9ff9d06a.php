

<?php $__env->startSection('content'); ?>
    <h1>Détails du chapitre</h1>

    <div class="card">
        <div class="card-header">
            <h3><?php echo e($chapitre->titre); ?></h3>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> <?php echo e($chapitre->description); ?></p>
            <p><strong>Durée:</strong> <?php echo e($chapitre->duree); ?></p>
            <p><strong>Cours associé:</strong> <?php echo e($chapitre->cours->titre); ?></p>
        </div>
        <div class="card-footer">
            <a href="<?php echo e(route('chapitres.index')); ?>" class="btn btn-secondary">Retour à la liste</a>
            <a href="<?php echo e(route('chapitres.edit', $chapitre->id)); ?>" class="btn btn-warning">Modifier</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/chapitres/show.blade.php ENDPATH**/ ?>