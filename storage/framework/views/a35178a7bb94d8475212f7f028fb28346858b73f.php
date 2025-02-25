

<?php $__env->startSection('title'); ?> Ajouter une Réponse <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<!-- Ajout de tout CSS nécessaire -->
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Ajouter une Réponse</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Réponses</li>
        <li class="breadcrumb-item active">Ajouter</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Affichage des erreurs -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Formulaire d'ajout de réponse -->
                        <form action="<?php echo e(route('reponsestore')); ?>" method="POST" class="form theme-form">
                            <?php echo csrf_field(); ?>

                            <!-- Question -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="question_id" class="form-label">Question</label>
                                        <select class="form-select" name="question_id" required>
                                            <option value="" disabled selected>Choisir une question</option> <!-- Option par défaut -->
                                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($question->id); ?>"><?php echo e($question->enonce); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenu -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="contenu" class="form-label">Contenu</label>
                                        <input type="text" class="form-control" name="contenu" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Est correcte ? -->
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Est correcte ?</label>
                                        <select class="form-select" name="est_correcte" required>
                                            <option value="1">Oui</option>
                                            <option value="0">Non</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons de soumission et annulation -->
                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Ajouter</button>
                                    <a href="<?php echo e(route('reponses')); ?>" class="btn btn-danger px-4">Annuler</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->startPush('scripts'); ?>
<!-- Ajout de tout script nécessaire -->
<?php $__env->stopPush(); ?>

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

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/admin/apps/reponse/reponsecreate.blade.php ENDPATH**/ ?>