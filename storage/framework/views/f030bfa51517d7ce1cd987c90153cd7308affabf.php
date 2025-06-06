

<?php $__env->startSection('title'); ?>AOS Animation
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/aos.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/photoswipe.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>AOS Animation</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item">Animation</li>
		<li class="breadcrumb-item active">AOS Animation</li>
	<?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>AOS Example animation</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gallery grid my-gallery" id="aniimated-thumbnials">
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/1.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/1.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 1</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/2.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/2.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 2</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/3.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/3.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 3</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/4.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/4.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 4</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/5.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/5.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 5</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/6.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/6.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 6</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/7.jpg')); ?>" data-size="11600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/7.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 7</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/8.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/8.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 8</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/9.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/9.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 9</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/10.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/10.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 10</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/11.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/11.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 11</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/12.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/12.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 12</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/14.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/14.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 13</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-left">
                                <a href="<?php echo e(asset('assets/images/big-masonry/15.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/15.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 14</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/13.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/13.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 15</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out">
                                <a href="<?php echo e(asset('assets/images/big-masonry/4.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/4.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 16</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-right">
                                <a href="<?php echo e(asset('assets/images/big-masonry/5.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/5.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 17</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out">
                                <a href="<?php echo e(asset('assets/images/big-masonry/6.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/6.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 18</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/7.jpg')); ?>" data-size="11600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/7.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 19</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/8.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/8.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 20</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/9.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/9.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 21</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="slide-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/10.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/10.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 22</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/9.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/9.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 23</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/10.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/10.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 24</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/11.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/11.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 25</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="fade-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/12.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/12.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 26</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/14.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/14.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 27</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-left">
                                <a href="<?php echo e(asset('assets/images/big-masonry/15.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/15.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 28</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-down">
                                <a href="<?php echo e(asset('assets/images/big-masonry/13.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/13.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 29</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out">
                                <a href="<?php echo e(asset('assets/images/big-masonry/4.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/4.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 30</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="flip-right">
                                <a href="<?php echo e(asset('assets/images/big-masonry/5.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/5.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 31</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out">
                                <a href="<?php echo e(asset('assets/images/big-masonry/6.jpg')); ?>" data-size="1600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/6.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 32</figcaption>
                            </figure>
                            <figure class="grid-item col-sm-4 col-md-3" data-aos="zoom-out-up">
                                <a href="<?php echo e(asset('assets/images/big-masonry/7.jpg')); ?>" data-size="11600x950"><img class="img-thumbnail" src="<?php echo e(asset('assets/images/masonry/7.jpg')); ?>" alt="Image description" /></a>
                                <figcaption>Image caption 33</figcaption>
                            </figure>
                        </div>
                        <!-- Root element of PhotoSwipe. Must have class pswp.-->
                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                            <!--
                          Background of PhotoSwipe.
                          It's a separate element, as animating opacity is faster than rgba().
                          -->
                            <div class="pswp__bg"></div>
                            <!-- Slides wrapper with overflow:hidden.-->
                            <div class="pswp__scroll-wrap">
                                <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                                <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                                <div class="pswp__container">
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                </div>
                                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                                <div class="pswp__ui pswp__ui--hidden">
                                    <div class="pswp__top-bar">
                                        <!-- Controls are self-explanatory. Order can be changed.-->
                                        <div class="pswp__counter"></div>
                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                        <button class="pswp__button pswp__button--share" title="Share"></button>
                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                                        <div class="pswp__preloader">
                                            <div class="pswp__preloader__icn">
                                                <div class="pswp__preloader__cut">
                                                    <div class="pswp__preloader__donut"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                        <div class="pswp__share-tooltip"></div>
                                    </div>
                                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                                    <div class="pswp__caption">
                                        <div class="pswp__caption__center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Init AOS</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <span class="comment">// The Below Function is example of how to initlize reveal</span>
                            <div class="line">
                                <span></span> &lt;script&gt; <span></span><br />
                                <code> AOS.init();</code><br />
                                <span> &lt;</span> /script <span> &gt; </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>How to use it?</h5>
                        <span>All you have to do is to add <code>data-aos</code> attribute to html element, like so:</span>
                    </div>
                    <div class="card-body">
                        <div class="txt-primary"><span> &lt;</span> div data-aos="animation_name" <span> &gt; </span></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Advanced settings</h5>
                        <span>These settings can be set both on certain elements, or as default while initializing script (in options object without <code> data- part).</code></span>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Attribute</th>
                                    <th>Description</th>
                                    <th>Example value</th>
                                    <th>Default value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <em><code>data-aos-offset</code></em>
                                    </td>
                                    <td>Change offset to trigger animations sooner or later (px)</td>
                                    <td>200</td>
                                    <td>120</td>
                                </tr>
                                <tr>
                                    <td>
                                        <em><code>data-aos-duration</code></em>
                                    </td>
                                    <td>*Duration of animation (ms)</td>
                                    <td>600</td>
                                    <td>400</td>
                                </tr>
                                <tr>
                                    <td>
                                        <em><code>data-aos-easing</code></em>
                                    </td>
                                    <td>Choose timing function to ease elements in different ways</td>
                                    <td>ease-in-sine</td>
                                    <td>ease</td>
                                </tr>
                                <tr>
                                    <td>
                                        <em><code>data-aos-delay</code></em>
                                    </td>
                                    <td>Delay animation (ms)</td>
                                    <td>300</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>
                                        <em><code>data-aos-anchor</code></em>
                                    </td>
                                    <td>Anchor element, whose offset will be counted to trigger animation instead of actual elements offset</td>
                                    <td>#selector</td>
                                    <td>null</td>
                                </tr>
                                <tr>
                                    <td>
                                        <em><code>data-aos-anchor-placement</code></em>
                                    </td>
                                    <td>Anchor placement - which one position of element on the screen should trigger animation</td>
                                    <td>top-center</td>
                                    <td>top-bottom</td>
                                </tr>
                                <tr>
                                    <td>
                                        <em><code>data-aos-once</code></em>
                                    </td>
                                    <td>Choose wheter animation should fire once, or every time you scroll up/down to element</td>
                                    <td>true</td>
                                    <td>false</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Animation</h5>
                        <span>There are serveral predefined animations you can use already:</span>
                    </div>
                    <div class="card-body">
                        <ul class="line">
                            <li>
                                <h5>Fade animations:</h5>
                                <ul class="ps-4 mb-4 list-circle">
                                    <li>fade</li>
                                    <li>fade-up</li>
                                    <li>fade-down</li>
                                    <li>fade-left</li>
                                    <li>fade-right</li>
                                    <li>fade-up-right</li>
                                    <li>fade-up-left</li>
                                    <li>fade-down-right</li>
                                    <li>fade-down-left</li>
                                </ul>
                            </li>
                            <li>
                                <h5>Flip animations:</h5>
                                <ul class="ps-4 mb-4 list-circle">
                                    <li>flip-up</li>
                                    <li>flip-down</li>
                                    <li>flip-left</li>
                                    <li>flip-right</li>
                                </ul>
                            </li>
                            <li>
                                <h5>Slide animations:</h5>
                                <ul class="ps-4 mb-4 list-circle">
                                    <li>slide-up</li>
                                    <li>slide-down</li>
                                    <li>slide-left</li>
                                    <li>slide-right</li>
                                </ul>
                            </li>
                            <li>
                                <h5>Zoom animations:</h5>
                                <ul class="ps-4 list-circle">
                                    <li>zoom-in</li>
                                    <li>zoom-in-up</li>
                                    <li>zoom-in-down</li>
                                    <li>zoom-in-left</li>
                                    <li>zoom-in-right</li>
                                    <li>zoom-out</li>
                                    <li>zoom-out-up</li>
                                    <li>zoom-out-down</li>
                                    <li>zoom-out-left</li>
                                    <li>zoom-out-right</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Anchor placement:</h5>
                    </div>
                    <div class="card-body">
                        <ul class="ps-4 list-circle line">
                            <li>top-bottom</li>
                            <li>top-center</li>
                            <li>top-top</li>
                            <li>center-bottom</li>
                            <li>center-center</li>
                            <li>center-top</li>
                            <li>bottom-bottom</li>
                            <li>bottom-center</li>
                            <li>bottom-top</li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Easing functions:</h5>
                    </div>
                    <div class="card-body">
                        <ul class="ps-4 list-circle line">
                            <li>linear</li>
                            <li>ease</li>
                            <li>ease-in</li>
                            <li>ease-out</li>
                            <li>ease-in-out</li>
                            <li>ease-in-back</li>
                            <li>ease-out-back</li>
                            <li>ease-in-out-back</li>
                            <li>ease-in-sine</li>
                            <li>ease-out-sine</li>
                            <li>ease-in-out-sine</li>
                            <li>ease-in-quad</li>
                            <li>ease-out-quad</li>
                            <li>ease-in-out-quad</li>
                            <li>ease-in-cubic</li>
                            <li>ease-out-cubic</li>
                            <li>ease-in-out-cubic</li>
                            <li>ease-in-quart</li>
                            <li>ease-out-quart</li>
                            <li>ease-in-out-quart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/isotope.pkgd.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/animation/aos/aos.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/animation/aos/aos-init.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe-ui-default.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/animation/aos.blade.php ENDPATH**/ ?>