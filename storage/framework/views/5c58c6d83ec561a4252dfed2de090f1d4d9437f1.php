

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Liste des Chapitres</h2>

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

    <!-- Bouton pour ajouter un chapitre -->
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo e(route('chapitres.create')); ?>" class="btn custom-btn px-4" style="margin-right: 10px;">
            <i class="fa fa-plus"></i> Ajouter un Chapitre
        </a>
    </div>

    <!-- Table pour afficher la liste des chapitres -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Cours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($chapitre->titre); ?></td>
                <td><?php echo e($chapitre->description); ?></td>
                <td><?php echo e($chapitre->duree); ?></td>
                <td><?php echo e($chapitre->cours->titre); ?></td>
                <td>
                    <a href="<?php echo e(route('chapitres.show', $chapitre->id)); ?>" class="btn btn-info btn-sm">Voir</a>
                    <a href="<?php echo e(route('chapitres.edit', $chapitre->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="<?php echo e(route('chapitres.destroy', $chapitre->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce chapitre ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!-- Script pour gérer l'affichage des messages -->
<script>
    window.onload = function() {
        const successMessage = document.getElementById('success-message');
        const deleteMessage = document.getElementById('delete-message');

        if (successMessage) {
            successMessage.style.opacity = 1;
            setTimeout(() => {
                successMessage.style.transition = 'opacity 0.5s ease';
                successMessage.style.opacity = 0;
            }, 1500);
        }

        if (deleteMessage) {
            deleteMessage.style.opacity = 1;
            setTimeout(() => {
                deleteMessage.style.transition = 'opacity 0.5s ease';
                deleteMessage.style.opacity = 0;
            }, 1500);
        }
    }
</script>

<!-- Styles CSS pour les alertes et le bouton -->
<style>
    #success-message, #delete-message {
        opacity: 1;
        transition: opacity 0.5s ease;
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/chapitres/index.blade.php ENDPATH**/ ?>