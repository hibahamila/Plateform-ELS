

<?php $__env->startSection('content'); ?>
    <h1>Modifier un chapitre</h1>

    <form action="<?php echo e(route('chapitres.update', $chapitre->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" value="<?php echo e(old('titre', $chapitre->titre)); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required><?php echo e(old('description', $chapitre->description)); ?></textarea>
        </div>

        <div class="form-group">
            <label for="durée">Durée (HH:mm)</label>
            <input type="text" id="duree" name="duree" class="form-control" value="<?php echo e(old('duree', $chapitre->duree)); ?>" required>
        </div>

        <div class="form-group">
            <label for="cours_id">Cours</label>
            <select id="cours_id" name="cours_id" class="form-control" required>
                <?php $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($coursItem->id); ?>" <?php echo e(old('cours_id', $chapitre->cours_id) == $coursItem->id ? 'selected' : ''); ?>><?php echo e($coursItem->titre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Mettre à jour</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/chapitres/edit.blade.php ENDPATH**/ ?>