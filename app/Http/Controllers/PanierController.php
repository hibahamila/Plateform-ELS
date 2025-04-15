<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PanierController extends Controller
{

    
public function getItemsCount()
{
    if (!Auth::check()) {
        return response()->json(['count' => 0]);
    }
    
    $userId = Auth::id();
    $count = Panier::where('user_id', $userId)->count();
    
    return response()->json(['count' => $count]);
}
public function index()
{
    // Vérifier si l'utilisateur est connecté
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à votre panier');
    }
    
    // Récupérer les formations du panier avec leurs détails
    $userId = Auth::id();
    
    $panierItems = Panier::with('formation')
                        ->where('user_id', $userId)
                        ->get();
    
    // Calculer le prix total avec et sans remise
    $totalPrice = 0;
    $totalWithoutDiscount = 0;
    $discountedItemsOriginalPrice = 0;
    $discountedItemsFinalPrice = 0;
    $hasDiscount = false;
    
    foreach ($panierItems as $item) {
        if ($item->formation && $item->formation->price) {
            $originalPrice = $item->formation->price;
            
            if ($item->formation->discount > 0) {
                $hasDiscount = true;
                $discountedPrice = $originalPrice * (1 - $item->formation->discount / 100);
                
                // Ajouter au prix des articles avec remise
                $discountedItemsOriginalPrice += $originalPrice;
                $discountedItemsFinalPrice += $discountedPrice;
                
                // Ajouter au prix total
                $totalPrice += $discountedPrice;
            } else {
                // Ajouter au prix total, mais pas dans le calcul des remises
                $totalPrice += $originalPrice;
            }
            
            // Ajouter tous les prix originaux pour le total global
            $totalWithoutDiscount += $originalPrice;
        }
        
        // Formater la durée pour chaque formation
        if ($item->formation && $item->formation->duration) {
            $item->formation->formatted_duration = $this->formatDuration($item->formation->duration);
        }
        
        // Calcul des statistiques de feedback
        $item->formation->total_feedbacks = $item->formation->feedbacks ? $item->formation->feedbacks->count() : 0;
        $item->formation->average_rating = $item->formation->total_feedbacks > 0
            ? round($item->formation->feedbacks->sum('rating_count') / $item->formation->total_feedbacks, 1)
            : 0;
    }
    
    // Calculer le pourcentage de remise seulement sur les articles avec remise
    $discountPercentage = 0;
    if ($discountedItemsOriginalPrice > 0 && $hasDiscount) {
        $discountPercentage = round(100 - ($discountedItemsFinalPrice / $discountedItemsOriginalPrice * 100));
    }
    
    return view('admin.apps.formation.panier', [
        'panierItems' => $panierItems,
        'totalPrice' => $totalPrice,
        'totalWithoutDiscount' => $totalWithoutDiscount, // Prix total sans aucune remise
        'discountedItemsOriginalPrice' => $discountedItemsOriginalPrice, // Prix original des articles avec remise
        'discountedItemsFinalPrice' => $discountedItemsFinalPrice, // Prix final des articles avec remise
        'discountPercentage' => $discountPercentage,
        'hasDiscount' => $hasDiscount
    ]);
}

private function formatDuration($duration) {
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
public function ajouter(Request $request)
{
    // Valider la requête
    $request->validate([
        'formation_id' => 'required|exists:formations,id',
    ]);

    // Vérifier si l'utilisateur est connecté
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'Vous devez être connecté pour ajouter une formation au panier'
        ], 401);
    }

    $userId = Auth::id();
    $formationId = $request->formation_id;

    // Vérifier si la formation est déjà dans le panier
    $existingItem = Panier::where('user_id', $userId)
                       ->where('formation_id', $formationId)
                       ->first();

    if ($existingItem) {
        // Si déjà dans le panier, retourner le nombre actuel d'éléments
        $cartCount = Panier::where('user_id', $userId)->count();
        return response()->json([
            'success' => true,
            'message' => 'Cette formation est déjà dans votre panier',
            'cartCount' => $cartCount
        ]);
    }

    // Ajouter la formation au panier
    $panierItem = new Panier();
    $panierItem->user_id = $userId;
    $panierItem->formation_id = $formationId;
    $panierItem->save();
    
    // Calculer le nombre d'articles APRÈS avoir ajouté le nouvel élément
    $cartCount = Panier::where('user_id', $userId)->count();

    return response()->json([
        'success' => true,
        'message' => 'Formation ajoutée au panier avec succès',
        'cartCount' => $cartCount   
    ]);
}
    

public function getFormationInfo($id)
{
    // Vérifier si la formation existe
    $formation = \App\Models\Formation::find($id);
    
    if (!$formation) {
        return response()->json([
            'success' => false,
            'message' => 'Formation non trouvée'
        ], 404);
    }
    
    // Récupérer les formations recommandées (même catégorie, pas dans le panier)
    $userId = Auth::id();
    $panierFormationIds = Panier::where('user_id', $userId)->pluck('formation_id')->toArray();
    
    $recommendations = \App\Models\Formation::where('categorie_id', $formation->categorie_id)
        ->where('id', '!=', $formation->id)
        ->whereNotIn('id', $panierFormationIds)
        ->take(3)
        ->get();
    
    return response()->json([
        'success' => true,
        'formation' => $formation,
        'recommendations' => $recommendations
    ]);
}


public function checkInCart($formationId)
{
    // Ne pas utiliser l'injection de modèle ici, mais récupérer par ID
    // pour éviter les erreurs si la formation n'existe pas
    
    if (!Auth::check()) {
        return response()->json(['in_cart' => false]);
    }
    
    $inCart = Panier::where('user_id', Auth::id())
                 ->where('formation_id', $formationId)
                 ->exists();
              
    return response()->json(['in_cart' => $inCart]);
}


    public function supprimer(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour effectuer cette action'
            ]);
        }
        
        $userId = Auth::id();
        $formationId = $request->formation_id;
        
        // Vérifier si l'article existe dans le panier
        $panierItem = Panier::where('user_id', $userId)
                            ->where('formation_id', $formationId)
                            ->first();
        
        if (!$panierItem) {
            return response()->json([
                'success' => false,
                'message' => 'Formation introuvable dans votre panier'
            ]);
        }
        
        // Supprimer l'article du panier
        $panierItem->delete();
        
        // Recalculer les totaux du panier
        $panierItems = Panier::with('formation')
                            ->where('user_id', $userId)
                            ->get();
        
        // Calculer le prix total avec et sans remise
        $totalPrice = 0;
        $totalWithoutDiscount = 0;
        $discountedItemsOriginalPrice = 0;
        $discountedItemsFinalPrice = 0;
        $hasDiscount = false;
        
        foreach ($panierItems as $item) {
            if ($item->formation && $item->formation->price) {
                $originalPrice = $item->formation->price;
                $totalWithoutDiscount += $originalPrice;
                
                if ($item->formation->discount > 0) {
                    $hasDiscount = true;
                    $discountedPrice = $originalPrice * (1 - $item->formation->discount / 100);
                    
                    // Ajouter au prix des articles avec remise
                    $discountedItemsOriginalPrice += $originalPrice;
                    $discountedItemsFinalPrice += $discountedPrice;
                    
                    // Ajouter au prix total
                    $totalPrice += $discountedPrice;
                } else {
                    $totalPrice += $originalPrice;
                }
            }
        }
        
        // Calculer le pourcentage de remise seulement sur les articles avec remise
        $discountPercentage = 0;
        if ($discountedItemsOriginalPrice > 0 && $hasDiscount) {
            $discountPercentage = round(100 - ($discountedItemsFinalPrice / $discountedItemsOriginalPrice * 100));
        }
        
        // Formater les prix pour l'affichage (sans l'unité monétaire - elle sera ajoutée côté client)
        $formattedTotalPrice = number_format($totalPrice, 3);
        $formattedTotalWithoutDiscount = number_format($totalWithoutDiscount, 3);
        $formattedDiscountedItemsOriginalPrice = number_format($discountedItemsOriginalPrice, 3);
        
        return response()->json([
            'success' => true,
            'message' => 'Formation supprimée du panier',
            'cartCount' => $panierItems->count(),
            'totalPrice' => $formattedTotalPrice,
            'totalWithoutDiscount' => $formattedTotalWithoutDiscount,
            'discountedItemsOriginalPrice' => $formattedDiscountedItemsOriginalPrice,
            'discountPercentage' => $discountPercentage,
            'hasDiscount' => $hasDiscount
        ]);
    }


}