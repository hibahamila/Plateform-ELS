

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="mb-4">Détails de la Catégorie</h1>

        <!-- Affichage des détails de la catégorie -->
        <div class="card">
            <div class="card-body">
                <p><strong>Nom :</strong> <?php echo e($categorie->titre); ?></p>
                <!-- Ajouter d'autres informations si nécessaire -->

                <!-- Lien de retour -->
                <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-secondary mt-3">Retour à la liste</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/categories/show.blade.php ENDPATH**/ ?>