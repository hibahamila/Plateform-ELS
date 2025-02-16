

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Modifier le Quiz</h2>

    <form action="<?php echo e(route('quizzes.update', $quiz->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" value="<?php echo e(old('titre', $quiz->titre)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required><?php echo e(old('description', $quiz->description)); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="date_limite" class="form-label">Date Limite</label>
            <input type="date" class="form-control" name="date_limite" value="<?php echo e(old('date_limite', $quiz->date_limite)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de Fin</label>
            <input type="date" class="form-control" name="date_fin" value="<?php echo e(old('date_fin', $quiz->date_fin)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="cours_id" class="form-label">Cours</label>
            <select class="form-control" name="cours_id" required>
                <?php $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coursItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($coursItem->id); ?>" <?php echo e($quiz->Cours_id == $coursItem->id ? 'selected' : ''); ?>><?php echo e($coursItem->titre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="score_minimum" class="form-label">Score Minimum</label>
            <input type="number" class="form-control" name="score_minimum" value="<?php echo e(old('score_minimum', $quiz->score_minimum)); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/quizzes/edit.blade.php ENDPATH**/ ?>