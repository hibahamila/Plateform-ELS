

<?php $__env->startSection('content'); ?>
    <h1>Modifier une formation</h1>
    <form action="<?php echo e(route('formations.update', $formation->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?> <!-- Permet d'envoyer une requête PUT pour la mise à jour -->

        <!-- Champ Titre -->
        <input type="text" name="titre" value="<?php echo e(old('titre', $formation->titre)); ?>" placeholder="Titre">

        <!-- Champ Description -->
        <input type="text" name="description" value="<?php echo e(old('description', $formation->description)); ?>" placeholder="Description">

        <!-- Champ Durée (au format HH:mm) -->
        <input type="text" name="duree" value="<?php echo e(old('duree', \Carbon\Carbon::parse($formation->duree)->format('H:i'))); ?>" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm">

        <!-- Champ Type -->
        <input type="text" name="type" value="<?php echo e(old('type', $formation->type)); ?>" placeholder="Type">

        <!-- Champ Prix avec un champ texte et un pattern pour les décimales -->
        <input type="text" name="prix" value="<?php echo e(old('prix', $formation->prix)); ?>" placeholder="Prix (ex: 12.500)" pattern="^\d+(\.\d{1,3})?$" title="Format: 12.500">

        <!-- Sélecteur de catégorie -->
        <select name="categorie_id">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($categorie->id); ?>" 
                    <?php if($categorie->id == $formation->categorie_id): ?> selected <?php endif; ?>>
                    <?php echo e($categorie->titre); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <!-- Bouton de soumission -->
        <button type="submit">Mettre à jour</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\OneDrive\Bureau\PFE\viho_admin_boilerplate\resources\views/formations/edit.blade.php ENDPATH**/ ?>