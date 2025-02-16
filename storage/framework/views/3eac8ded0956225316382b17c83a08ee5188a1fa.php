

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Détails du Quiz</h2>
    <p><strong>Titre :</strong> <?php echo e($quiz->titre); ?></p>
    <p><strong>Description :</strong> <?php echo e($quiz->description); ?></p>
    <p><strong>Date Limite :</strong> <?php echo e($quiz->date_limite); ?></p>
    <p><strong>Date de Fin :</strong> <?php echo e($quiz->date_fin); ?></p>
    <p><strong>Score Minimum :</strong> <?php echo e($quiz->score_minimum); ?></p>

    <a href="<?php echo e(route('quizzes.index')); ?>" class="btn btn-secondary">Retour</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/quizzes/show.blade.php ENDPATH**/ ?>