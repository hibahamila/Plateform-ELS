

<?php $__env->startSection('title'); ?>Liste des Formations
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<!-- Ajoutez vos styles personnalisés ici -->
<style>
    /* Style initial du message */
    #success-message, #delete-message {
        opacity: 0;
        transition: opacity 0.3s ease; /* Transition plus rapide */
    }

    /* Message de succès : vert */
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    /* Message de suppression : rouge */
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    /* Style pour le bouton avec l'icône + */
    .custom-btn {
        background-color: #2b786a; /* Vert foncé */
        color: white;
        border-color: #2b786a;
    }

    .custom-btn:hover {
        background-color: #1f5c4d; /* Plus foncé au survol */
        border-color: #1f5c4d;
        color: white;
    }

    .custom-btn i {
        margin-right: 8px; /* Espacement entre l'icône et le texte */
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Liste des Formations</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item">Apps</li>
		<li class="breadcrumb-item active">Liste des Formations</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>Formations Disponibles</h5>
	                </div>
	                <div class="card-body">
                        <!-- Affichage des messages de succès avec animation -->
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

                        <div class="col-md-6 p-0">
	                        <div class="form-group mb-0 me-0" ></div>
	                        <a class="btn btn-primary"href="<?php echo e(route('formationcreate')); ?>"> <i data-feather="plus-square"> </i>Ajouter une formation</a>
	                    </div>

                        <!-- Table pour afficher la liste des formations -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Durée</th>
                                    <th>Type</th>
                                    <th>Prix</th>
                                    <th>Catégorie</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($formation->titre); ?></td>
                                        <td><?php echo e($formation->description); ?></td>
                                        <td><?php echo e($formation->duree); ?></td>
                                        <td><?php echo e($formation->type); ?></td>
                                        <td><?php echo e(number_format($formation->prix, 3)); ?> Dt</td>
                                        <td><?php echo e($formation->categorie->titre); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('formations.show', $formation->id)); ?>" class="btn btn-info btn-sm">Voir</a>
                                            <a href="<?php echo e(route('formationedit', $formation->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="<?php echo e(route('formations.destroy', $formation->id)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')">Supprimer</button>
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

	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>
    <script>
        window.onload = function() {
            const successMessage = document.getElementById('success-message');
            const deleteMessage = document.getElementById('delete-message');

            if (successMessage) {
                // Rendre le message visible immédiatement
                successMessage.style.opacity = 1;
                // Après 2 secondes, faire disparaître rapidement
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.3s ease';
                    successMessage.style.opacity = 0;
                }, 2000); // Délai de 2 secondes avant de commencer à disparaître
            }

            if (deleteMessage) {
                // Rendre le message visible immédiatement
                deleteMessage.style.opacity = 1;
                // Après 2 secondes, faire disparaître rapidement
                setTimeout(() => {
                    deleteMessage.style.transition = 'opacity 0.3s ease';
                    deleteMessage.style.opacity = 0;
                }, 2000); // Délai de 2 secondes avant de commencer à disparaître
            }
        }
    </script>
	<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/admin/apps/formation/formationindex.blade.php ENDPATH**/ ?>