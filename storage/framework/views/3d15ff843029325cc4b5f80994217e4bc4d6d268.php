




<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Liste des Quizzes</h2>

    <!-- Affichage des messages de succès avec animation -->
    <?php if(session('success')): ?>
        <div class="alert alert-success" id="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <!-- Affichage des messages de suppression avec animation -->
    <?php if(session('delete')): ?>
        <div class="alert alert-danger" id="delete-message">
            <?php echo e(session('delete')); ?>

        </div>
    <?php endif; ?>

    <!-- Bouton pour ajouter un quiz -->
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo e(route('quizzes.create')); ?>" class="btn custom-btn px-4 me-2">
            <i class="fa fa-plus"></i> Ajouter un Quiz
        </a>
    </div>

    <!-- Table pour afficher la liste des quizzes -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Limite</th>
                <th>Date de Fin</th>
                <th>Score Minimum</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($quiz->titre); ?></td>
                <td><?php echo e($quiz->description); ?></td>
                <td><?php echo e($quiz->date_limite); ?></td>
                <td><?php echo e($quiz->date_fin); ?></td>
                <td><?php echo e($quiz->score_minimum); ?></td>
                <td>
                    <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="btn btn-info btn-sm">Voir</a>
                    <a href="<?php echo e(route('quizzes.edit', $quiz->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="<?php echo e(route('quizzes.destroy', $quiz->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce Quiz ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>


<!-- Script JavaScript pour l'animation des messages -->
<script>
    window.onload = function() {
        const successMessage = document.getElementById('success-message');
        const deleteMessage = document.getElementById('delete-message');

        if (successMessage) {
            successMessage.style.opacity = 1;
            setTimeout(() => {
                successMessage.style.transition = 'opacity 0.3s ease';
                successMessage.style.opacity = 0;
            }, 2000); // Disparaît après 2 secondes
        }

        if (deleteMessage) {
            deleteMessage.style.opacity = 1;
            setTimeout(() => {
                deleteMessage.style.transition = 'opacity 0.3s ease';
                deleteMessage.style.opacity = 0;
            }, 1000); // Disparaît après 1 seconde
        }
    }
</script>

<!-- Style CSS pour les messages et boutons -->
<style>
    #success-message, #delete-message {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .custom-btn {
        background-color: #2b786a;
        color: white;
        border-color: #2b786a;
    }

    .custom-btn:hover {
        background-color: #1f5c4d;
        border-color: #1f5c4d;
        color: white;
    }

    .custom-btn i {
        margin-right: 8px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/quizzes/index.blade.php ENDPATH**/ ?>