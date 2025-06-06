

<?php $__env->startSection('title'); ?>Helper Classes
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
        <h3>Helper Classes</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Base</li>
        <li class="breadcrumb-item active">Helper Classes</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Padding</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.p-0 {
padding: 0px;
}
.p-5 {
padding: 5px;
}
.p-10 {
padding: 10px;
}
.p-15 {
padding: 15px;
}
.p-20 {
padding: 20px;
}
.p-25 {
padding: 25px;
}
.p-30 {
padding: 30px;
}
.p-35 {
padding: 35px;
}
.p-40 {
padding: 40px;
}
.p-45 {
padding: 45px;
}
.p-50 {
padding: 50px;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Margins</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.m-0 {
margin: 0px !important;
}
.m-5 {
margin: 5px !important;
}
.m-10 {
margin: 10px !important;
}
.m-15 {
margin: 15px !important;
}
.m-20 {
margin: 20px !important;
}
.m-25 {
margin: 25px !important;
}
.m-30 {
margin: 30px !important;
}
.m-35 {
margin: 35px !important;
}
.m-40 {
margin: 40px !important;
}
.m-45 {
margin: 45px !important;
}
.m-50 {
margin: 50px !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Padding Left</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.p-l-0 {
padding-left: 0px;
}
.p-l-5 {
padding-left: 5px;
}
.p-l-10 {
padding-left: 10px;
}
.p-l-15 {
padding-left: 15px;
}
.p-l-20 {
padding-left: 20px;
}
.p-l-25 {
padding-left: 25px;
}
.p-l-30 {
padding-left: 30px;
}
.p-l-35 {
padding-left: 35px;
}
.p-l-40 {
padding-left: 40px;
}
.p-l-45 {
padding-left: 45px;
}
.p-l-50 {
padding-left: 50px;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Padding Right</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.p-r-0 {
padding-right: 0px;
}
.p-r-5 {
padding-right: 5px;
}
.p-r-10 {
padding-right: 10px;
}
.p-r-15 {
padding-right: 15px;
}
.p-r-20 {
padding-right: 20px;
}
.p-r-25 {
padding-right: 25px;
}
.p-r-30 {
padding-right: 30px;
}
.p-r-35 {
padding-right: 35px;
}
.p-r-40 {
padding-right: 40px;
}
.p-r-45 {
padding-right: 45px;
}
.p-r-50 {
padding-right: 50px;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Padding Top</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.p-t-0 {
padding-top: 0px !important;
}
.p-t-5 {
padding-top: 5px !important;
}
.p-t-10 {
padding-top: 10px !important;
}
.p-t-15 {
padding-top: 15px !important;
}
.p-t-20 {
padding-top: 20px !important;
}
.p-t-25 {
padding-top: 25px !important;
}
.p-t-30 {
padding-top: 30px !important;
}
.p-t-35 {
padding-top: 35px !important;
}
.p-t-40 {
padding-top: 40px !important;
}
.p-t-45 {
padding-top: 45px !important;
}
.p-t-50 {
padding-top: 50px !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Padding Bottom</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.p-b-0 {
padding-bottom: 0px !important;
}
.p-b-5 {
padding-bottom: 5px !important;
}
.p-b-10 {
padding-bottom: 10px !important;
}
.p-b-15 {
padding-bottom: 15px !important;
}
.p-b-20 {
padding-bottom: 20px !important;
}
.p-b-25 {
padding-bottom: 25px !important;
}
.p-b-30 {
padding-bottom: 30px !important;
}
.p-b-35 {
padding-bottom: 35px !important;
}
.p-b-40 {
padding-bottom: 40px !important;
}
.p-b-45 {
padding-bottom: 45px !important;
}
.p-b-50 {
padding-bottom: 50px !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Margin Left</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.m-l-0 {
margin-left: 0px !important;
}
.m-l-5 {
margin-left: 5px !important;
}
.m-l-10 {
margin-left: 10px !important;
}
.m-l-15 {
margin-left: 15px !important;
}
.m-l-20 {
margin-left: 20px !important;
}
.m-l-25 {
margin-left: 25px !important;
}
.m-l-30 {
margin-left: 30px !important;
}
.m-l-35 {
margin-left: 35px !important;
}
.m-l-40 {
margin-left: 40px !important;
}
.m-l-45 {
margin-left: 45px !important;
}
.m-l-50 {
margin-left: 50px !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Margin Right</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.m-r-0 {
margin-right: 0px;
}
.m-r-5 {
margin-right: 5px;
}
.m-r-10 {
margin-right: 10px;
}
.m-r-15 {
margin-right: 15px;
}
.m-r-20 {
margin-right: 20px;
}
.m-r-25 {
margin-right: 25px;
}
.m-r-30 {
margin-right: 30px;
}
.m-r-35 {
margin-right: 35px;
}
.m-r-40 {
margin-right: 40px;
}
.m-r-45 {
margin-right: 45px;
}
.m-r-50 {
margin-right: 50px;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Margin Top</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.m-t-0 {
margin-top: 0px !important;
}
.m-t-5 {
margin-top: 5px !important;
}
.m-t-10 {
margin-top: 10px !important;
}
.m-t-15 {
margin-top: 15px !important;
}
.m-t-20 {
margin-top: 20px !important;
}
.m-t-25 {
margin-top: 25px !important;
}
.m-t-30 {
margin-top: 30px !important;
}
.m-t-35 {
margin-top: 35px !important;
}
.m-t-40 {
margin-top: 40px !important;
}
.m-t-45 {
margin-top: 45px !important;
}
.m-t-50 {
margin-top: 50px !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Margin Bottom</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.m-b-0 {
margin-bottom: 0px !important;
}
.m-b-5 {
margin-bottom: 5px !important;
}
.m-b-10 {
margin-bottom: 10px !important;
}
.m-b-15 {
margin-bottom: 15px !important;
}
.m-b-20 {
margin-bottom: 20px !important;
}
.m-b-25 {
margin-bottom: 25px !important;
}
.m-b-30 {
margin-bottom: 30px !important;
}
.m-b-35 {
margin-bottom: 35px !important;
}
.m-b-40 {
margin-bottom: 40px !important;
}
.m-b-45 {
margin-bottom: 45px !important;
}
.m-b-50 {
margin-bottom: 50px !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Vertical Align</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.baseline {
vertical-align: baseline;
}
.sub {
vertical-align: sub;
}
.super {
vertical-align: super;
}
.top {
vertical-align: top;
}
.text-top {
vertical-align: text-top;
}
.middle {
vertical-align: middle;
}
.bottom {
vertical-align: bottom;
}
.text-bottom {
vertical-align: text-bottom;
}
.initial {
vertical-align: initial;
}
.inherit {
vertical-align: inherit;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Image Sizes</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.img-10 {
width: 10px !important;
}
.img-20 {
width: 20px !important;
}
.img-30 {
width: 30px !important;
}
.img-40 {
width: 40px !important;
}
.img-50 {
width: 50px !important;
}
.img-60 {
width: 60px !important;
}
.img-70 {
width: 70px !important;
}
.img-80 {
width: 80px !important;
}
.img-90 {
width: 90px !important;
}
.img-100 {
width: 100px !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Text Color</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.font-primary {
color: #ab8ce4 !important;
}
.font-secondary {
color: #26c6da !important;
}
.font-success {
color: #00c292 !important;
}
.font-danger {
color: #FF5370 !important;
}
.font-info {
color: #4099ff !important;
}
.font-light {
color: #eeeeee !important;
}
.font-dark {
color: #2a3142 !important;
}
.font-warning {
color: #f3d800 !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Badge Color</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.badge-primary {
background-color: #ab8ce4;
}
.badge-secondary {
background-color: #26c6da;
}
.badge-success {
background-color: #00c292;
}
.badge-danger {
background-color: #FF5370;
}
.badge-info {
background-color: #4099ff;
}
.badge-light {
background-color: #eeeeee;
}
.badge-dark {
background-color: #2a3142;
}
.badge-warning {
background-color: #f3d800;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Background Color</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.bg-primary {
background-color: #ab8ce4 !important;
color: #fff;
}
.bg-secondary {
background-color: #26c6da !important;
color: #fff;
}
.bg-success {
background-color: #00c292 !important;
color: #fff;
}
.bg-danger {
background-color: #FF5370 !important;
color: #fff;
}
.bg-info {
background-color: #4099ff !important;
color: #fff;
}
.bg-light {
background-color: #eeeeee !important;
color: #fff;
}
.bg-dark {
background-color: #2a3142 !important;
color: #fff;
}
.bg-warning {
background-color: #f3d800 !important;
color: #fff;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Button Color</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.btn-primary {
background-color: #ab8ce4;
border-color: #ab8ce4;
}
.btn-secondary {
background-color: #26c6da;
border-color: #26c6da;
}
.btn-success {
background-color: #00c292 !important;
color: #fff;
}
.btn-success {
background-color: #00c292;
border-color: #00c292;
}
.btn-danger {
background-color: #FF5370;
border-color: #FF5370;
}
.btn-info {
background-color: #4099ff;
border-color: #4099ff;
}
.btn-light {
background-color: #eeeeee;
border-color: #eeeeee;
}
.btn-warning {
background-color: #f3d800;
border-color: #f3d800;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Border Radius</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.b-r-0 {
border-radius: 0px !important;
}
.b-r-1 {
border-radius: 1px !important;
}
.b-r-2 {
border-radius: 2px !important;
}
.b-r-3 {
border-radius: 3px !important;
}
.b-r-4 {
border-radius: 4px !important;
}
.b-r-5 {
border-radius: 5px !important;
}
.b-r-6 {
border-radius: 6px !important;
}
.b-r-7 {
border-radius: 7px !important;
}
.b-r-8 {
border-radius: 8px !important;
}
.b-r-9 {
border-radius: 9px !important;
}
.b-r-10 {
border-radius: 10px !important;
}</pre>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <h5>Font Weight</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.f-w-100 {
font-weight: 100;
}
.f-w-300 {
font-weight: 300;
}
.f-w-400 {
font-weight: 400;
}
.f-w-600 {
font-weight: 600;
}
.f-w-700 {
font-weight: 700;
}
.f-w-900 {
font-weight: 900;
}</pre>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <h5>Font Style</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.f-s-normal {
font-style: normal;
}
.f-s-italic {
font-style: italic;
}
.f-s-oblique {
font-style: oblique;
}
.f-s-initial {
font-style: initial;
}
.f-s-inherit {
font-style: inherit;
}</pre>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <h5>Float</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.f-left {
float: left;
}
.f-right {
float: right;
}
.f-none {
float: none;
}</pre>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <h5>Overflow</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.o-hidden {
overflow: hidden;
}
.o-visible {
overflow: visible;
}
.o-auto {
overflow: auto;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Font Size</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.f-12 {
font-size: 12px;
}
.f-14 {
font-size: 14px;
}
.f-16 {
font-size: 16px;
}
.f-18 {
font-size: 18px;
}
.f-20 {
font-size: 20px;
}
.f-22 {
font-size: 22px;
}
.f-24 {
font-size: 24px;
}
.f-26 {
font-size: 26px;
}
.f-28 {
font-size: 28px;
}
.f-30 {
font-size: 30px;
}
.f-32 {
font-size: 32px;
}
.f-34 {
font-size: 34px;
}
.f-36 {
font-size: 36px;
}
.f-38 {
font-size: 38px;
}
.f-40 {
font-size: 40px;
}
.f-42 {
font-size: 42px;
}
.f-44 {
font-size: 44px;
}
.f-46 {
font-size: 46px;
}
.f-48 {
font-size: 48px;
}
.f-50 {
font-size: 50px;
}
.f-52 {
font-size: 52px;
}
.f-54 {
font-size: 54px;
}
.f-56 {
font-size: 56px;
}
.f-58 {
font-size: 58px;
}
.f-60 {
font-size: 60px;
}
.f-62 {
font-size: 62px;
}
.f-64 {
font-size: 64px;
}
.f-66 {
font-size: 66px;
}
.f-68 {
font-size: 68px;
}
.f-70 {
font-size: 70px;
}
.f-72 {
font-size: 72px;
}
.f-74 {
font-size: 74px;
}
.f-76 {
font-size: 76px;
}
.f-78 {
font-size: 78px;
}
.f-80 {
font-size: 80px;
}
.f-82 {
font-size: 82px;
}
.f-84 {
font-size: 84px;
}
.f-86 {
font-size: 86px;
}
.f-88 {
font-size: 88px;
}
.f-90 {
font-size: 90px;
}
.f-92 {
font-size: 92px;
}
.f-94 {
font-size: 94px;
}
.f-96 {
font-size: 96px;
}
.f-98 {
font-size: 98px;
}
.f-100 {
font-size: 100px;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>All Borders Color</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.b-primary {
border: 1px solid #ab8ce4 !important;
}
.b-t-primary {
border-top: 1px solid #ab8ce4 !important;
}
.b-b-primary {
border-bottom: 1px solid #ab8ce4 !important;
}
.b-l-primary {
border-left: 1px solid #ab8ce4 !important;
}
.b-r-primary {
border-right: 1px solid #ab8ce4 !important;
}
.b-secondary {
border: 1px solid #26c6da !important;
}
.b-t-secondary {
border-top: 1px solid #26c6da !important;
}
.b-b-secondary {
border-bottom: 1px solid #26c6da !important;
}
.b-l-secondary {
border-left: 1px solid #26c6da !important;
}
.b-r-secondary {
border-right: 1px solid #26c6da !important;
}
.b-success {
border: 1px solid #00c292 !important;
}
.b-t-success {
border-top: 1px solid #00c292 !important;
}
.b-b-success {
border-bottom: 1px solid #00c292 !important;
}
.b-l-success {
border-left: 1px solid #00c292 !important;
}
.b-r-success {
border-right: 1px solid #00c292 !important;
}
.b-danger {
border: 1px solid #FF5370 !important;
}
.b-t-danger {
border-top: 1px solid #FF5370 !important;
}
.b-b-danger {
border-bottom: 1px solid #FF5370 !important;
}
.b-l-danger {
border-left: 1px solid #FF5370 !important;
}
.b-r-danger {
border-right: 1px solid #FF5370 !important;
}
.b-info {
border: 1px solid #4099ff !important;
}
.b-t-info {
border-top: 1px solid #4099ff !important;
}
.b-b-info {
border-bottom: 1px solid #4099ff !important;
}
.b-l-info {
border-left: 1px solid #4099ff !important;
}
.b-r-info {
border-right: 1px solid #4099ff !important;
}
.b-light {
border: 1px solid #eeeeee !important;
}
.b-t-light {
border-top: 1px solid #eeeeee !important;
}
.b-b-light {
border-bottom: 1px solid #eeeeee !important;
}
.b-l-light {
border-left: 1px solid #eeeeee !important;
}
.b-r-light {
border-right: 1px solid #eeeeee !important;
}
.b-dark {
border: 1px solid #2a3142 !important;
}
.b-t-dark {
border-top: 1px solid #2a3142 !important;
}
.b-b-dark {
border-bottom: 1px solid #2a3142 !important;
}
.b-l-dark {
border-left: 1px solid #2a3142 !important;
}
.b-r-dark {
border-right: 1px solid #2a3142 !important;
}
.b-warning {
border: 1px solid #f3d800 !important;
}
.b-t-warning {
border-top: 1px solid #f3d800 !important;
}
.b-b-warning {
border-bottom: 1px solid #f3d800 !important;
}
.b-l-warning {
border-left: 1px solid #f3d800 !important;
}
.b-r-warning {
border-right: 1px solid #f3d800 !important;
}</pre>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Border Width</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.border-1 {
border-width: 1px !important;
}
.border-2 {
border-width: 2px !important;
}
.border-3 {
border-width: 3px !important;
}
.border-4 {
border-width: 4px !important;
}
.border-5 {
border-width: 5px !important;
}
.border-6 {
border-width: 6px !important;
}
.border-7 {
border-width: 7px !important;
}
.border-8 {
border-width: 8px !important;
}
.border-9 {
border-width: 9px !important;
}
.border-10 {
border-width: 10px !important;
}</pre>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <h5>Position</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.p-static {
position: static;
}
.p-absolute {
position: absolute;
}
.p-fixed {
position: fixed;
}
.p-relative {
position: relative;
}
.p-initial {
position: initial;
}
.p-inherit {
position: inherit;
}</pre>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <h5>Button Outline</h5>
              </div>
              <div class="card-body">
                <pre class="helper-classes">.btn-outline-primary {
border-color: #ab8ce4;
color: #ab8ce4;
background-color: transparent;
}
.btn-outline-secondary {
border-color: #26c6da;
color: #26c6da;
background-color: transparent;
}
.btn-outline-success {
border-color: #00c292;
color: #00c292;
background-color: transparent;
}
.btn-outline-danger {
border-color: #FF5370;
color: #FF5370;
background-color: transparent;
}
.btn-outline-info {
border-color: #4099ff;
color: #4099ff;
background-color: transparent;
}
.btn-outline-light {
border-color: #eeeeee;
color: #eeeeee;
background-color: transparent;
}
.btn-outline-dark {
border-color: #2a3142;
color: #2a3142;
background-color: transparent;
}
.btn-outline-warning {
border-color: #f3d800;
color: #f3d800;
background-color: transparent;
}</pre>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\ui-kits\helper-classes.blade.php ENDPATH**/ ?>