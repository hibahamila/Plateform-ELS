

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Liste des Lessons</h2>
    <a href="<?php echo e(route('lessons.create')); ?>" class="btn btn-primary">Ajouter une Lesson</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Chapitre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($lesson->id); ?></td>
                <td><?php echo e($lesson->titre); ?></td>
                <td><?php echo e($lesson->description); ?></td>
                <td><?php echo e($lesson->duree); ?></td>
                <td><?php echo e($lesson->chapitre->titre ?? 'N/A'); ?></td>
                <td>
                    <a href="<?php echo e(route('lessons.show', $lesson->id)); ?>" class="btn btn-info">Voir</a>
                    <a href="<?php echo e(route('lessons.edit', $lesson->id)); ?>" class="btn btn-warning">Modifier</a>
                    <form action="<?php echo e(route('lessons.destroy', $lesson->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette lesson ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/lessons/index.blade.php ENDPATH**/ ?>