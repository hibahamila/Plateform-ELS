


<?php $__env->startSection('title'); ?> 
    Modifier une Leçon 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/dropzone.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Mammoth.js pour les fichiers Word -->
<script src="https://unpkg.com/mammoth@1.4.8/mammoth.browser.min.js"></script>

<!-- SheetJS pour les fichiers Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier une Leçon</h5>
                        <span>Complétez les informations pour modifier la leçon</span>
                    </div>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form theme-form">
                            <form action="<?php echo e(route('lessonupdate', $lesson->id)); ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <?php echo csrf_field(); ?>
                                <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

                                <!-- Champ caché pour la route d'upload -->
                                <input type="hidden" id="uploadRoute" value="<?php echo e(route('upload.temp')); ?>">

                                <!-- Champ caché pour la route de suppression -->
                                <input type="hidden" id="deleteRoute" value="<?php echo e(route('delete.temp')); ?>">
                                <?php echo method_field('PUT'); ?>

                                <!-- Titre -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Titre <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                            <input class="form-control" type="text" name="title" placeholder="Titre" value="<?php echo e(old('title', $lesson->title)); ?>" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer un titre valide.</div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-align-left"></i></span>
                                            <textarea id="description" class="form-control" rows="4" name="description" placeholder="Description" required><?php echo e(old('description', $lesson->description)); ?></textarea>
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer une description valide.</div>
                                    </div>
                                </div>

                                <!-- Durée -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Durée (HH:mm) <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="icon-timer"></i></span>
                                            <input class="form-control" type="text" name="duration" value="<?php echo e(old('duration', \Carbon\Carbon::parse($lesson->duration)->format('H:i'))); ?>" placeholder="Durée (HH:mm)" pattern="\d{2}:\d{2}" title="Format: HH:mm" required />
                                        </div>
                                        <div class="invalid-feedback">Veuillez entrer une durée valide (HH:mm).</div>
                                    </div>
                                </div>

                                <!-- Chapitre -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Chapitre <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="input-group-text"><i class="fa fa-book"></i></span>
                                            </div>
                                            <div class="col">
                                                <select class="form-select select2-chapitre" name="chapitre_id" required>
                                                    <option value="" disabled>Choisir un chapitre</option>
                                                    <?php $__currentLoopData = $chapitres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapitre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($chapitre->id); ?>" <?php echo e(old('chapitre_id', $lesson->chapitre_id) == $chapitre->id ? 'selected' : ''); ?>><?php echo e($chapitre->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Veuillez sélectionner un chapitre valide.</div>
                                    </div>
                                </div>

                                <!-- Section pour les fichiers existants -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Fichiers existants</label>
                                    <div class="col-sm-10">
                                        <div class="existing-files" id="existing-files-container">
                                            <?php if(!empty($existingFiles) && count($existingFiles) > 0): ?>
                                                <?php $__currentLoopData = $existingFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="file-card" id="file-card-<?php echo e($file['id']); ?>">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="file-name" onclick="togglePreview('<?php echo e($file['url']); ?>', '<?php echo e($file['id']); ?>')">
                                                                <i class="fas fa-file me-2"></i> <?php echo e($file['name']); ?>

                                                            </div>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteFile('<?php echo e($lesson->id); ?>-<?php echo e($loop->index); ?>', event)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                        <div id="preview-<?php echo e($file['id']); ?>" class="file-preview" style="display: none;">
                                                            <!-- Le contenu du fichier sera chargé ici -->
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div class="alert alert-info">Aucun fichier disponible</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fichiers -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Fichiers <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="dropzone-container dz-clickable" id="multipleFilesUpload">
                                            <div class="dz-message needsclick">
                                                <i class="icon-cloud-up"></i>
                                                <h6>Déposez les fichiers ici ou cliquez pour les uploader.</h6>
                                                <span class="note needsclick">(Formats acceptés: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, MP4, MP3, ZIP, JPG, JPEG, PNG)</span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="uploaded_files" id="uploaded_files">
                                    </div>
                                </div>



                                <!-- Conteneur pour la prévisualisation des fichiers -->
                                <div id="filePreviewContainer" style="display:none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 9999; padding: 20px; overflow: auto;">
                                    <div class="card" style="max-width: 90%; margin: 20px auto; max-height: 90vh; overflow: hidden;">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Aperçu du fichier</h5>
                                            <button type="button" class="btn-close close-preview" aria-label="Close"></button>
                                        </div>
                                        <div class="card-body" id="filePreviewContent" style="max-height: calc(90vh - 60px); overflow: auto;">
                                            <!-- Le contenu sera inséré ici dynamiquement -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Liens existants -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Liens existants</label>
                                    <div class="col-sm-10">
                                        <ul class="list-group">
                                            <?php if(!empty($lesson->link)): ?>
                                                <?php 
                                                    $links = json_decode($lesson->link);
                                                ?>
                                                <?php if(count($links) > 0): ?>
                                                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <a href="<?php echo e($link); ?>" target="_blank"><?php echo e($link); ?></a>
                                                            <span class="badge bg-primary rounded-pill">
                                                                <i class="fas fa-external-link-alt"></i>
                                                            </span>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <li class="list-group-item">Aucun lien disponible</li>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <li class="list-group-item">Aucun lien disponible</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Liens -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Liens <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-link"></i></span>
                                            <?php
                                                $links = !empty($lesson->link) ? json_decode($lesson->link) : [];
                                                $displayLinks = implode("\n", $links);
                                            ?>
                                            <textarea class="form-control" name="link" id="link" rows="4" required placeholder="Entrez un lien par ligne."><?php echo e(old('link', $displayLinks)); ?></textarea>
                                        </div>
                                        <small class="form-text text-muted">Entrez un lien valide par ligne.</small>
                                        <div class="invalid-feedback">Veuillez entrer des liens valides.</div>
                                    </div>
                                </div>

                                <!-- Boutons de soumission -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end mt-4">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-save"></i> Modifier
                                            </button>
                                            <button class="btn btn-danger" type="button" onclick="window.location.href='<?php echo e(route('lessons')); ?>'">
                                                <i class="fa fa-times"></i> Annuler
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/MonJs/dropzone-config.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pptxjs/dist/pptxjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pptxgenjs@3.10.0/dist/pptxgen.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pptx2html/dist/pptx2html.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('assets/js/MonJs/select2-init/single-select.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/MonJs/form-validation/form-validation.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/MonJs/lecons/link-validation.js')); ?>"></script>
<script src="https://cdn.tiny.cloud/1/ofuiqykj9zattk5odkx0o1t79jxdfcb5eeuemjgcdtb1s95t/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?php echo e(asset('assets/js/MonJs/description/description.js')); ?>"></script>

<script>
    // Fonction pour supprimer un fichier
function deleteFile(lessonId, event) {
    event.preventDefault();
    
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Cette action supprimera définitivement ce fichier!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // Envoyer une requête AJAX pour supprimer le fichier
            $.ajax({
                url: '/admin/lesson/delete-file/' + lessonId,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Supprimer l'élément du DOM
                        $('#file-card-' + lessonId).remove();
                        
                        Swal.fire(
                            'Supprimé!',
                            'Le fichier a été supprimé avec succès.',
                            'success'
                        );
                        
                        // Si tous les fichiers sont supprimés, afficher un message
                        if ($('#existing-files-container .file-card').length === 0) {
                            $('#existing-files-container').html('<div class="alert alert-info">Aucun fichier disponible</div>');
                        }
                    } else {
                        Swal.fire(
                            'Erreur!',
                            response.message || 'Une erreur est survenue lors de la suppression du fichier.',
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error('Erreur AJAX:', xhr);
                    Swal.fire(
                        'Erreur!',
                        xhr.responseJSON && xhr.responseJSON.message 
                            ? xhr.responseJSON.message 
                            : 'Une erreur est survenue lors de la suppression du fichier.',
                        'error'
                    );
                }
            });
        }
    });
}

    // Fonction pour afficher/masquer l'aperçu du fichier
    function togglePreview(fileUrl, fileId) {
        const previewElement = $('#preview-' + fileId);
        
        if (previewElement.is(':visible')) {
            previewElement.slideUp();
        } else {
            // Déterminer le type de fichier
            const fileExtension = fileUrl.split('.').pop().toLowerCase();
            let previewContent = '';
            
            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                previewContent = `<img src="${fileUrl}" class="img-fluid mt-2" alt="Image preview">`;
            } else if (fileExtension === 'pdf') {
                previewContent = `<embed src="${fileUrl}" type="application/pdf" width="100%" height="300px" class="mt-2">`;
            } else if (['mp4', 'webm'].includes(fileExtension)) {
                previewContent = `<video controls width="100%" class="mt-2"><source src="${fileUrl}" type="video/${fileExtension}"></video>`;
            } else if (fileExtension === 'mp3') {
                previewContent = `<audio controls class="mt-2 w-100"><source src="${fileUrl}" type="audio/mpeg"></audio>`;
            } else {
                previewContent = `<div class="alert alert-info mt-2">Aperçu non disponible. <a href="${fileUrl}" target="_blank" class="alert-link">Télécharger le fichier</a></div>`;
            }
            
            previewElement.html(previewContent).slideDown();
        }
    }

    // Assurez-vous que le token CSRF est disponible
    if (!$('meta[name="csrf-token"]').length) {
        $('head').append('<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">');
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/lesson/lessonedit.blade.php ENDPATH**/ ?>