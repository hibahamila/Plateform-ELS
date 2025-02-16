

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Liste des Quizzes</h2>
    <a href="<?php echo e(route('quizzes.create')); ?>" class="btn btn-primary">Ajouter un Quiz</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Limite</th>
                <th>Date de Fin</th>
                <th>Score Minimum</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($quiz->titre); ?></td>
                    <td><?php echo e($quiz->description); ?></td>
                    <td><?php echo e($quiz->date_limite); ?></td>
                    <td><?php echo e($quiz->date_fin); ?></td>
                    <td><?php echo e($quiz->score_minimum); ?></td>
                    <td>
                        <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="btn btn-info">Voir</a>
                        <a href="<?php echo e(route('quizzes.edit', $quiz->id)); ?>" class="btn btn-warning">Modifier</a>
                        <form action="<?php echo e(route('quizzes.destroy', $quiz->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/quizzes/index.blade.php ENDPATH**/ ?>