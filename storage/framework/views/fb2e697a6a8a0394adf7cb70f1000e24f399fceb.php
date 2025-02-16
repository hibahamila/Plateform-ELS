

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Liste des Questions</h2>
    <a href="<?php echo e(route('questions.create')); ?>" class="btn btn-primary">Ajouter une Question</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Enonce</th>
                <th>Quiz</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($question->id); ?></td>
                <td><?php echo e($question->enonce); ?></td>
                <td><?php echo e($question->quiz->titre); ?></td>
                <td>
                    <a href="<?php echo e(route('questions.show', $question->id)); ?>" class="btn btn-info btn-sm">Voir</a>

                    <a href="<?php echo e(route('questions.edit', $question->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="<?php echo e(route('questions.destroy', $question->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette question ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/questions/index.blade.php ENDPATH**/ ?>