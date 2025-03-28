

<?php $__env->startSection('title'); ?> Ajouter une Question <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone/dropzone.css')); ?>">
    <link href="<?php echo e(asset('assets/css/MonCss/custom-style.css')); ?>" rel="stylesheet">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/css/MonCss/SweatAlert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Nouvelle Question</h5>
                        <span>Complétez les informations pour ajouter une nouvelle question</span>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($errors->any()): ?>)
                            <div class="alert alert-danger">
                                <ul class="mb-0">
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

                        <div class="form theme-form">
                            <form id="question-form" action="<?php echo e(route('questionstore')); ?>" method="POST" class="needs-validation" novalidate>
                                <?php echo csrf_field(); ?>

                                <!-- Énoncé de la question -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Énoncé <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-question-circle"></i></span>
                                            <input class="form-control" type="text" id="statement" name="statement" placeholder="Enoncé" value="<?php echo e(old('statement')); ?>" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                                    </div>
                                </div>

                                <!-- Quiz associé -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Quiz <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                            </div>
                                            <div class="col">
                                                <?php if($quizId && $quiz): ?>
                                                    <!-- Cas 1 : Un quiz_id est déjà récupéré -->
                                                    <div class="input-group">
                                                        <input class="form-control bg-light" type="text" value="<?php echo e($quiz->title); ?>" readonly />
                                                        <input type="hidden" id="hidden_quiz_id" name="quiz_id" value="<?php echo e($quizId); ?>">
                                                    </div>
                                                <?php else: ?>
                                                    <!-- Cas 2 : Aucun quiz_id n'est récupéré, afficher la liste déroulante -->
                                                    <div class="input-group">
                                                        <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                                            <option value="" selected disabled>Sélectionnez un quiz</option>
                                                            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quizOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($quizOption->id); ?>" <?php echo e(old('quiz_id') == $quizOption->id ? 'selected' : ''); ?>>
                                                                    <?php echo e($quizOption->title); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nombre de réponses -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Nombre de réponses <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-list-ol"></i></span>
                                            <input class="form-control" type="number" id="response_count" name="response_count" min="1" max="10" value="<?php echo e(old('response_count', 1)); ?>" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                                    </div>
                                </div>

                                

                                <!-- Réponses -->
<div id="reponses-container">
    <?php if(old('reponses')): ?>
        <?php $__currentLoopData = old('reponses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $reponse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row mb-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <input class="form-control" type="text" name="reponses[<?php echo e($index); ?>][content]" placeholder="Entrez la réponse <?php echo e($index + 1); ?>" value="<?php echo e($reponse['content']); ?>" required />
                        <div class="input-group-text">
                            <input type="hidden" name="reponses[<?php echo e($index); ?>][is_correct]" value="0">
                            <input type="checkbox" name="reponses[<?php echo e($index); ?>][is_correct]" value="1" class="form-check-input" <?php echo e($reponse['is_correct'] == 1 ? 'checked' : ''); ?> />
                            <label class="form-check-label ms-2">Correcte</label>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

                                <!-- Boutons de soumission -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end mt-4">
                                            <button class="btn btn-primary" type="submit" id="submit-btn">
                                                <i class="fa fa-save"></i> Ajouter
                                            </button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('questions')); ?>'">
                                                <i class="fa fa-times"></i> Annuler
                                            </button>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/form-validation/form-validation.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/questions/question-create.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/question/questioncreate.blade.php ENDPATH**/ ?>