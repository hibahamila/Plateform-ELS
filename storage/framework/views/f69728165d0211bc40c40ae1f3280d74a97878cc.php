
 

<?php $__env->startSection('title'); ?> Ajouter un Cours <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #success-message, #delete-message, #create-message {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Ajouter un Cours</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Cours</li>
        <li class="breadcrumb-item active">Ajouter</li>
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
                            <form action="<?php echo e(route('coursstore')); ?>" method="POST" class="needs-validation" novalidate>
                                <?php echo csrf_field(); ?>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="titre">Titre</label>
                                            <input id="titre" class="form-control" type="text" name="titre" placeholder="Titre" value="<?php echo e(old('titre')); ?>" required>
                                            <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" ><?php echo e(old('description')); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="start_date">Date de début</label>
                                            <input id="start_date" class="form-control" type="date" name="start_date" value="<?php echo e(old('start_date')); ?>" required>
                                            <div class="invalid-feedback">Veuillez sélectionner une date de début valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="end_date">Date de fin</label>
                                            <input id="end_date" class="form-control" type="date" name="end_date" value="<?php echo e(old('end_date')); ?>" required>
                                            <div class="invalid-feedback">Veuillez sélectionner une date de fin valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="user_id">Professeurs</label>
                                            <select id="user_id" class="form-select select2-professeur" name="user_id" required>
                                                <option value="" disabled selected>Sélectionnez un professeur</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id') == $user->id ? 'selected' : ''); ?>>
                                                        <?php echo e($user->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner un professeur valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formation_id">Formation</label>
                                            <select id="formation_id" class="form-select select2-formation" name="formation_id" required>
                                                <option value="" disabled selected>Sélectionner une formation</option>
                                                <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($formation->id); ?>" <?php echo e(old('formation_id') == $formation->id ? 'selected' : ''); ?>>
                                                        <?php echo e($formation->titre); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une formation valide.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('cours')); ?>'">Annuler</button>
                                        </div>
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

    <!-- Inclusion du script de validation global pour tous les formulaires -->
    <script src="<?php echo e(asset('assets/js/form-validation/form-validation.js')); ?>"></script>
   

    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?> 



<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\apps\cours\courscreate.blade.php ENDPATH**/ ?>