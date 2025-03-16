


<?php $__env->startSection('title'); ?> 
    Modifier une Leçon 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Modifier une Leçon</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Leçons</li>
        <li class="breadcrumb-item active">Modifier</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('lessonupdate', $lesson->id)); ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <label class="form-label">Titre</label>
                                <input class="form-control" type="text" name="titre" placeholder="Titre" value="<?php echo e(old('titre', $lesson->titre)); ?>" required />
                                <div class="invalid-feedback">Veuillez entrer un titre.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="4" name="description" placeholder="Description" required><?php echo e(old('description', $lesson->description)); ?></textarea>
                                <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Durée (HH:mm)</label>
                                <input class="form-control" type="text" name="duree" value="<?php echo e(old('duree', \Carbon\Carbon::parse($lesson->duree)->format('H:i'))); ?>" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                <div class="invalid-feedback">Veuillez entrer une durée valide.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Chapitre</label>
                                <select class="form-select select2-chapitre" name="chapitre_id" required>
                                    <option value="" disabled>Choisir un chapitre</option>
                                    <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($chapitre->id); ?>" <?php echo e(old('chapitre_id', $lesson->chapitre_id) == $chapitre->id ? 'selected' : ''); ?>><?php echo e($chapitre->titre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner un chapitre.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fichier</label>
                                <input class="form-control" type="file" name="file_path" />
                                <?php if($lesson->file_path): ?>
                                    <p class="mt-2">Fichier actuel : <a href="<?php echo e(asset('storage/' . $lesson->file_path)); ?>" target="_blank">Voir le fichier</a></p>
                                <?php endif; ?>
                            </div>

                            <h3>Liens existants</h3>
                            <ul>
                                <?php if(!empty($lesson->link)): ?>
                                    <?php 
                                        $links = trim($lesson->link, '[]"');
                                        $links = explode(',', $links);
                                    ?>
                                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $trimmedLink = trim($link);
                                            $cleanLink = str_replace(['\\/', '"', "'"], '/', $trimmedLink);
                                            $cleanLink = trim($cleanLink, '/');
                                            $formattedLink = Str::startsWith($cleanLink, ['http://', 'https://']) ? $cleanLink : 'http://' . $cleanLink;
                                        ?>
                                        <li><a href="<?php echo e($formattedLink); ?>" target="_blank"><?php echo e($cleanLink); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <li>Aucun lien disponible</li>
                                <?php endif; ?>
                            </ul>

                            <div class="mb-3">
                                <label for="link">Modifier les liens (un lien par ligne)</label>
                                <?php
                                    $links = !empty($lesson->link) ? json_decode($lesson->link) : [];
                                    $displayLinks = implode("\n", $links);
                                ?>
                                <textarea class="form-control" name="link" id="link" rows="4" placeholder="Entrez un lien par ligne."><?php echo e(old('link', $displayLinks)); ?></textarea>
                                <small class="form-text text-muted">Entrez un lien valide par ligne.</small>
                                <div class="invalid-feedback">Veuillez entrer des liens valides.</div>
                            </div>

                            <div class="text-end">
                                <button class="btn btn-secondary me-3" type="submit">Modifier</button>
                                <a href="<?php echo e(route('lessons')); ?>" class="btn btn-danger px-4">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/select2-init/single-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation/form-validation.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/lecons/link-validation.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/lesson/lessonedit.blade.php ENDPATH**/ ?>