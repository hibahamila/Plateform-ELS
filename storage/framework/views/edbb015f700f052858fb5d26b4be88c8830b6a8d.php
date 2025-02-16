

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Liste des Cours</h2>
    <a href="<?php echo e(route('cours.create')); ?>" class="btn btn-primary">Ajouter un Cours</a>

    <table class="table mt-4">
        <thead>
            <tr>
                
                <th>Titre</th>
                <th>Description</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Utilisateur</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    
                    <td><?php echo e($cour->titre); ?></td>
                    <td><?php echo e($cour->description); ?></td>
                    <td><?php echo e($cour->date_debut); ?></td>
                    <td><?php echo e($cour->date_fin); ?></td>
                    <td><?php echo e($cour->user->name); ?></td>
                    <td><?php echo e($cour->formation->titre); ?></td>
                    <td>
                        <a href="<?php echo e(route('cours.show', $cour->id)); ?>" class="btn btn-info">Voir</a>
                        <a href="<?php echo e(route('cours.edit', $cour->id)); ?>" class="btn btn-warning">Modifier</a>
                        <form action="<?php echo e(route('cours.destroy', $cour->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/cours/index.blade.php ENDPATH**/ ?>