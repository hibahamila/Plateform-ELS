

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <h2 class="text-center mb-4">Modifier un Cours</h2>

        <!-- Affichage des messages d'erreur -->
        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Affichage du message flash de succès -->
        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('cours.update', $cours->id)); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input class="form-control" type="text" name="titre" value="<?php echo e(old('titre', $cours->titre)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="4" name="description" required><?php echo e(old('description', $cours->description)); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de début</label>
                <input class="form-control" type="date" name="date_debut" value="<?php echo e(old('date_debut', $cours->date_debut)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Date de fin</label>
                <input class="form-control" type="date" name="date_fin" value="<?php echo e(old('date_fin', $cours->date_fin)); ?>" required />
            </div>

            <!-- Sélection de l'utilisateur -->
            <div class="mb-3">
                <label class="form-label">Utilisateur</label>
                <select class="form-select" name="user_id" required>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id', $cours->user_id) == $user->id ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Sélection de la formation -->
            <div class="mb-3">
                <label class="form-label">Formation</label>
                <select class="form-select" name="formation_id" required>
                    <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($formation->id); ?>" <?php echo e(old('formation_id', $cours->formation_id) == $formation->id ? 'selected' : ''); ?>><?php echo e($formation->titre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn custom-btn px-4" type="submit">Mettre à jour</button>
                <a href="<?php echo e(route('cours.index')); ?>" class="btn btn-secondary px-4">Annuler</a>
            </div>
        </form>
    </div>
</div>

<style>
    .custom-btn {
        background-color: #2b786a; /* Vert foncé */
        color: white; /* Texte en blanc */
        border-color: #2b786a; /* Border avec la même couleur */
    }

    .custom-btn:hover {
        background-color: #1f5c4d; /* Couleur encore plus foncée au survol */
        border-color: #1f5c4d;
        color: white; /* Texte en blanc */
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/cours/edit.blade.php ENDPATH**/ ?>