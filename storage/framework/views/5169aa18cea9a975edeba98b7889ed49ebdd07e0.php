

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <h2 class="text-center mb-4">Ajouter une Formation</h2>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('formations.store')); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input class="form-control" type="text" name="titre" placeholder="Titre" value="<?php echo e(old('titre')); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="4" name="description" placeholder="Description" required><?php echo e(old('description')); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Durée (HH:mm)</label>
                <input class="form-control" type="text" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="<?php echo e(old('duree')); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Type</label>
                <input class="form-control" type="text" name="type" placeholder="Type" value="<?php echo e(old('type')); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input class="form-control" type="number" name="prix" placeholder="Prix" step="0.01" value="<?php echo e(old('prix')); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <select class="form-select" name="categorie_id" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id') == $categorie->id ? 'selected' : ''); ?>>
                            <?php echo e($categorie->titre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn custom-btn px-4" type="submit">Ajouter</button>
                <button class="btn btn-secondary px-4" type="button" onclick="window.location.href='<?php echo e(route('formations.index')); ?>'">Annuler</button>

                
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/formations/create.blade.php ENDPATH**/ ?>