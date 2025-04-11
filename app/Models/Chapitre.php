<?php

namespace App\Models;

use App\Models\Cours;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Chapitre extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'duration', 'cours_id'];
    
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    
    // Convertit les minutes en format HH:MM
    public function minutesToTime($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        
        return sprintf("%02d:%02d", $hours, $remainingMinutes);
    }
    
    // Convertit le format HH:MM en minutes
    public function timeToMinutes($time)
    {
        if (empty($time) || $time == "00:00" || strpos($time, ':') === false) {
            return 0;
        }
        
        list($hours, $minutes) = explode(':', $time);
        return (int)$hours * 60 + (int)$minutes;
    }
    
    // Calcul automatique de la durée totale du chapitre basée sur les leçons
    public function calculateTotalDuration()
    {
        Log::info("Chapitre {$this->id}: Début du calcul de la durée");
        
        // Si c'est un nouveau chapitre sans leçons, retourne "00:00"
        if ($this->id === null) {
            return "00:00";
        }
        
        // Calcule la somme des durées de toutes les leçons associées
        $totalMinutes = 0;
        $lessons = $this->lessons()->get();
        
        Log::info("Chapitre {$this->id}: {$lessons->count()} leçons trouvées");
        
        foreach ($lessons as $lesson) {
            $lessonMinutes = $this->timeToMinutes($lesson->duration);
            $totalMinutes += $lessonMinutes;
            Log::info("Chapitre {$this->id}: Leçon {$lesson->id} avec durée {$lesson->duration} = {$lessonMinutes} minutes");
        }
        
        $result = $this->minutesToTime($totalMinutes);
        Log::info("Chapitre {$this->id}: Durée totale calculée: {$result}");
        return $result;
    }
    
    // Accesseur pour obtenir la durée actuelle (pour affichage)
    public function getCurrentDurationAttribute()
    {
        return $this->calculateTotalDuration();
    }
    
    // Désactivez le boot pour éviter les boucles - la mise à jour se fera via Lesson::boot()
    protected static function boot()
    {
        parent::boot();
        
        // On garde seulement le calcul au moment de la sauvegarde
        static::saving(function ($chapitre) {
            $chapitre->duration = $chapitre->calculateTotalDuration();
            Log::info("Chapitre {$chapitre->id}: Calcul de durée avant sauvegarde: {$chapitre->duration}");
        });
    }
}