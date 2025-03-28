









<?php $__env->startSection('title'); ?> Liste des Leçons
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/table.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/custom-style.css')); ?>">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('breadcrumb_title'); ?>
        <h3>Liste des Leçons</h3>
    <?php $__env->endSlot(); ?>
    <li class="breadcrumb-item">Leçons</li>
    <li class="breadcrumb-item active">Liste des Leçons</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Leçons Disponibles</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" id="success-message" style="display: none;">
                    </div>

                    <?php if(session('delete')): ?>
                        <div class="alert alert-danger" id="delete-message">
                            <?php echo e(session('delete')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary custom-btn" href="<?php echo e(route('lessoncreate')); ?>">
                            <i class="icofont icofont-plus-square"></i> Ajouter une Leçon
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class=" dataTable display" id="lessons-table">
                            <thead>
                                <tr>
                                    <th>title</th>
                                    <th>Description</th>
                                    <th>Durée</th>
                                    <th>Chapitre</th>
                                    <th>Fichier</th>
                                    <th>Liens</th>
                                    <th class="actions-column"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
                                <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($lesson->title); ?></td>
                                        <td><?php echo $lesson->description; ?></td> <!-- Modification ici -->

                                        <td><?php echo e($lesson->duration); ?></td>
                                        <td><?php echo e($lesson->chapitre->title ?? 'Non attribué'); ?></td>
                                        <td>
                                            
                                            <?php
                                            // Décoder le champ file_path (qui est un tableau JSON)
                                            $files = json_decode($lesson->file_path) ?? []; // Utiliser un tableau vide si file_path est null
                                        ?>
                        
                                        <?php if(count($files) > 0): ?>
                                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <!-- Afficher un lien pour chaque fichier -->
                                                <a href="<?php echo e(asset('storage/' . $file)); ?>" target="_blank"><?php echo e(basename($file)); ?></a><br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            Aucun fichier
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($lesson->link): ?>
                                                <?php
                                                    // Décoder les liens JSON ou les traiter comme une chaîne simple
                                                    $links = is_array(json_decode($lesson->link)) ? json_decode($lesson->link) : [$lesson->link];
                                                ?>
                                                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $trimmedLink = trim($link);
                                                        // Supprimer les guillemets et les caractères d'échappement
                                                        $cleanLink = str_replace(['\\/', '"', "'"], '/', $trimmedLink);
                                                        $formattedLink = Str::startsWith($cleanLink, ['http://', 'https://']) ? $cleanLink : 'http://' . $cleanLink;
                                                    ?>
                                                    <div><a href="<?php echo e($formattedLink); ?>" target="_blank"><?php echo e($cleanLink); ?></a></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                Aucun lien
                                            <?php endif; ?>
                                        </td>
                                        <td class="actions-column">
                                            <div class="dropdown float-right">
                                                <button class="btn btn-sm btn-light dropdown-toggle no-caret" type="button" id="actionMenu<?php echo e($lesson->id); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionMenu<?php echo e($lesson->id); ?>">
                                                    <a class="dropdown-item" href="<?php echo e(route('lessonedit', $lesson->id)); ?>">
                                                        <i class="icofont icofont-edit"></i> Modifier
                                                    </a>

                                                    <a class="dropdown-item text-danger delete-action" href="javascript:void(0);" data-delete-url="<?php echo e(route('lessondestroy', $lesson->id)); ?>" data-type="lesson" data-name="<?php echo e($lesson->title); ?>" data-csrf="<?php echo e(csrf_token()); ?>">
                                                        <i class="icofont icofont-ui-delete"></i> Supprimer
                                                    </a>
                                                </div>
                                            </div>
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
</div>

<?php $__env->startPush('scripts'); ?>
    
<script src="<?php echo e(asset('assets/js/MonJs/dropdown/dropdown.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/MonJs/datatables/datatables.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/lesson/lessons.blade.php ENDPATH**/ ?>