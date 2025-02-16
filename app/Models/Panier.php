<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Panier extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        // 'date_de_creation',
        // 'montant_total',
        // 'quantite_totale',
    ];

    // Relation avec l'étudiant
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
