

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Détails de la Lesson</h2>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?php echo e($lesson->titre); ?></h4>
            <p class="card-text"><strong>Description :</strong> <?php echo e($lesson->description); ?></p>
            <p class="card-text"><strong>Durée :</strong> <?php echo e($lesson->duree); ?></p>
            <p class="card-text"><strong>Chapitre :</strong> <?php echo e($lesson->chapitre->titre ?? 'N/A'); ?></p>
            <a href="<?php echo e(route('lessons.index')); ?>" class="btn btn-secondary">Retour à la liste</a>
            <a href="<?php echo e(route('lessons.edit', $lesson->id)); ?>" class="btn btn-warning">Modifier</a>
            <form action="<?php echo e(route('lessons.destroy', $lesson->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette lesson ?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/lessons/show.blade.php ENDPATH**/ ?>