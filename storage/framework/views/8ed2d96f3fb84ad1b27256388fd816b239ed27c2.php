

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Ajouter une Lesson</h2>
    <form action="<?php echo e(route('lessons.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="duree">Durée (HH:mm)</label>
            <input type="text" id="duree" name="duree" class="form-control" value="<?php echo e(old('duree')); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="chapitre_id" class="form-label">Chapitre</label>
            <select class="form-control" name="chapitre_id" required>
                <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($chapitre->id); ?>"><?php echo e($chapitre->titre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/lessons/create.blade.php ENDPATH**/ ?>