

<?php $__env->startSection('title'); ?>Step Form Wizard
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Step Form Wizard</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item">Forms</li>
		<li class="breadcrumb-item">Form Layout</li>
		<li class="breadcrumb-item active">Step Form Wizard</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row">
		  <div class="col-sm-12">
			<div class="card">
			  <div class="card-header">
				<h5>Form Wizard And Validation</h5><span>Validation Step Form Wizard</span>
			  </div>
			  <div class="card-body">
				<div class="stepwizard">
				  <div class="stepwizard-row setup-panel">
					<div class="stepwizard-step"><a class="btn btn-primary" href="#step-1">1</a>
					  <p>Step 1</p>
					</div>
					<div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
					  <p>Step 2</p>
					</div>
					<div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
					  <p>Step 3</p>
					</div>
					<div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
					  <p>Step 4</p>
					</div>
				  </div>
				</div>
				<form action="#" method="POST">
				  <div class="setup-content" id="step-1">
					<div class="col-xs-12">
					  <div class="col-md-12">
						<div class="form-group">
						  <label class="control-label">First Name</label>
						  <input class="form-control" type="text" placeholder="Johan" required="required">
						</div>
						<div class="form-group">
						  <label class="control-label">Last Name</label>
						  <input class="form-control" type="text" placeholder="Deo" required="required">
						</div>
						<button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
					  </div>
					</div>
				  </div>
				  <div class="setup-content" id="step-2">
					<div class="col-xs-12">
					  <div class="col-md-12">
						<div class="form-group">
						  <label class="control-label">Email</label>
						  <input class="form-control" type="text" placeholder="name@example.com" required="required">
						</div>
						<div class="form-group">
						  <label class="control-label">Password</label>
						  <input class="form-control" type="password" placeholder="Password" required="required">
						</div>
						<button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
					  </div>
					</div>
				  </div>
				  <div class="setup-content" id="step-3">
					<div class="col-xs-12">
					  <div class="col-md-12">
						<div class="form-group">
						  <label class="control-label">Birth date</label>
						  <input class="form-control" type="date" required="required">
						</div>
						<div class="form-group">
						  <label class="control-label">Have Passport</label>
						  <input class="form-control" type="text" placeholder="yes/No" required="required">
						</div>
						<button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
					  </div>
					</div>
				  </div>
				  <div class="setup-content" id="step-4">
					<div class="col-xs-12">
					  <div class="col-md-12">
						<div class="form-group">
						  <label class="control-label">State</label>
						  <input class="form-control mt-1" type="text" placeholder="State" required="required">
						</div>
						<div class="form-group">
						  <label class="control-label">City</label>
						  <input class="form-control mt-1" type="text" placeholder="City" required="required">
						</div>
						<button class="btn btn-secondary pull-right" type="submit">Finish!</button>
					  </div>
					</div>
				  </div>
				</form>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/form-wizard/form-wizard-two.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\forms\form-wizard-two.blade.php ENDPATH**/ ?>