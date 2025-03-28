


<?php $__env->startSection('title'); ?> Liste des Questions
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/table.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('breadcrumb_title'); ?>
        <h3>Liste des Questions</h3>
    <?php $__env->endSlot(); ?>
    <li class="breadcrumb-item">Questions</li>
    <li class="breadcrumb-item active">Liste des Questions</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Questions Disponibles</h5>
                </div>
                <div class="card-body">
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
                        <a class="btn btn-primary custom-btn" href="<?php echo e(route('questioncreate')); ?>">
                            <i class="icofont icofont-plus-square"></i> Ajouter une Question
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="display dataTable" id="questions-table">
                            <thead>
                                <tr>
                                    <th>Énoncé</th>
                                    <th>Quiz</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($question->statement); ?></td>
                                        <td><?php echo e($question->quiz->title); ?></td>
                                        <td>
                                            <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="<?php echo e(route('questionedit', $question->id)); ?>" style="cursor: pointer;"></i>
                                            <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="<?php echo e(route('questiondestroy', $question->id)); ?>" data-csrf="<?php echo e(csrf_token()); ?>" style="cursor: pointer;"></i>
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
    <script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/actions-icon/actions-icon.js')); ?>"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Inclure les scripts de DataTables -->
     <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
     
     <!-- Inclure le fichier JavaScript pour l'initialisation -->
     <script src="<?php echo e(asset('assets/js/MonJs/datatables/datatables.js')); ?>"></script>
    
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/question/questions.blade.php ENDPATH**/ ?>