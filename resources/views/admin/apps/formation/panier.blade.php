
@extends('layouts.admin.master')


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="formations-url" content="{{ route('formations') }}">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/panier.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="panier-header">
            <h1>Panier d'achat</h1>
            <div class="panier-count">{{ count($panierItems) }} formation(s)</div>
        </div>
        <div id="app" data-formations-url="{{ route('formations') }}">

        @if(count($panierItems) > 0)
        <div class="panier-content">
            <div class="formations-list">
                @foreach($panierItems as $item)
                <div class="formation-item" data-formation-id="{{ $item->formation->id }}">
                    <div class="formation-image">
                        @if($item->formation->image)
                            <img src="{{ asset('storage/' . $item->formation->image) }}" alt="{{ $item->formation->title }}">
                        @else
                            <div class="placeholder-image">Image non disponible</div>
                        @endif
                    </div>
                    
                    <div class="formation-details">
                        <h3 class="formation-title">{{ $item->formation->title }}</h3>
                        <div class="formation-instructor">
                            @if($item->formation->user)
                                 {{ $item->formation->user->name }} {{ $item->formation->user->lastname ?? '' }}
                                @if($item->formation->user->role)
                                | {{ $item->formation->user->role }}
                                @endif
                            @else
                                Instructeur non défini
                            @endif
                        </div>
                        
                      
                        
                        @if(isset($item->formation->average_rating) && $item->formation->average_rating > 0)
                        <div class="formation-rating">
                            <div class="rating-stars">
                                @php
                                    $rating = $item->formation->average_rating;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.25;
                                @endphp
                                
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <i class="fas fa-star"></i>
                                    @elseif($i == $fullStars + 1 && $hasHalfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="rating-value">{{ number_format($rating, 1) }}</span>
                            </div>
                            <span class="rating-count">({{ $item->formation->total_feedbacks ?? 0 }})</span>
                        </div>
                        @endif
                        
                        <div class="formation-meta">
                            @if($item->formation->duration && $item->formation->duration != '00:00')
                                <span>{{ formatDuration($item->formation->duration) }}</span>
                                @if(isset($item->formation->cours) && count($item->formation->cours) > 0)
                                    <span class="dot-separator">•</span>
                                    <span>{{ count($item->formation->cours) }} cours</span>
                                @endif
                            @elseif(isset($item->formation->cours) && count($item->formation->cours) > 0)
                                <span> {{ count($item->formation->cours) }} cours</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="formation-actions">
                        {{-- <a href="#" class="remove-link" data-formation-id="{{ $item->formation->id }}">Supprimer</a>
                            
                        <a href="" class="reserve-link" data-formation-id="{{ $item->formation->id }}">Réserver</a> --}}
                        <div class="action-links">
                            <a href="#" class="remove-link" data-formation-id="{{ $item->formation->id }}">Supprimer</a>
                            <a href="" class="reserve-link" data-formation-id="{{ $item->formation->id }}">Réserver</a>
                        </div>
                        {{-- <div class="cart-item" data-formation-id="{{ $item->formation->id }}">
                            <!-- Contenu de l'item -->
                            <div class="action-links">
                                <a href="#" class="remove-link" data-formation-id="{{ $item->formation->id }}">Supprimer</a>
                                <a href="" class="reserve-link" data-formation-id="{{ $item->formation->id }}">Réserver</a>
                            </div>
                        </div> --}}

                       
                        <div class="formation-price">
                            @if($item->formation->type == 'gratuite' || $item->formation->price == 0)
                                <div class="final-price">Gratuite</div>
                            @elseif($item->formation->discount > 0)
                                <div class="price-with-discount">
                                    <span class="original-price">{{ number_format($item->formation->price, 3) }} DT</span>
                                    <span class="discount-badge">
                                        -{{ $item->formation->discount }}%
                                    </span>
                                </div>
                                <div class="final-price">{{ number_format($item->formation->final_price, 3) }} DT</div>
                            @else
                                <div class="final-price">{{ number_format($item->formation->price, 3) }} DT</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        
            <div class="panier-summary usd-style">
                <div class="summary-title">Total:</div>
                
                <div class="total-price">{{ number_format($totalPrice, 2) }} Dt</div>
                
                @if(isset($hasDiscount) && $hasDiscount)
                    <div class="original-price">{{ number_format($totalWithoutDiscount, 2) }} Dt</div>
                    <div class="discount-percentage"> -{{ $discountPercentage }}%</div>
                @endif
                

               
                </div>
            </div>
        </div>
        @else
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <p>Votre panier est vide</p>
            <a href="formation/formations">Découvrir des formations</a>
        </div>
        @endif
    </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
<script src="{{ asset('assets/js/MonJs/formations/panier.js') }}"></script>

@php
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
@endphp
{{-- 
<script>
    $(document).ready(function() {
    // Fonction pour mettre à jour l'affichage du résumé du panier
    function updateCartSummary(response) {
        console.log('Mise à jour du résumé:', response);
        
        if (response.cartCount === 0) {
            return; // La gestion du panier vide est déjà faite dans la fonction principale
        }
        
        // Mise à jour du prix total (ajouter l'unité monétaire ici)
        $('.total-price').text(response.totalPrice + ' DT');
        
        // S'il y a une remise, mettre à jour l'affichage correspondant
        if (response.hasDiscount && parseFloat(response.discountedItemsOriginalPrice) > 0) {
            // Vérifier si les éléments existent déjà
            if ($('.original-price').length) {
                $('.original-price').text(response.discountedItemsOriginalPrice + ' DT');
                $('.discount-percentage').text(response.discountPercentage + '% off');
            } else {
                // Ajouter les éléments de remise après le prix total
                $('.total-price').after(`
                    <div class="original-price">${response.discountedItemsOriginalPrice} DT</div>
                    <div class="discount-percentage">${response.discountPercentage}% off</div>
                `);
            }
        } else {
            // Supprimer les éléments de remise s'ils existent
            $('.original-price, .discount-percentage').remove();
        }
    }

    // Fonction pour supprimer une formation du panier
    $(document).on('click', '.remove-link', function(e) {
        e.preventDefault();
        
        const formationId = $(this).data('formation-id');
        const $formationItem = $(this).closest('.formation-item');
        
        // Ajouter un log pour vérifier que l'événement est bien déclenché
        console.log('Tentative de suppression de la formation ID:', formationId);
        
        $.ajax({
            url: '/panier/supprimer',
            type: 'POST',
            data: {
                formation_id: formationId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Réponse du serveur:', response);
                
                if (response.success) {
                    // Supprimer l'élément du DOM
                    $formationItem.fadeOut(300, function() {
                        $(this).remove();
                        
                        // Mettre à jour le nombre d'éléments dans le panier
                        $('.panier-count').text(response.cartCount + ' formation(s)');
                        
                        // Mettre à jour le résumé du panier
                        updateCartSummary(response);
                        
                        // Si le panier est vide, afficher le message correspondant
                        if (response.cartCount === 0) {
                            $('.panier-content').replaceWith(`
                                <div class="empty-cart">
                                    <i class="fas fa-shopping-cart"></i>
                                    <p>Votre panier est vide</p>
                                    <a href="/admin/apps/formation/formations">Découvrir des formations</a>
                                </div>
                            `);
                        }
                    });
                } else {
                    alert(response.message || 'Erreur lors de la suppression de la formation');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', status, error);
                console.error('Réponse:', xhr.responseText);
                alert('Erreur lors de la communication avec le serveur');
            }
        });
    });
    
    // Fonction pour sauvegarder pour plus tard
    $(document).on('click', '.save-for-later', function(e) {
        e.preventDefault();
        alert('Fonctionnalité à implémenter: Sauvegarder pour plus tard');
    });
});
</script> --}}
