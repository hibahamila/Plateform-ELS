

<?php $__env->startSection('title'); ?> 
    Ajouter un Quiz 
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone/dropzone.css')); ?>">
    <link href="<?php echo e(asset('assets/css/custom-style.css')); ?>" rel="stylesheet">
    <!-- CSS de Select2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/css/SweatAlert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Nouveau Quiz</h5>
                        <span>Complétez les informations pour créer un nouveau quiz</span>
                    </div>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form theme-form">
                            <form action="<?php echo e(route('quizstore')); ?>" method="POST" class="needs-validation" novalidate>
                                <?php echo csrf_field(); ?>

                                <!-- Titre -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                            <input class="form-control" type="text" name="title" placeholder="Titre" value="<?php echo e(old('title')); ?>" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-align-left"></i></span>
                                            <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required><?php echo e(old('description')); ?></textarea>
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>

                                <!-- Date Limite -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Date Limite <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" name="deadline" value="<?php echo e(old('deadline')); ?>" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer une date limite valide.</div>
                                    </div>
                                </div>

                                <!-- Date de Fin -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Date de Fin <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" name="end_date" value="<?php echo e(old('end_date')); ?>" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer une date de fin valide.</div>
                                    </div>
                                </div>

                                <!-- Cours -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Cours <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="input-group-text"><i class="fa fa-book"></i></span>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <select class="form-select select2-cours" name="cours_id" required>
                                                    <option value="" selected disabled>Choisir un cours</option>
                                                    <?php $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($coursItem->id); ?>" <?php echo e(old('cours_id') == $coursItem->id ? 'selected' : ''); ?>>
                                                        <?php echo e($coursItem->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
                                    </div>
                                </div>

                                <!-- Score Minimum -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Score Minimum <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-star"></i></span>
                                            <input class="form-control" type="number" name="minimum_score" placeholder="Score Minimum" min="1" value="<?php echo e(old('minimum_score')); ?>" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer un score minimum valide.</div>
                                    </div>
                                </div>

                                <!-- Boutons de soumission -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end mt-4">
                                            <button class="btn btn-primary" type="submit" id="submitBtn">
                                                <i class="fa fa-save"></i> Ajouter
                                            </button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('quizzes')); ?>'">
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
    <script src="<?php echo e(asset('assets/js/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation/form-validation.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="<?php echo e(asset('assets/js/description/description.js')); ?>"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélectionner le formulaire
            const form = document.querySelector('form.needs-validation');
            const submitBtn = document.getElementById('submitBtn');

            // Intercepter l'événement de soumission du formulaire
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }
                
                // Si le formulaire est valide, on le soumet normalement
                // La redirection sera gérée par le contrôleur
            });

            // Vérifier si un quiz_id existe dans la session après la redirection
            let quizId = "<?php echo e(session('quiz_id')); ?>";
            
            if (quizId) {
                // Afficher l'alerte SweetAlert2 après la création du quiz
                Swal.fire({
                    title: "Quiz ajouté avec succès !",
                    text: "Voulez-vous ajouter une question à ce quiz ?",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonText: "Oui, ajouter une question",
                    cancelButtonText: "Non, revenir à la liste",
                    showCloseButton: true,
                    customClass: {
                        confirmButton: 'custom-confirm-btn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Rediriger vers la page de création de question avec l'ID du quiz
                        window.location.href = "<?php echo e(route('questioncreate')); ?>?quiz_id=" + quizId;
                    } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                        // Rediriger vers la liste des quizzes si l'utilisateur clique sur "Non"
                        window.location.href = "<?php echo e(route('quizzes')); ?>";
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/quiz/quizcreate.blade.php ENDPATH**/ ?>