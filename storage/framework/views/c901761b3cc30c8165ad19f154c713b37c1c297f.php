


<?php $__env->startSection('content'); ?>
    <h1>Liste des Réponses</h1>

    <!-- Affichage des messages de succès ou de suppression -->
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

    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo e(route('reponses.create')); ?>" class="btn custom-btn px-4">
            <i class="fa fa-plus"></i> Ajouter une Réponse
        </a>
    </div>

    <div class="card">
        <div class="card-header pb-0">
            <h5>Réponses Disponibles</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Contenu</th>
                        <th>Correcte</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $reponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reponse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($reponse->id); ?></td>
                            <td><?php echo e($reponse->question->enonce); ?></td>
                            <td><?php echo e($reponse->contenu); ?></td>
                            <td><?php echo e($reponse->est_correcte ? 'Oui' : 'Non'); ?></td>
                            <td>
                                <a href="<?php echo e(route('reponses.edit', $reponse->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="<?php echo e(route('reponses.destroy', $reponse->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette réponse ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ajouter le script JavaScript pour l'animation des messages -->
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

    <!-- Ajouter le style CSS pour l'animation et le bouton -->
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/reponses/index.blade.php ENDPATH**/ ?>