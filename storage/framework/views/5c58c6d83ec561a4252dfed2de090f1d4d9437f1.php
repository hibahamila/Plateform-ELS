

<?php $__env->startSection('content'); ?>
    <h1>Liste des chapitres</h1>

    <!-- Message de succès -->
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <a href="<?php echo e(route('chapitres.create')); ?>" class="btn btn-primary">Ajouter un chapitre</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Cours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($chapitre->titre); ?></td>
                    <td><?php echo e($chapitre->description); ?></td>
                    <td><?php echo e($chapitre->duree); ?></td>
                    <td><?php echo e($chapitre->cours->titre); ?></td>
                    <td>
                        <a href="<?php echo e(route('chapitres.show', $chapitre->id)); ?>" class="btn btn-info">Voir</a>
                        <a href="<?php echo e(route('chapitres.edit', $chapitre->id)); ?>" class="btn btn-warning">Modifier</a>
                        <form action="<?php echo e(route('chapitres.destroy', $chapitre->id)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/chapitres/index.blade.php ENDPATH**/ ?>