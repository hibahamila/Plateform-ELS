<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Cours;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'duree', 'type','statut', 'prix', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
