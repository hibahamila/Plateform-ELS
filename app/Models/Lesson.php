<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'description', 'duree', 'chapitre_id','file_path'];

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }

}
