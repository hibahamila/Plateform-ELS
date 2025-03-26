<?php

namespace App\Models;

use App\Models\Formation;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'user_id',
        'formation_id',
    ];

    // // Relation avec Professeur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec Formation
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
   /**
     * Relation One-to-Many : Un cours a plusieurs devoirs.
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
