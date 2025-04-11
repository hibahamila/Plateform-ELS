<?php

namespace App\Models;

use App\Models\Formation;
use App\Models\Quiz;
use App\Models\Chapitre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Cours extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'duration',
        'start_date',
        'end_date',
        'formation_id',
    ];

    // Relation avec Formation
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }

    // Convertit les minutes en format HH:MM
    public function minutesToTime($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        
        $result = sprintf("%02d:%02d", $hours, $remainingMinutes);
        Log::info("Cours {$this->id}: Convertir {$minutes} minutes en temps: {$result}");
        return $result;
    }
    
    // Convertit le format HH:MM en minutes
    public function timeToMinutes($time)
    {
        if (empty($time) || $time == "00:00" || strpos($time, ':') === false) {
            Log::info("Cours {$this->id}: timeToMinutes reçoit une durée invalide: " . ($time ?? 'null'));
            return 0;
        }
        
        list($hours, $minutes) = explode(':', $time);
        $result = (int)$hours * 60 + (int)$minutes;
        Log::info("Cours {$this->id}: Convertir {$time} en minutes: {$result}");
        return $result;
    }

    // Calcul de la durée totale du cours basée sur les chapitres
    public function calculateTotalDuration()
    {
        Log::info("Cours {$this->id}: Début du calcul de la durée totale");
        
        $totalMinutes = 0;
        
        // Récupère tous les chapitres associés à ce cours
        $allChapitres = $this->chapitres()->get();
        Log::info("Cours {$this->id}: Nombre de chapitres trouvés: " . $allChapitres->count());
        
        foreach ($allChapitres as $chapitre) {
            Log::info("Cours {$this->id}: Traitement du chapitre {$chapitre->id} avec durée: {$chapitre->duration}");
            $chapitreMinutes = $this->timeToMinutes($chapitre->duration);
            $totalMinutes += $chapitreMinutes;
            Log::info("Cours {$this->id}: Après ajout du chapitre {$chapitre->id}, total minutes: {$totalMinutes}");
        }
        
        $result = $this->minutesToTime($totalMinutes);
        Log::info("Cours {$this->id}: Durée totale calculée: {$result}");
        return $result;
    }
    
    // Désactivez le boot pour éviter les boucles - la mise à jour se fera via Lesson::boot()
    protected static function boot()
    {
        parent::boot();
        
        // On garde seulement le calcul au moment de la sauvegarde
        static::saving(function ($cours) {
            $cours->duration = $cours->calculateTotalDuration();
            Log::info("Cours {$cours->id}: Calcul de durée avant sauvegarde: {$cours->duration}");
        });
    }
}