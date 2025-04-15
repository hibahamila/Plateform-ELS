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
        'formation_id',
    ];

    // Relation avec l'étudiant
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    
}
