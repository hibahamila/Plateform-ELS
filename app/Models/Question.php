<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'enonce'];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
        //un question est associé a un seul devoir 
    }


    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }

}
