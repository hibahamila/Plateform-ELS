

<?php $__env->startSection('title'); ?> Liste des Quizzes
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('breadcrumb_title'); ?>
        <h3>Liste des Quizzes</h3>
    <?php $__env->endSlot(); ?>
    <li class="breadcrumb-item">Quizzes</li>
    <li class="breadcrumb-item active">Liste des Quizzes</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Liste des Quizzes</h5>
                </div>
                <div class="card-body">
                    <!-- Affichage des messages de succès et de suppression avec animation -->
                    <?php if(session('success')): ?>
                        <div class="alert alert-success" id="success-message">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('delete')): ?>
                        <div class="alert alert-danger" id="delete-message">
                            <?php echo e(session('delete')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="row project-cards">
                        <div class="col-md-12 project-list">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6 p-0"></div>
                                    <div class="col-md-6 p-0">
                                        <div class="form-group mb-0 me-0"></div>
                                        <a class="btn btn-primary custom-btn" href="<?php echo e(route('quizcreate')); ?>">
                                            <i class="fa fa-plus"></i> Ajouter un Quiz
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table pour afficher la liste des quizzes -->
                    <table class="table table-striped">
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
                                        
                                        <a href="<?php echo e(route('quizedit', $quiz->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="<?php echo e(route('quizdestroy', $quiz->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce Quiz ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
            }, 2000);
        }

        if (deleteMessage) {
            deleteMessage.style.opacity = 1;
            setTimeout(() => {
                deleteMessage.style.transition = 'opacity 0.3s ease';
                deleteMessage.style.opacity = 0;
            }, 2000);
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/admin/apps/quiz/quizzes.blade.php ENDPATH**/ ?>