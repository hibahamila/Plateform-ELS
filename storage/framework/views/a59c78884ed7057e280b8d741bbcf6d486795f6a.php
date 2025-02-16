

<?php $__env->startSection('content'); ?>
    <h1>Modifier la Catégorie</h1>

    <form action="<?php echo e(route('categories.update', $categorie->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <label for="titre">Titre :</label>
        <input type="text" name="titre" value="<?php echo e($categorie->titre); ?>" required>
        <button type="submit">Mettre à jour</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/categories/edit.blade.php ENDPATH**/ ?>