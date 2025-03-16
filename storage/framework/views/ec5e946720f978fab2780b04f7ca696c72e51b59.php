

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1><?php echo e($formation->titre); ?></h1>
        <p><strong>Description:</strong> <?php echo e($formation->description); ?></p>
        <p><strong>Durée:</strong> <?php echo e($formation->duree); ?></p>
        <p><strong>Type:</strong> <?php echo e($formation->type); ?></p>
        <p><strong>Prix:</strong> <?php echo e($formation->prix); ?></p>

        <p><strong>Catégorie:</strong> <?php echo e($formation->categorie->titre); ?></p>
        <a href="<?php echo e(route('formations')); ?>" class="btn btn-secondary">Retour à la lise </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\apps\quiz\quizshow.blade.php ENDPATH**/ ?>