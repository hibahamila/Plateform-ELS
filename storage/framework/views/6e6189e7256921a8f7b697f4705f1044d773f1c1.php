

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="mb-4">Liste des Catégories</h1>

        <!-- Lien pour ajouter une catégorie -->
        <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary mb-3">Ajouter une catégorie</a>

        <!-- Affichage du message de succès -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Liste des catégories -->
        <ul class="list-group">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?php echo e($categorie->titre); ?></strong>
                    </div>
                    <div>
                        <!-- Actions -->
                        <a href="<?php echo e(route('categories.show', $categorie->id)); ?>" class="btn btn-info btn-sm">Voir</a>
                        <a href="<?php echo e(route('categories.edit', $categorie->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>

                        <!-- Formulaire pour supprimer une catégorie -->
                        <form action="<?php echo e(route('categories.destroy', $categorie->id)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/categories/index.blade.php ENDPATH**/ ?>