<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'montant',
        'date_paiement',
        'statut',
    ];

    // Relation avec l'étudiant
    public function user()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
}
