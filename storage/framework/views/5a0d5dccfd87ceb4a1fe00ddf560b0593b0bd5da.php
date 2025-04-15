



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="formations-url" content="<?php echo e(route('formations')); ?>">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/MonCss/panier.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="panier-header">
            <h1>Panier d'achat</h1>
            <div class="panier-count"><?php echo e(count($panierItems)); ?> formation(s)</div>
        </div>
        <div id="app" data-formations-url="<?php echo e(route('formations')); ?>">

        <?php if(count($panierItems) > 0): ?>
        <div class="panier-content">
            <div class="formations-list">
                <?php $__currentLoopData = $panierItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="formation-item" data-formation-id="<?php echo e($item->formation->id); ?>">
                    <div class="formation-image">
                        <?php if($item->formation->image): ?>
                            <img src="<?php echo e(asset('storage/' . $item->formation->image)); ?>" alt="<?php echo e($item->formation->title); ?>">
                        <?php else: ?>
                            <div class="placeholder-image">Image non disponible</div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="formation-details">
                        <h3 class="formation-title"><?php echo e($item->formation->title); ?></h3>
                        <div class="formation-instructor">
                            <?php if($item->formation->user): ?>
                                 <?php echo e($item->formation->user->name); ?> <?php echo e($item->formation->user->lastname ?? ''); ?>

                                <?php if($item->formation->user->role): ?>
                                | <?php echo e($item->formation->user->role); ?>

                                <?php endif; ?>
                            <?php else: ?>
                                Instructeur non défini
                            <?php endif; ?>
                        </div>
                        
                      
                        
                        <?php if(isset($item->formation->average_rating) && $item->formation->average_rating > 0): ?>
                        <div class="formation-rating">
                            <div class="rating-stars">
                                <?php
                                    $rating = $item->formation->average_rating;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.25;
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
                                <span class="rating-value"><?php echo e(number_format($rating, 1)); ?></span>
                            </div>
                            <span class="rating-count">(<?php echo e($item->formation->total_feedbacks ?? 0); ?>)</span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="formation-meta">
                            <?php if($item->formation->duration && $item->formation->duration != '00:00'): ?>
                                <span><?php echo e(formatDuration($item->formation->duration)); ?></span>
                                <?php if(isset($item->formation->cours) && count($item->formation->cours) > 0): ?>
                                    <span class="dot-separator">•</span>
                                    <span><?php echo e(count($item->formation->cours)); ?> cours</span>
                                <?php endif; ?>
                            <?php elseif(isset($item->formation->cours) && count($item->formation->cours) > 0): ?>
                                <span> <?php echo e(count($item->formation->cours)); ?> cours</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="formation-actions">
                        
                        <div class="action-links">
                            <a href="#" class="remove-link" data-formation-id="<?php echo e($item->formation->id); ?>">Supprimer</a>
                            <a href="" class="reserve-link" data-formation-id="<?php echo e($item->formation->id); ?>">Réserver</a>
                        </div>
                        

                       
                        <div class="formation-price">
                            <?php if($item->formation->type == 'gratuite' || $item->formation->price == 0): ?>
                                <div class="final-price">Gratuite</div>
                            <?php elseif($item->formation->discount > 0): ?>
                                <div class="price-with-discount">
                                    <span class="original-price"><?php echo e(number_format($item->formation->price, 3)); ?> DT</span>
                                    <span class="discount-badge">
                                        -<?php echo e($item->formation->discount); ?>%
                                    </span>
                                </div>
                                <div class="final-price"><?php echo e(number_format($item->formation->final_price, 3)); ?> DT</div>
                            <?php else: ?>
                                <div class="final-price"><?php echo e(number_format($item->formation->price, 3)); ?> DT</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
        
            <div class="panier-summary usd-style">
                <div class="summary-title">Total:</div>
                
                <div class="total-price"><?php echo e(number_format($totalPrice, 2)); ?> Dt</div>
                
                <?php if(isset($hasDiscount) && $hasDiscount): ?>
                    <div class="original-price"><?php echo e(number_format($totalWithoutDiscount, 2)); ?> Dt</div>
                    <div class="discount-percentage"> -<?php echo e($discountPercentage); ?>%</div>
                <?php endif; ?>
                

               
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <p>Votre panier est vide</p>
            <a href="formation/formations">Découvrir des formations</a>
        </div>
        <?php endif; ?>
    </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
<script src="<?php echo e(asset('assets/js/MonJs/formations/panier.js')); ?>"></script>

<?php
function formatDuration($duration) {
    if (!$duration || $duration === '00:00' || $duration === '0:0' || $duration === '0:00' || $duration === '00:0') {
        return '0 heures';
    }
    
    $parts = explode(':', $duration);
    if (count($parts) !== 2) return '0 heures';
    
    $hours = (int)$parts[0];
    $minutes = (int)$parts[1];
    
    if ($hours === 0 && $minutes === 0) {
        return '0 heures';
    } else if ($hours === 0) {
        return $minutes . ' min';
    } else if ($minutes === 0) {
        return $hours . ' h';
    } else {
        return $hours . ',' . $minutes . ' heures totales';
    }
}
?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/apps/formation/panier.blade.php ENDPATH**/ ?>