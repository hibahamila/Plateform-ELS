

<?php $__env->startSection('title'); ?>Tour
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/tour.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Tour</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item">Advance</li>
		<li class="breadcrumb-item active">Tour</li>
	<?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
		<div class="user-profile">
			<div class="row">
				<!-- user profile first-style start-->
				<div class="col-sm-12">
					<div class="card hovercard text-center">
						<div class="cardheader"></div>
						<div class="user-image">
							<div class="avatar"><img alt="" src="<?php echo e(asset('assets/images/user/7.jpg')); ?>" data-intro="This is Profile image" /></div>
							<div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5" data-intro="Change Profile image here"></i></div>
						</div>
						<div class="info">
							<div class="row" data-intro="This is the your details">
								<div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
									<div class="row">
										<div class="col-md-6">
											<div class="ttl-info text-start">
												<h6><i class="fa fa-envelope"></i> Email</h6>
												<span>Marekjecno@yahoo.com</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="ttl-info text-start ttl-sm-mb-0">
												<h6><i class="fa fa-calendar"></i> BOD</h6>
												<span>02 January 1988</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
									<div class="user-designation">
										<div class="title"><a target="_blank" href="">Mark jecno</a></div>
										<div class="desc mt-2">designer</div>
									</div>
								</div>
								<div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
									<div class="row">
										<div class="col-md-6">
											<div class="ttl-info text-start ttl-xs-mt">
												<h6><i class="fa fa-phone"></i> Contact Us</h6>
												<span>India +91 123-456-7890</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="ttl-info text-start ttl-sm-mb-0">
												<h6><i class="fa fa-location-arrow"></i> Location</h6>
												<span>B69 Near Schoool Demo Home</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr />
							<div class="social-media" data-intro="This is your Social details">
								<ul class="list-inline">
									<li class="list-inline-item">
										<a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
									</li>
									<li class="list-inline-item">
										<a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
									</li>
									<li class="list-inline-item">
										<a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
									</li>
									<li class="list-inline-item">
										<a href="javascript:void(0)"><i class="fa fa-instagram"></i></a>
									</li>
									<li class="list-inline-item">
										<a href="javascript:void(0)"><i class="fa fa-rss"></i></a>
									</li>
								</ul>
							</div>
							<div class="follow">
								<div class="row">
									<div class="col-6 border-right">
										<div class="follow-num counter">25869</div>
										<span>Follower</span>
									</div>
									<div class="col-6">
										<div class="follow-num counter">659887</div>
										<span>Following</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- user profile first-style end-->
				<!-- user profile second-style start-->
				<div class="col-sm-12" data-intro="This is the your first Post">
					<div class="card">
						<div class="profile-img-style">
							<div class="row">
								<div class="col-sm-8">
									<div class="media">
										<img class="img-thumbnail rounded-circle me-3" src="<?php echo e(asset('assets/images/user/7.jpg')); ?>" alt="Generic placeholder image" />
										<div class="media-body align-self-center">
											<a href="#"> <h5 class="mt-0 user-name">JOHAN DIO</h5></a>
										</div>
									</div>
								</div>
								<div class="col-sm-4 align-self-center">
									<div class="float-sm-right"><small>10 Hours ago</small></div>
								</div>
							</div>
							<hr />
							<p>
								you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks
								as necessary, making this the first true generator on the Internet.
							</p>
							<div class="img-container">
								<div id="aniimated-thumbnials">
									<a href="<?php echo e(asset('assets/images/other-images/profile-style-img3.png')); ?>"><img class="img-fluid rounded" src="<?php echo e(asset('assets/images/other-images/profile-style-img3.png')); ?>" alt="gallery" /></a>
								</div>
							</div>
							<div class="like-comment mt-4">
								<ul class="list-inline">
									<li class="list-inline-item border-right pe-3">
										<label class="m-0">
											<a href="javascript:void(0)"><i class="fa fa-heart"></i></a> Like
										</label>
										<span class="ms-2 counter">2659</span>
									</li>
									<li class="list-inline-item ms-2">
										<label class="m-0">
											<a href="javascript:void(0)"><i class="fa fa-comment"></i></a> Comment
										</label>
										<span class="ms-2 counter">569</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- user profile second-style end-->
				<!-- user profile third-style start-->
				<div class="col-sm-12">
					<div class="card">
						<div class="profile-img-style">
							<div class="row">
								<div class="col-sm-8">
									<div class="media">
										<img class="img-thumbnail rounded-circle me-3" src="<?php echo e(asset('assets/images/user/7.jpg')); ?>" alt="Generic placeholder image" />
										<div class="media-body align-self-center"></div>
										<a href="#"> <h5 class="mt-0 user-name">JOHAN DIO</h5></a>
									</div>
								</div>
								<div class="col-sm-4 align-self-center">
									<div class="float-sm-right"><small>10 Hours ago</small></div>
								</div>
							</div>
							<hr />
							<p>
								you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks
								as necessary, making this the first true generator on the Internet.
							</p>
							<div class="row mt-4 pictures" id="aniimated-thumbnials-2">
								<a class="col-sm-6" href="<?php echo e(asset('assets/images/other-images/profile-style-img3.png')); ?>"><img class="img-fluid rounded" src="<?php echo e(asset('assets/images/other-images/profile-style-img.png')); ?>" alt="gallery" /></a>
								<a class="col-sm-6" href="<?php echo e(asset('assets/images/other-images/profile-style-img3.png')); ?>"><img class="img-fluid rounded" src="<?php echo e(asset('assets/images/other-images/profile-style-img.png')); ?>" alt="gallery" /></a>
							</div>
							<div class="like-comment mt-4">
								<ul class="list-inline">
									<li class="list-inline-item border-right pe-3">
										<label class="m-0">
											<a href="javascript:void(0)"><i class="fa fa-heart"></i></a> Like
										</label>
										<span class="ms-2 counter">2659</span>
									</li>
									<li class="list-inline-item ms-2">
										<label class="m-0">
											<a href="javascript:void(0)"><i class="fa fa-comment"></i></a> Comment
										</label>
										<span class="ms-2 counter">569</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- user profile third-style end-->
				<!-- user profile fourth-style start-->
				<div class="col-sm-12">
					<div class="card">
						<div class="profile-img-style">
							<div class="row">
								<div class="col-sm-8">
									<div class="media">
										<img class="img-thumbnail rounded-circle me-3" src="<?php echo e(asset('assets/images/user/7.jpg')); ?>" alt="Generic placeholder image" />
										<div class="media-body align-self-center">
											<a href="#"> <h5 class="mt-0 user-name">JOHAN DIO</h5></a>
										</div>
									</div>
								</div>
								<div class="col-sm-4 align-self-center">
									<div class="float-sm-right"><small>10 Hours ago</small></div>
								</div>
							</div>
							<hr />
							<p>
								Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at
								Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the
								undoubtable source .Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
								professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered
								the undoubtable source
							</p>
							<div class="like-comment mt-4">
								<ul class="list-inline">
									<li class="list-inline-item border-right pe-3">
										<label class="m-0">
											<a href="javascript:void(0)"><i class="fa fa-heart"></i></a> Like
										</label>
										<span class="ms-2 counter">2659</span>
									</li>
									<li class="list-inline-item ms-2">
										<label class="m-0">
											<a href="javascript:void(0)"><i class="fa fa-comment"></i></a> Comment
										</label>
										<span class="ms-2 counter">569</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- user profile fourth-style end-->
				<!-- user profile fifth-style start-->
				<div class="col-sm-12">
					<div class="card">
						<div class="profile-img-style">
							<div class="row">
								<div class="col-sm-8">
									<div class="media">
										<img class="img-thumbnail rounded-circle me-3" src="<?php echo e(asset('assets/images/user/7.jpg')); ?>" alt="Generic placeholder image" />
										<div class="media-body align-self-center">
											<a href="#"> <h5 class="mt-0 user-name">JOHAN DIO</h5></a>
										</div>
									</div>
								</div>
								<div class="col-sm-4 align-self-center">
									<div class="float-sm-right"><small>10 Hours ago</small></div>
								</div>
							</div>
							<hr />
							<div class="row">
								<div class="col-lg-12 col-xl-4">
									<div id="aniimated-thumbnials-3">
										<a href="<?php echo e(asset('assets/images/blog/img.png')); ?>"><img class="img-fluid rounded" src="<?php echo e(asset('assets/images/blog/img.png')); ?>" alt="gallery" /></a>
									</div>
									<div class="like-comment mt-4 like-comment-lg-mb">
										<ul class="list-inline">
											<li class="list-inline-item border-right pe-3">
												<label class="m-0">
													<a href="javascript:void(0)"><i class="fa fa-heart"></i></a> Like
												</label>
												<span class="ms-2 counter">2659</span>
											</li>
											<li class="list-inline-item ms-2">
												<label class="m-0">
													<a href="javascript:void(0)"><i class="fa fa-comment"></i></a> Comment
												</label>
												<span class="ms-2 counter">569</span>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-xl-6">
									<p>
										Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at
										Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consecteturContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin
										literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- user profile fifth-style end-->
			</div>
		</div>
	</div>
	

<?php $__env->startPush('scripts'); ?> 
    <script src="<?php echo e(asset('assets/js/tour/intro.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/tour/intro-init.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/bonus-ui/tour.blade.php ENDPATH**/ ?>