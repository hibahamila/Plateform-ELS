




<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <h2 class="text-center mb-4">Modifier le Quiz</h2>

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

        <form action="<?php echo e(route('quizzes.update', $quiz->id)); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input class="form-control" type="text" name="titre" value="<?php echo e(old('titre', $quiz->titre)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="4" name="description" required><?php echo e(old('description', $quiz->description)); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Date Limite</label>
                <input class="form-control" type="date" name="date_limite" value="<?php echo e(old('date_limite', $quiz->date_limite)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Date de Fin</label>
                <input class="form-control" type="date" name="date_fin" value="<?php echo e(old('date_fin', $quiz->date_fin)); ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Cours</label>
                <select class="form-select" name="cours_id" required>
                    <?php $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($coursItem->id); ?>" <?php echo e(old('cours_id', $quiz->cours_id) == $coursItem->id ? 'selected' : ''); ?>><?php echo e($coursItem->titre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Score Minimum</label>
                <input class="form-control" type="number" name="score_minimum" value="<?php echo e(old('score_minimum', $quiz->score_minimum)); ?>" required />
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn custom-btn px-4" type="submit">Mettre à jour</button>
                <a href="<?php echo e(route('quizzes.index')); ?>" class="btn btn-secondary px-4">Annuler</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/quizzes/edit.blade.php ENDPATH**/ ?>