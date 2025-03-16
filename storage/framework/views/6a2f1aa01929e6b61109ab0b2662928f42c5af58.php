


<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Modifier une Question</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Questions</li>
        <li class="breadcrumb-item active">Modifier</li>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startPush('css'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.min.css')); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <?php $__env->stopPush(); ?>

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

                       
                        <form action="<?php echo e(route('questionupdate', $question->id)); ?>" method="POST" class="theme-form needs-validation" novalidate>
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- Champ caché pour stocker les réponses dynamiques -->
                            <input type="hidden" id="dynamic-responses" name="dynamic_responses" value="<?php echo e(old('dynamic_responses', json_encode($question->reponses))); ?>">

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="enonce" class="form-label">Enoncé</label>
                                        <input type="text" name="enonce" class="form-control" value="<?php echo e(old('enonce', $question->enonce)); ?>" required>
                                        <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="quiz_id" class="form-label">Quiz</label>
                                        <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                            <option value="" selected disabled>Sélectionnez un quiz</option>
                                            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($quiz->id); ?>" <?php echo e(old('quiz_id', $question->quiz_id) == $quiz->id ? 'selected' : ''); ?>><?php echo e($quiz->titre); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="response_count" class="form-label">Nombre de réponses</label>
                                        <input type="number" name="response_count" id="response_count" class="form-control" min="1" max="10" value="<?php echo e(old('response_count', count($question->reponses))); ?>" required>
                                        <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Réponses</label>
                                    <div id="reponses-container">
                                        <?php $__currentLoopData = $question->reponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $reponse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mb-3 d-flex align-items-center reponse-item">
                                                <input type="text" name="reponses[<?php echo e($index); ?>][contenu]" class="form-control me-2 response-input <?php echo e($errors->has("reponses.$index.contenu") ? 'is-invalid' : ''); ?>" 
                                                       value="<?php echo e(old("reponses.$index.contenu", $reponse->contenu)); ?>" required>
                                                <input type="hidden" name="reponses[<?php echo e($index); ?>][id]" value="<?php echo e($reponse->id); ?>">
                                                <input type="hidden" name="reponses[<?php echo e($index); ?>][est_correcte]" value="0">
                                                <input type="checkbox" name="reponses[<?php echo e($index); ?>][est_correcte]" value="1" 
                                                       <?php echo e(old("reponses.$index.est_correcte", $reponse->est_correcte) ? 'checked' : ''); ?>>
                                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-btn">X</button>
                                                
                                            
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col text-end">
                                    <button class="btn btn-secondary me-3" type="submit">Modifier</button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('questions')); ?>'">Annuler</button>
                                </div>
                            </div>
                            <div id="error-message" class="alert alert-danger" style="display:none;">
                                Au moins une réponse doit être correcte.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/questions/question-edit.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/form-validation/form-validation.js')); ?>"></script>
<?php $__env->stopPush(); ?>






<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/question/questionedit.blade.php ENDPATH**/ ?>