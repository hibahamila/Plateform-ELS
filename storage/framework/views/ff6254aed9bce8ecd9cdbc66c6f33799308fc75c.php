<div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050; max-width: 600px;"></div>
<?php $__env->startSection('title'); ?>Contacts
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/alert.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/role_permission.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Contacts</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item">Apps</li>
		<li class="breadcrumb-item active">Contacts</li>
        <div id="alert-container" class="mt-3"></div>
	<?php echo $__env->renderComponent(); ?>
	<div class="container-fluid">
	    <div class="email-wrap bookmark-wrap">
	        <div class="row">
	            <div class="col-xl-3">
	                <div class="email-sidebar">
	                    <a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">contact filter </a>
	                    <div class="email-left-aside">
	                        <div class="card">
	                            <div class="card-body">
	                                <div class="email-app-sidebar left-bookmark">
	                                    <ul class="nav main-menu contact-options" role="tablist">
	                                        <li class="nav-item">
                                                <button class="badge-light btn-block btn-mail w-100" type="button" id="loadCreateUserForm" data-create-url="<?php echo e(route('admin.users.create')); ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="me-2" data-feather="users"></i> Nouveau Utilisateur
                                                </button>
                                            </li>


	                                        <li class="nav-item"><span class="main-title"> Vues</span></li>
	                                        <li>
	                                            <a id="load-users" data-bs-toggle="pill" href="javascript:void(0)" data-user-url="<?php echo e(route('admin.users.index')); ?>" role="tab" aria-controls="pills-personal" aria-selected="true"><span class="title"> Utilisateurs</span></a>
	                                        </li>

                                            <li>
                                                <a href="javascript:void(0)" id="load-roles" data-roles-url="<?php echo e(route('admin.roles.index')); ?>">
                                                <span class="title">Gestion Rôles</span>
                                                </a>
                                            </li>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gérer des permissions')): ?>
                                                <li>
                                                    <a href="javascript:void(0)" id="load-permission" data-permission-url="<?php echo e(route('admin.permissions.index')); ?>"><span class="title">Gestion Permissions</span></a>
                                                </li>
                                            <?php endif; ?>

	                                    </ul>
	                                </div>

	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

                 <div class="col-xl-9">
                    <div id="blog-container">

                    </div>
                </div>

	        </div>
	    </div>
	</div>


	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/sweet-alert/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bookmark/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/contacts/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/modal-animated.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/roles/editRole.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/roles/createRole.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/roles/chargerRole.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/roles/deleteRole.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/permissions/chargerPermission.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/permissions/createPermission.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/permissions/editPermission.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/permissions/deletePermission.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/users/chargerUser.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/users/roles.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/users/status.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/users/supprimerUser.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/ajax/users/createUser.js')); ?>"></script>
    <script>

    </script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/contacts.blade.php ENDPATH**/ ?>