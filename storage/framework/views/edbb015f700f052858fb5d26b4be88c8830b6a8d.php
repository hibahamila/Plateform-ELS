




<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Liste des Cours</h2>

    <!-- Affichage des messages de succès -->
    <?php if(session('success')): ?>
        <div class="alert alert-success" id="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Affichage du message de suppression -->
    <?php if(session('delete')): ?>
        <div class="alert alert-danger" id="delete-message">
            <?php echo e(session('delete')); ?>

        </div>
    <?php endif; ?>

    <!-- Bouton pour ajouter un cours -->
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo e(route('cours.create')); ?>" class="btn custom-btn px-4" style="margin-right: 10px;">
            <i class="fa fa-plus"></i> Ajouter un Cours
        </a>
    </div>

    <!-- Table pour afficher la liste des cours -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Utilisateur</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($cour->titre); ?></td>
                    <td><?php echo e($cour->description); ?></td>
                    <td><?php echo e($cour->date_debut); ?></td>
                    <td><?php echo e($cour->date_fin); ?></td>
                    <td><?php echo e($cour->user->name); ?></td>
                    <td><?php echo e($cour->formation->titre); ?></td>
                    <td>
                        <a href="<?php echo e(route('cours.show', $cour->id)); ?>" class="btn btn-info btn-sm">Voir</a>
                        <a href="<?php echo e(route('cours.edit', $cour->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="<?php echo e(route('cours.destroy', $cour->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce Cours ?')">
                                Supprimer
                            </button>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/cours/index.blade.php ENDPATH**/ ?>