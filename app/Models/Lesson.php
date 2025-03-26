<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'duration', 'chapitre_id','file_path','link'];

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }

}
