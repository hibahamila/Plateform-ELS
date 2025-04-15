
<?php $__env->startSection('title'); ?>
    Liste des Formations <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/formations-gallery.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/formations-details.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/formation-detail-interaction.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/formations-details.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php echo $__env->make('admin.apps.categorie.categories-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row project-cards">
            <div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 p-0">
                            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>Tous</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Publiées</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Non publiées</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 p-0">
                            <a class="btn btn-primary custom-btn" href="<?php echo e(route('formationcreate')); ?>">
                                <i data-feather="plus-square"></i>Ajouter une formation
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
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

                        <?php if(session('create')): ?>
                            <div class="alert alert-info" id="create-message">
                                <?php echo e(session('create')); ?>

                            </div>
                        <?php endif; ?>

                        <div class="tab-content" id="top-tabContent">
                            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


                            <!-- Toutes les formations -->
                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                <div class="carousel-container">
                                    <div class="formations-carousel">
                                        <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div>
                                                <div class="formation-card" >
                                                  
                                                    <?php if($formation->status && isset($formation->is_bestseller) && $formation->is_bestseller): ?>
                                                        <span class="badge-bestseller">Meilleure vente</span>
                                                    <?php endif; ?>
                                                    
                                                    <?php if($formation->image): ?>
                                                        <img src="<?php echo e(asset('storage/' . $formation->image)); ?>" alt="<?php echo e($formation->title); ?>">
                                                    <?php else: ?>
                                                        <div class="placeholder-image">Image de formation</div>
                                                    <?php endif; ?>
                                                    
                                                    <h4 class="formation-title"><?php echo e($formation->title); ?></h4>
                                                    <div class="formation-instructor">
                                                        <?php if($formation->user): ?>
                                                            <?php echo e($formation->user->name); ?> <?php echo e($formation->user->lastname ?? ''); ?>

                                                        <?php else: ?>
                                                            Professeur non défini
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="formation-details">
                                                        <div class="formation-duration">
                                                            
                                                            <span class="formation-duration-value" style="display: none;"><?php echo e($formation->duration); ?></span>
                                                        </div>
                                                        <div class="formation-courses-count">
                                                            
                                                            <span class="formation-courses-count-value" style="display: none;"><?php echo e($formation->cours->count()); ?></span> cours
                                                        </div>
                                                    </div>

                                
                                                   
                                                    <div class="formation-description" style="display: none;"><?php echo $formation->description; ?></div>
                                                            <div class="formation-rating-price">
                                                                <div class="formation-rating">
                                                                    <?php if(isset($formation->average_rating) && $formation->average_rating !== null && ($formation->total_feedbacks ?? 0) > 0): ?>
                                                                        <span class="rating-value"><?php echo e(number_format($formation->average_rating, 1)); ?></span>
                                                                        <span class="rating-stars">
                                                                            <?php
                                                                                $rating = $formation->average_rating;
                                                                                $fullStars = floor($rating);
                                                                                $decimalPart = $rating - $fullStars;
                                                                                $hasHalfStar = $decimalPart >= 0.25; // Seuil à 0.25 pour plus de précision
                                                                            ?>
                                                            
                                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                                <?php if($i <= $fullStars): ?>
                                                                                    <i class="fas fa-star"></i> <!-- Étoile pleine -->
                                                                                <?php elseif($i == $fullStars + 1 && $hasHalfStar): ?>
                                                                                    <i class="fas fa-star-half-alt"></i> <!-- Demi-étoile -->
                                                                                <?php else: ?>
                                                                                    <i class="far fa-star"></i> <!-- Étoile vide -->
                                                                                <?php endif; ?>
                                                                            <?php endfor; ?>
                                                                        </span>
                                                                        <span class="rating-count">(<?php echo e($formation->total_feedbacks); ?>)</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                        <div class="price-container">
                                                            <?php if($formation->discount > 0): ?>
                                                                <div style="display: flex; align-items: center;">
                                                                    <span class="original-price"><?php echo e(number_format($formation->price, 3)); ?> DT</span>
                                                                    <span class="discount-badge">-<?php echo e($formation->discount); ?>%</span>
                                                                </div>
                                                                <span class="final-price"><?php echo e(number_format($formation->final_price, 3)); ?> DT</span>
                                                            <?php else: ?>
                                                                <span class="final-price"><?php echo e(number_format($formation->price, 3)); ?> DT</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="action-icons">
                                                        <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="<?php echo e(route('formationedit', $formation->id)); ?>"></i>
                                                        <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="<?php echo e(route('formationdestroy', $formation->id)); ?>" data-csrf="<?php echo e(csrf_token()); ?>"></i>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Formations publiées -->
        <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
        <div class="carousel-container">
            <div class="formations-carousel-published">
                <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($formation->status): ?>
                        <div>
                            <div class="formation-card">
                                <?php if(isset($formation->is_bestseller) && $formation->is_bestseller): ?>
                                    <span class="badge-bestseller">Meilleure vente</span>
                                <?php endif; ?>
                                
                                <?php if($formation->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $formation->image)); ?>" alt="<?php echo e($formation->title); ?>">
                                <?php else: ?>
                                    <div class="placeholder-image">Image de formation</div>
                                <?php endif; ?>
                                
                                <h4 class="formation-title"><?php echo e($formation->title); ?></h4>
                                <div class="formation-instructor">
                                    <?php if($formation->user): ?>
                                        <?php echo e($formation->user->name); ?> <?php echo e($formation->user->lastname ?? ''); ?>

                                    <?php else: ?>
                                        Professeur non défini
                                    <?php endif; ?>
                                </div>
                            
                            <div class="formation-description" style="display: none;"><?php echo $formation->description; ?></div>

                            <div class="formation-rating-price">
                                <div class="formation-rating">
                                    <?php if(isset($formation->average_rating) && $formation->average_rating !== null && ($formation->total_feedbacks ?? 0) > 0): ?>
                                        <span class="rating-value"><?php echo e(number_format($formation->average_rating, 1)); ?></span>
                                        <span class="rating-stars">
                                            <?php
                                                $rating = $formation->average_rating;
                                                $fullStars = floor($rating);
                                                $decimalPart = $rating - $fullStars;
                                                $hasHalfStar = $decimalPart >= 0.25; // Seuil à 0.25 pour plus de précision
                                            ?>
                            
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php if($i <= $fullStars): ?>
                                                    <i class="fas fa-star"></i> <!-- Étoile pleine -->
                                                <?php elseif($i == $fullStars + 1 && $hasHalfStar): ?>
                                                    <i class="fas fa-star-half-alt"></i> <!-- Demi-étoile -->
                                                <?php else: ?>
                                                    <i class="far fa-star"></i> <!-- Étoile vide -->
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </span>
                                        <span class="rating-count">(<?php echo e($formation->total_feedbacks); ?>)</span>
                                    <?php endif; ?>
                                </div>
    
                                <div class="price-container">
                                    <?php if($formation->price == 0): ?>
                                        <span class="final-price">Gratuit</span>
                                    <?php else: ?>
                                        <?php if($formation->discount > 0): ?>
                                            <div style="display: flex; align-items: center;">
                                                <span class="original-price"><?php echo e(number_format($formation->price, 3)); ?> DT</span>
                                                <span class="discount-badge">-<?php echo e($formation->discount); ?>%</span>
                                            </div>
                                            <span class="final-price"><?php echo e(number_format($formation->final_price, 3)); ?> DT</span>
                                        <?php else: ?>
                                            <span class="final-price"><?php echo e(number_format($formation->price, 3)); ?> DT</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="action-icons">
                                <i class="icofont icofont-ui-edit edit-icon action-icon" data-edit-url="<?php echo e(route('formationedit', $formation->id)); ?>"></i>
                                <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="<?php echo e(route('formationdestroy', $formation->id)); ?>" data-csrf="<?php echo e(csrf_token()); ?>"></i>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
                            <!-- Formations non publiées -->
                                <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                    <div class="carousel-container">
                                        <div class="formations-carousel-unpublished">
                                            <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!$formation->status): ?>
                                                    <div>
                                                        <div class="formation-card" >
                                                            <?php if($formation->status && isset($formation->is_bestseller) && $formation->is_bestseller): ?>
                                                                <span class="badge-bestseller">Meilleure vente</span>
                                                            <?php endif; ?>
                                                            
                                                            <?php if($formation->image): ?>
                                                                <img src="<?php echo e(asset('storage/' . $formation->image)); ?>" alt="<?php echo e($formation->title); ?>">
                                                            <?php else: ?>
                                                                <div class="placeholder-image">Image de formation</div>
                                                            <?php endif; ?>
                                                            
                                                            <h4 class="formation-title"><?php echo e($formation->title); ?></h4>
                                                            <div class="formation-instructor">
                                                                <?php if($formation->user): ?>
                                                                    <?php echo e($formation->user->name); ?> <?php echo e($formation->user->lastname ?? ''); ?>

                                                                <?php else: ?>
                                                                    Professeur non défini
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="formation-description" style="display: none;"><?php echo $formation->description; ?></div>




                                                            <div class="formation-rating-price">
                                                                <div class="formation-rating">
                                                                    <?php if(isset($formation->average_rating) && $formation->average_rating !== null && ($formation->total_feedbacks ?? 0) > 0): ?>
                                                                        <span class="rating-value"><?php echo e(number_format($formation->average_rating, 1)); ?></span>
                                                                        <span class="rating-stars">
                                                                            <?php
                                                                                $rating = $formation->average_rating;
                                                                                $fullStars = floor($rating);
                                                                                $decimalPart = $rating - $fullStars;
                                                                                $hasHalfStar = $decimalPart >= 0.25;
                                                                            ?>
                                                            
                                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                                <?php if($i <= $fullStars): ?>
                                                                                    <i class="fas fa-star"></i>
                                                                                <?php elseif($i == $fullStars + 1 && $hasHalfStar): ?>
                                                                                    <i class="fas fa-star-half-alt"></i>
                                                                                <?php else: ?>
                                                                                    <i class="far fa-star"></i>
                                                                                <?php endif; ?>
                                                                            <?php endfor; ?>
                                                                        </span>
                                                                        <span class="rating-count">(<?php echo e($formation->total_feedbacks); ?>)</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="price-container">
                                                                    <?php if($formation->discount > 0): ?>
                                                                        <div style="display: flex; align-items: center;">
                                                                            <span class="original-price"><?php echo e(number_format($formation->price, 3)); ?> DT</span>
                                                                            <span class="discount-badge">-<?php echo e($formation->discount); ?>%</span>
                                                                        </div>
                                                                        <span class="final-price"><?php echo e(number_format($formation->final_price, 3)); ?> DT</span>
                                                                    <?php else: ?>
                                                                        <span class="final-price"><?php echo e(number_format($formation->price, 3)); ?> DT</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="action-icons">
                                                                <i class="icofont icofont-ui-edit edit-icon action-icon" data-edit-url="<?php echo e(route('formationedit', $formation->id)); ?>"></i>
                                                                <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="<?php echo e(route('formationdestroy', $formation->id)); ?>" data-csrf="<?php echo e(csrf_token()); ?>"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>


                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropdown/dropdown.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/formation-gallery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/formation-filter.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/formation-detail-interaction.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/cart-modal.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/add-to-cart.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/confirmation-panel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/formation-card.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/detail-panel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/cart-manager.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/cart-modal-panier.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/MonJs/formations/cart-core.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/MonJs/formations/cart-ui.js')); ?>"></script>









<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/formation/formations.blade.php ENDPATH**/ ?>