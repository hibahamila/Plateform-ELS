<div class="categories-filter">
    <div class="categories-wrapper">
        <button class="nav-button prev-button" style="display: none;">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="categories-slider">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="category-item <?php echo e(request()->get('categorie_id') == $category->id || (request()->get('categorie_id') === null && $loop->first) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('formations', ['categorie_id' => $category->id])); ?>" 
                   class="category-link" 
                   data-category-id="<?php echo e($category->id); ?>">
                    <span class="category-title"><?php echo e($category->title); ?></span>
                    <span class="participant-count">+ <?php echo e($category->formations_count ?? 0); ?> de participants</span>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="nav-button next-button">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/categories-filter.css')); ?>">
<script src="<?php echo e(asset('assets/js/MonJs/categorie/categorie-filter.js')); ?>"></script>

<?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/categorie/categories-filter.blade.php ENDPATH**/ ?>