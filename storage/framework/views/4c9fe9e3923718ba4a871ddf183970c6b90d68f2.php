

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;"> 

        <h2 class="text-center mb-4">Modifier la Leçon</h2>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        
        <!-- Affichage du message flash de succès -->
        <?php if(session('success')): ?>
        <div id="flashMessage" class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>

        <?php endif; ?>
    

        <form action="<?php echo e(route('lessons.update', $lesson->id)); ?>" method="POST" class="form theme-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" class="form-control" name="titre" value="<?php echo e($lesson->titre); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4" required><?php echo e($lesson->description); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Durée (HH:mm)</label>
                <input class="form-control" type="text" name="duree" value="<?php echo e(old('duree', \Carbon\Carbon::parse($lesson->duree)->format('H:i'))); ?>" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Chapitre</label>
                <select class="form-select" name="chapitre_id" required>
                    <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($chapitre->id); ?>" <?php echo e($lesson->chapitre_id == $chapitre->id ? 'selected' : ''); ?>><?php echo e($chapitre->titre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-update px-4">Modifier</button>
                <a href="<?php echo e(route('lessons.index')); ?>" class="btn btn-secondary px-4">Annuler</a>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-update {
        background-color: #2b786a; /* Couleur spécifiée */
        color: white;
        border: none;
    }

    .btn-update:hover,
    .btn-update:active {
        background-color: #236c58 !important; /* Teinte plus foncée au survol */
        color: white;
    }

    .d-flex {
        display: flex;
        justify-content: space-between; /* Espacement entre les boutons */
    }

    .mb-2 {
        margin-bottom: 10px;
    }

    /* Animation pour le message flash */
    #flashMessage {
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    }

</style>
<?php if(session('success')): ?>
    window.addEventListener("load", function() {
        const flashMessage = document.getElementById('flashMessage');
        console.log(flashMessage);  // Vérifie si l'élément est bien récupéré
        
        flashMessage.style.opacity = '1';
        flashMessage.style.transform = 'translateY(0)';
        
        setTimeout(function() {
            flashMessage.style.opacity = '0';
            flashMessage.style.transform = 'translateY(-10px)';
        }, 3000);
    });
<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/lessons/edit.blade.php ENDPATH**/ ?>