









<?php $__env->startSection('title'); ?> Ajouter une Question <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('breadcrumb_title'); ?>
        <h3>Ajouter une Question</h3>
    <?php $__env->endSlot(); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('questions')); ?>">Questions</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Zone pour afficher les messages d'erreur temporaires -->
                    <div id="error-message" class="alert alert-danger d-none mb-3"></div>

                    <!-- Message d'information si aucun quiz n'existe -->
                    <?php if($quizzes->isEmpty()): ?>
                        <div class="alert alert-info">
                            Aucun quiz n'existe. Veuillez <a href="<?php echo e(route('quizcreate')); ?>">créer un quiz</a> avant d'ajouter une question.
                        </div>
                    <?php endif; ?>

                    <form id="question-form" action="<?php echo e(route('questionstore')); ?>" method="POST" class="needs-validation">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="enonce" class="form-label">Énoncé de la question</label>
                            <input type="text" class="form-control" id="enonce" name="enonce" placeholder="Enoncé" value="<?php echo e(old('enonce')); ?>" required>
                            <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                        </div>

                        <div class="mb-3">
                            <label for="quiz_id" class="form-label">Quiz associé</label>
                            <?php if($quizId && $quiz): ?>
                                <!-- Cas 1 : Un quiz_id est déjà récupéré -->
                                <input type="text" class="form-control bg-light" value="<?php echo e($quiz->titre); ?>" readonly>
                                <input type="hidden" id="hidden_quiz_id" name="quiz_id" value="<?php echo e($quizId); ?>">
                            <?php else: ?>
                                <!-- Cas 2 : Aucun quiz_id n'est récupéré, afficher la liste déroulante -->
                                <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                    <option value="" selected disabled>Sélectionnez un quiz</option>
                                    <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quizOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($quizOption->id); ?>" <?php echo e(old('quiz_id') == $quizOption->id ? 'selected' : ''); ?>>
                                            <?php echo e($quizOption->titre); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                            <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                        </div>

                        <div class="mb-3">
                            <label for="response_count" class="form-label">Nombre de réponses</label>
                            <input type="number" class="form-control" id="response_count" name="response_count" min="1" max="10" value="<?php echo e(old('response_count', 1)); ?>" required>
                            <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                        </div>

                        <div id="reponses-container">
                            <!-- Les champs de réponse seront ajoutés ici dynamiquement -->
                            <?php if(old('reponses')): ?>
                                <?php $__currentLoopData = old('reponses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $reponse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label class="form-label">Réponse <?php echo e($index + 1); ?></label>
                                            <input class="form-control" type="text" name="reponses[<?php echo e($index); ?>][contenu]" placeholder="Entrez la réponse <?php echo e($index + 1); ?>" value="<?php echo e($reponse['contenu']); ?>" required>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="hidden" name="reponses[<?php echo e($index); ?>][est_correcte]" value="0">
                                            <input type="checkbox" name="reponses[<?php echo e($index); ?>][est_correcte]" value="1" class="form-check-input me-2" <?php echo e($reponse['est_correcte'] == 1 ? 'checked' : ''); ?> >
                                            <label class="form-check-label">Correcte</label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary" type="submit" id="submit-btn">Ajouter</button>
                            <a href="<?php echo e(route('questions')); ?>" class="btn btn-danger px-4">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation/form-validation.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/questions/question-create.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/question/questioncreate.blade.php ENDPATH**/ ?>