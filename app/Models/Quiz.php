<?php

namespace App\Models;

use App\Models\Cours;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'end_date',
        'cours_id',
        'minimum_score',
    ];

    // Relation avec le modèle `Cours`
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
