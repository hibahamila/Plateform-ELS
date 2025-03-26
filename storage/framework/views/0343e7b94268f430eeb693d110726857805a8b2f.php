


<?php $__env->startSection('title'); ?> Modifier une Formation <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Modifier une Formation</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Formations</li>
        <li class="breadcrumb-item active">Modifier</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="form theme-form">
                            <form action="<?php echo e(route('formationupdate', $formation->id)); ?>" method="POST">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">title</label>
                                            <input class="form-control" type="text" name="title" placeholder="title" value="<?php echo e(old('title', $formation->title)); ?>" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" rows="4" name="description" placeholder="Description" ><?php echo e(old('description', $formation->description)); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Durée (HH:mm)</label>
                                            <input class="form-control" type="text" name="duration" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" value="<?php echo e(old('duration', \Carbon\Carbon::parse($formation->duration)->format('H:i'))); ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <input class="form-control" type="text" name="type" placeholder="Type" value="<?php echo e(old('type', $formation->type)); ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">price</label>
                                            <input class="form-control" type="number" name="price" placeholder="price" step="0.01" value="<?php echo e(old('price', $formation->price)); ?>" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Catégorie</label>
                                            <select class="form-select select2-categorie" name="categorie_id"  required>
                                                <option value="" disabled selected>Choisir une catégorie</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id', $formation->categorie_id) == $categorie->id ? 'selected' : ''); ?>>
                                                        <?php echo e($categorie->title); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Mettre à jour</button>
                                        <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('formations')); ?>'">Annuler</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/select2-init/single-select.js')); ?>"></script>
    <?php $__env->startPush('scripts'); ?>
   
<?php $__env->stopPush(); ?>
<?php $__env->stopPush(); ?>

<style>
    .custom-btn {
        background-color: #2b786a; 
        color: white; 
        border-color: #2b786a;
    }
    .custom-btn:hover {
        background-color: #1f5c4d;
        border-color: #1f5c4d;
        color: white;
    }
</style>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\apps\formation\formationedit.blade.php ENDPATH**/ ?>