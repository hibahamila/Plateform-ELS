

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="mb-4">Ajouter une Catégorie</h1>

        <!-- Affichage des erreurs de validation -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('categories.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" id="titre" class="form-control" value="<?php echo e(old('titre')); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/categories/create.blade.php ENDPATH**/ ?>