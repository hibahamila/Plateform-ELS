

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Modifier un cours</h2>
        <form action="<?php echo e(route('cours.update', $cours->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label for="titre" class="form-label">Titre :</label>
                <input type="text" name="titre" class="form-control" value="<?php echo e($cours->titre); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control" required><?php echo e($cours->description); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début :</label>
                <input type="date" name="date_debut" class="form-control" value="<?php echo e($cours->dateDebut); ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin :</label>
                <input type="date" name="date_fin" class="form-control" value="<?php echo e($cours->dateFin); ?>" required>
            </div>

            <!-- Sélection de l'utilisateur -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur :</label>
                <select name="user_id" class="form-control" required>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $cours->user_id ? 'selected' : ''); ?>>
                            <?php echo e($user->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Sélection de la formation -->
            <div class="mb-3">
                <label for="formation_id" class="form-label">Formation :</label>
                <select name="formation_id" class="form-control" required>
                    <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($formation->id); ?>" <?php echo e($formation->id == $cours->formation_id ? 'selected' : ''); ?>>
                            <?php echo e($formation->titre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/cours/edit.blade.php ENDPATH**/ ?>