

<?php $__env->startSection('title'); ?>Sign Up
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
	    <div class="container-fluid p-0">
	        <div class="row m-0">
	            <div class="col-xl-5"><img class="bg-img-cover bg-center" src="<?php echo e(asset('assets/images/login/3.jpg')); ?>" alt="looginpage" /></div>
	            <div class="col-xl-7 p-0">
	                <div class="login-card">
	                    <form class="theme-form login-form">
	                        <h4>Create your account</h4>
	                        <h6>Enter your personal details to create account</h6>
	                        <div class="form-group">
	                            <label>Your Name</label>
	                            <div class="small-group">
	                                <div class="input-group">
	                                    <span class="input-group-text"><i class="icon-user"></i></span>
	                                    <input class="form-control" type="email" required="" placeholder="First Name" />
	                                </div>
	                                <div class="input-group">
	                                    <span class="input-group-text"><i class="icon-user"></i></span>
	                                    <input class="form-control" type="email" required="" placeholder="Last Name" />
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label>Email Address</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-email"></i></span>
	                                <input class="form-control" type="email" required="" placeholder="Test@gmail.com" />
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label>Password</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-lock"></i></span>
	                                <input class="form-control" type="password" name="login[password]" required="" placeholder="*********" />
	                                <div class="show-hide"><span class="show"> </span></div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="checkbox">
	                                <input id="checkbox1" type="checkbox" />
	                                <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy </span></label>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <button class="btn btn-primary btn-block" type="submit">Create Account</button>
	                        </div>
	                        <div class="login-social-title">
	                            <h5>Sign in with</h5>
	                        </div>
	                        <div class="form-group">
	                            <ul class="login-social">
	                                <li>
	                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram"> </i></a>
	                                </li>
	                            </ul>
	                        </div>
	                        <p>Already have an account?<a class="ms-2" href="<?php echo e(route('login')); ?>">Sign in</a></p>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>


    <?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/sweet-alert/sweetalert.min.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\authentication\sign-up-one.blade.php ENDPATH**/ ?>