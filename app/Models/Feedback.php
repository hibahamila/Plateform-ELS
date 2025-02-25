<?php

namespace App\Models;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'nombre_rate',
        'formation_id',
    ];


    //(Chaque Feedback appartient à une Formation)

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    // (Chaque Feedback appartient à un Utilisateur)

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
