

<?php $__env->startSection('content'); ?>
    <h1>Liste des formations</h1>

    <!-- Affichage des messages de succès avec animation -->
    <?php if(session('success')): ?>
        <div class="alert alert-success" id="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Bouton pour ajouter une nouvelle formation -->
    <a href="<?php echo e(route('formations.create')); ?>" class="btn btn-primary mb-3">Ajouter une formation</a>

    <!-- Table pour afficher la liste des formations -->
    <div class="card">
        <div class="card-header pb-0">
            <h5>Formations Disponibles</h5>
        </div>
        <div class="card-body">
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
                                <a href="<?php echo e(route('formations.edit', $formation->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
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

    <!-- Ajouter le script JavaScript -->
    <script>
        window.onload = function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                // Rendre le message visible immédiatement
                successMessage.style.opacity = 1;
                // Après 0.5 secondes, faire disparaître rapidement
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.5s ease';
                    successMessage.style.opacity = 0;
                }, 500); // Délai de 0.5 seconde avant de commencer à disparaître
            }
        }
    </script>

    <!-- Ajouter le style CSS pour l'animation -->
    <style>
        /* Style initial du message */
        #success-message {
            opacity: 0;
            transition: opacity 0.5s ease; /* Définir une transition rapide */
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/formations/index.blade.php ENDPATH**/ ?>