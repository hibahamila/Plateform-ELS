

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Ajouter un nouveau cours</h2>
        <form action="<?php echo e(route('cours.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début :</label>
                <input type="date" name="date_debut" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin :</label>
                <input type="date" name="date_fin" class="form-control" required>
            </div>

            <!-- Sélection de l'utilisateur -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur :</label>
                <select name="user_id" class="form-control" required>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Sélection de la formation -->
            <div class="mb-3">
                <label for="formation_id" class="form-label">Formation :</label>
                <select name="formation_id" class="form-control" required>
                    <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($formation->id); ?>"><?php echo e($formation->titre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/cours/create.blade.php ENDPATH**/ ?>