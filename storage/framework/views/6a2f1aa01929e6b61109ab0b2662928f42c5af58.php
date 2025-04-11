


<?php $__env->startSection('content'); ?>
   

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
                    <div class="card-header pb-0">
                        <h5>Modifier une question</h5>
                        <span>Modifiez les informations du question</span>
                    </div>
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

                            <!-- Enoncé -->
                            <div class="mb-3 row">
                                <label for="statement" class="col-sm-2 col-form-label">Enoncé <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-question-circle"></i></span>
                                        <input type="text" name="statement" class="form-control" value="<?php echo e(old('statement', $question->statement)); ?>" required>
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un énoncé valide.</div>
                                </div>
                            </div>

                            <!-- Quiz -->
                            <div class="mb-3 row">
                                <label for="quiz_id" class="col-sm-2 col-form-label">Quiz <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <select class="form-select select2-quiz" id="quiz_id" name="quiz_id" required>
                                                    <option value="" selected disabled>Sélectionnez un quiz</option>
                                                    <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($quiz->id); ?>" <?php echo e(old('quiz_id', $question->quiz_id) == $quiz->id ? 'selected' : ''); ?>><?php echo e($quiz->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Veuillez sélectionner un quiz valide.</div>
                                </div>
                            </div>

                            <!-- Nombre de réponses -->
                            <div class="mb-3 row">
                                <label for="response_count" class="col-sm-2 col-form-label">Nombre de réponses <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-list-ol"></i></span>
                                        <input type="number" name="response_count" id="response_count" class="form-control" min="1" max="10" value="<?php echo e(old('response_count', count($question->reponses))); ?>" required>
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un nombre de réponses valide (entre 1 et 10).</div>
                                </div>
                            </div>

                            <!-- Réponses -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Réponses <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div id="reponses-container">
                                        <?php $__currentLoopData = $question->reponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $reponse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mb-3 d-flex align-items-center reponse-item">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-check-circle"></i></span>
                                                    <input type="text" name="reponses[<?php echo e($index); ?>][content]" class="form-control response-input <?php echo e($errors->has("reponses.$index.content") ? 'is-invalid' : ''); ?>" 
                                                           value="<?php echo e(old("reponses.$index.content", $reponse->content)); ?>" required>
                                                    <input type="hidden" name="reponses[<?php echo e($index); ?>][id]" value="<?php echo e($reponse->id); ?>">
                                                    <input type="hidden" name="reponses[<?php echo e($index); ?>][is_correct]" value="0">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="reponses[<?php echo e($index); ?>][is_correct]" value="1" 
                                                               <?php echo e(old("reponses.$index.is_correct", $reponse->is_correct) ? 'checked' : ''); ?>>
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm remove-btn"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Message d'erreur -->
                            <div id="error-message" style="display: none; color: #FF4B59; margin-top: 10px; text-align: center;">
                                Vous devez sélectionner au moins une réponse correcte.
                            </div>

                            <!-- Boutons de soumission -->
                            <div class="row mt-3">
                                <div class="col-sm-10 offset-sm-2 text-end">
                                    <button class="btn btn-secondary me-3" type="submit">
                                        <i class="fa fa-save"></i> Modifier
                                    </button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('questions')); ?>'">
                                        <i class="fa fa-times"></i> Annuler
                                    </button>
                                </div>
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
    <script src="<?php echo e(asset('assets/js/MonJs/questions/question-edit.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/form-validation/form-validation.js')); ?>"></script>
         <script src="https://cdn.tiny.cloud/1/cwjxs6s7k08kvxb3t6udodzrwpomhxtehiozsu4fem2igekf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/question/questionedit.blade.php ENDPATH**/ ?>