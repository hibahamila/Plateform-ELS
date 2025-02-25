

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <h2 class="text-center mb-4">Modifier la Réponse</h2>

        <!-- Affichage des messages d'erreur -->
        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Affichage du message flash de succès -->
        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('reponses.update', $reponse->id)); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label">Question</label>
                <select class="form-select" name="question_id" required>
                    <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($question->id); ?>" <?php echo e(old('question_id', $reponse->question_id) == $question->id ? 'selected' : ''); ?>>
                            <?php echo e($question->enonce); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Contenu</label>
                <input class="form-control" type="text" name="contenu" value="<?php echo e(old('contenu', $reponse->contenu)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Est correcte ?</label>
                <select class="form-select" name="est_correcte" required>
                    <option value="1" <?php echo e(old('est_correcte', $reponse->est_correcte) == 1 ? 'selected' : ''); ?>>Oui</option>
                    <option value="0" <?php echo e(old('est_correcte', $reponse->est_correcte) == 0 ? 'selected' : ''); ?>>Non</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn custom-btn px-4" type="submit">Modifier</button>
                <a href="<?php echo e(route('reponses.index')); ?>" class="btn btn-secondary px-4">Annuler</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/reponses/edit.blade.php ENDPATH**/ ?>