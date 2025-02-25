

<?php $__env->startSection('content'); ?>
    <h1>Détails de la Question</h1>

    <div>
        <p><strong>Enoncé :</strong> <?php echo e($question->enonce); ?></p>
    </div>

    <h2>Réponses associées :</h2>
    <?php if($question->reponses->count() > 0): ?>
        <ul>
            <?php $__currentLoopData = $question->reponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reponse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($reponse->contenu); ?> - <strong><?php echo e($reponse->est_correcte ? 'Correcte' : 'Incorrecte'); ?></strong></li>

            

                
                

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <p>Aucune réponse associée à cette question.</p>
    <?php endif; ?>

    <a href="<?php echo e(route('questions.edit', $question->id)); ?>" class="btn btn-primary">Modifier</a>
    <form action="<?php echo e(route('questions.destroy', $question->id)); ?>" method="POST" style="display:inline;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    <a href="<?php echo e(route('questions.index')); ?>" class="btn btn-secondary">Retour à la liste des questions</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/questions/show.blade.php ENDPATH**/ ?>