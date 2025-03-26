<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'payment_date',
        'status',
    ];

    // Relation avec l'étudiant
    public function user()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
}
