

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <h2 class="text-center mb-4">Modifier une Formation</h2>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('formations.update', $formation->id)); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input class="form-control" type="text" name="titre" value="<?php echo e(old('titre', $formation->titre)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="4" name="description" required><?php echo e(old('description', $formation->description)); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Durée (HH:mm)</label>
                <input class="form-control" type="text" name="duree" value="<?php echo e(old('duree', \Carbon\Carbon::parse($formation->duree)->format('H:i'))); ?>" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Type</label>
                <input class="form-control" type="text" name="type" value="<?php echo e(old('type', $formation->type)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input class="form-control" type="number" name="prix" value="<?php echo e(old('prix', $formation->prix)); ?>" step="0.01" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <select class="form-select" name="categorie_id" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id', $formation->categorie_id) == $categorie->id ? 'selected' : ''); ?>>
                            <?php echo e($categorie->titre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn custom-btn px-4" type="submit">Mettre à jour</button>
                <a href="<?php echo e(route('formations.index')); ?>" class="btn btn-secondary px-4">Annuler</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/formations/edit.blade.php ENDPATH**/ ?>