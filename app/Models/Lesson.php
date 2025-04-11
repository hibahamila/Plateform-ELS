<?php

namespace App\Models;

use App\Models\Chapitre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class Lesson extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'description', 'duration', 'chapitre_id', 'link'];
    
    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }

    public function files()
{
    return $this->hasMany(File::class);
}
    
  
protected static function boot()
{
    parent::boot();
    
    static::saved(function ($lesson) {
        Log::info("Lesson {$lesson->id} sauvegardée avec durée: {$lesson->duration}");
        // Mettre à jour le chapitre parent
        if ($lesson->chapitre) {
            Log::info("Mise à jour du chapitre parent {$lesson->chapitre_id}");
            // Utiliser directement la méthode updateDuration
            DB::transaction(function () use ($lesson) {
                $chapitreId = $lesson->chapitre_id;
                $chapitre = Chapitre::find($chapitreId);
                if ($chapitre) {
                    $chapitre->duration = $chapitre->calculateTotalDuration();
                    DB::table('chapitres')->where('id', $chapitreId)->update(['duration' => $chapitre->duration]);
                    Log::info("Chapitre {$chapitreId} mis à jour avec durée: {$chapitre->duration}");
                    
                    // Mise à jour du cours parent
                    if ($chapitre->cours_id) {
                        $cours = Cours::find($chapitre->cours_id);
                        if ($cours) {
                            $cours->duration = $cours->calculateTotalDuration();
                            DB::table('cours')->where('id', $cours->id)->update(['duration' => $cours->duration]);
                            Log::info("Cours {$cours->id} mis à jour avec durée: {$cours->duration}");
                            
                            // Mise à jour de la formation parente
                            if ($cours->formation_id) {
                                $formation = Formation::find($cours->formation_id);
                                if ($formation) {
                                    $formation->duration = $formation->calculateTotalDuration();
                                    DB::table('formations')->where('id', $formation->id)->update(['duration' => $formation->duration]);
                                    Log::info("Formation {$formation->id} mise à jour avec durée: {$formation->duration}");
                                }
                            }
                        }
                    }
                }
            });
        }
    });
    
    static::deleted(function ($lesson) {
        if ($lesson->chapitre) {
            $lesson->chapitre->duration = $lesson->chapitre->calculateTotalDuration();
            DB::table('chapitres')->where('id', $lesson->chapitre_id)->update(['duration' => $lesson->chapitre->duration]);
        }
    });

}
}