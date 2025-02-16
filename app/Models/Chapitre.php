<?php

namespace App\Models;

use App\Models\Cours;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'description','duree', 'cours_id'];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
