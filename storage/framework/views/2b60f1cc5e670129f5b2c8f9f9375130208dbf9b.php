

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Ajouter une Question</h2>
    <form action="<?php echo e(route('questions.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="enonce" class="form-label">Enonce</label>
            <input type="text" class="form-control" name="enonce" required>
        </div>
        
        <div class="mb-3">
            <label for="quiz_id" class="form-label">Quiz</label>
            <select class="form-control" name="quiz_id" required>
                <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($quiz->id); ?>"><?php echo e($quiz->titre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/questions/create.blade.php ENDPATH**/ ?>