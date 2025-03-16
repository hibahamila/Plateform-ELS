





<?php $__env->startSection('title'); ?> Liste des Catégories
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/table.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom-style.css')); ?>">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('breadcrumb_title'); ?>
        <h3>Liste des Catégories</h3>
    <?php $__env->endSlot(); ?>
    <li class="breadcrumb-item">Apps</li>
    <li class="breadcrumb-item active">Liste des Catégories</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Catégories Disponibles</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" id="success-message" style="display: none;">
                    </div>

                    <?php if(session('delete')): ?>
                        <div class="alert alert-danger" id="delete-message">
                            <?php echo e(session('delete')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="row project-cards">
                        <div class="col-md-12 project-list">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6 p-0"></div>
                                        <div class="row project-cards">
                                            <div class="col-md-12 project-list">
                                                <div class="card">
                                                    <div class="row">
                                                        <!-- Conteneur du bouton aligné à droite sans cadre -->
                                                        


                                                        <div class="col-md-6 p-0">
                                                            <a class="btn btn-primary custom-btn" href="<?php echo e(route('categoriecreate')); ?>">
                                                                <i data-feather="plus-square"></i>Ajouter une Catégorie
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="dataTable display" id="categories-table">
                            <thead>
                                <tr>
                                    <th>Nom de la Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($categorie->titre); ?>

                                            <div class="dropdown float-right">
                                                <button class="btn btn-sm btn-light dropdown-toggle no-caret" type="button" id="actionMenu<?php echo e($categorie->id); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionMenu<?php echo e($categorie->id); ?>">
                                                    <a class="dropdown-item" href="<?php echo e(route('categorieedit', $categorie->id)); ?>">
                                                        <i class="icofont icofont-ui-edit"></i>
                                                    </a>
                                                    <a class="dropdown-item text-danger delete-action" href="javascript:void(0);" data-delete-url="<?php echo e(route('categoriedestroy', $categorie->id)); ?>" data-type="catégorie" data-name="<?php echo e($categorie->titre); ?>" data-csrf="<?php echo e(csrf_token()); ?>">
                                                        <i class="icofont icofont-ui-delete"></i> 
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
    <script src="<?php echo e(asset('assets/js/dropdown/dropdown.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatables/datatables.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/categorie/categories.blade.php ENDPATH**/ ?>