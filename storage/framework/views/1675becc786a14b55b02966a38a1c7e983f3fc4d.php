

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Détails du cours</h2>
        <p><strong>ID :</strong> <?php echo e($cours->id); ?></p>
        <p><strong>Titre :</strong> <?php echo e($cours->titre); ?></p>
        <p><strong>Description :</strong> <?php echo e($cours->description); ?></p>
        <p><strong>Date de début :</strong> <?php echo e($cours->date_debut); ?></p>
        <p><strong>Date de fin :</strong> <?php echo e($cours->date_fin); ?></p>
        <a href="<?php echo e(route('cours.index')); ?>" class="btn btn-secondary">Retour</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/cours/show.blade.php ENDPATH**/ ?>