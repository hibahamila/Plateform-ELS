

<?php $__env->startSection('content'); ?>
    <h1>Ajouter une formation</h1>

    <!-- Afficher le message de succès -->
    

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

    <div class="card">
        
        <form action="<?php echo e(route('formations.store')); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <!-- Champ Titre -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Titre</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="titre" type="text" name="titre" placeholder="Titre" value="<?php echo e(old('titre')); ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" cols="5" name="description" placeholder="Description"><?php echo e(old('description')); ?></textarea>
                            </div>
                        </div>

                        <br>

                        <!-- Champ Durée -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Durée (HH:mm)</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="duree" type="text" name="duree" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="<?php echo e(old('duree')); ?>" />
                            </div>
                        </div>

                        <!-- Champ Type -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="type" type="text" name="type" placeholder="Type" value="<?php echo e(old('type')); ?>" />
                            </div>
                        </div>

                        <!-- Champ Prix -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Prix</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="prix" type="number" name="prix" placeholder="Prix" step="0.001" value="<?php echo e(old('prix')); ?>" />
                            </div>
                        </div>

                        <!-- Champ Catégorie -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Catégorie</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="categorie_id" name="categorie_id">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id') == $categorie->id ? 'selected' : ''); ?>><?php echo e($categorie->titre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons de soumission et d'annulation -->
            <div class="card-footer text-end">
            <div class="col-sm-9 offset-sm-3">
                <button class="btn btn-success" type="submit">Ajouter</button>
                <input class="btn btn-light" type="reset" value="Annuler" />
    </div>
</div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/formations/create.blade.php ENDPATH**/ ?>