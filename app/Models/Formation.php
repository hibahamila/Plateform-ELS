<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Cours;
use App\Models\Feedback;
use App\Models\Lesson;
use App\Models\Panier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'duration', 
        'type',
        'status', 
        'start_date',
        'end_date',
        'price',
        'discount',       
        'final_price',   
        'image',
        'publish_date',
        'categorie_id', 
        'user_id'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
    
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Convertit les minutes en format HH:MM
    public function minutesToTime($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        
        $result = sprintf("%02d:%02d", $hours, $remainingMinutes);
        Log::info("Formation {$this->id}: Convertir {$minutes} minutes en temps: {$result}");
        return $result;
    }
    
    // Convertit le format HH:MM en minutes
    public function timeToMinutes($time)
    {
        if (empty($time) || $time == "00:00" || strpos($time, ':') === false) {
            Log::info("Formation {$this->id}: timeToMinutes reçoit une durée invalide: " . ($time ?? 'null'));
            return 0;
        }
        
        list($hours, $minutes) = explode(':', $time);
        $result = (int)$hours * 60 + (int)$minutes;
        Log::info("Formation {$this->id}: Convertir {$time} en minutes: {$result}");
        return $result;
    }
    
    // Calcul de la durée totale de la formation basée sur les cours
    public function calculateTotalDuration()
    {
        Log::info("Formation {$this->id}: Début du calcul de la durée totale");
        
        $totalMinutes = 0;
        
        // Récupère tous les cours associés à cette formation
        $allCours = $this->cours()->get();
        Log::info("Formation {$this->id}: Nombre de cours trouvés: " . $allCours->count());
        
        foreach ($allCours as $cours) {
            Log::info("Formation {$this->id}: Traitement du cours {$cours->id} avec durée: {$cours->duration}");
            $courseMinutes = $this->timeToMinutes($cours->duration);
            $totalMinutes += $courseMinutes;
            Log::info("Formation {$this->id}: Après ajout du cours {$cours->id}, total minutes: {$totalMinutes}");
        }
        
        $result = $this->minutesToTime($totalMinutes);
        Log::info("Formation {$this->id}: Durée totale calculée: {$result}");
        return $result;
    }
    
    // Accesseur pour obtenir la durée calculée
    public function getDurationCalculatedAttribute()
    {
        return $this->calculateTotalDuration();
    }
    
    // Désactivez le boot pour éviter les boucles - la mise à jour se fera via Lesson::boot()
    protected static function boot()
    {
        parent::boot();
        
        // On garde seulement le calcul au moment de la sauvegarde
        static::saving(function ($formation) {
            $formation->duration = $formation->calculateTotalDuration();
            Log::info("Formation {$formation->id}: Calcul de durée avant sauvegarde: {$formation->duration}");
        });
    }



    //zedtouu tww
    // Accesseur pour vérifier si la formation est dans le panier
    public function getInCartAttribute()
    {
        if (!Auth::check()) {
            return false;
        }
        
        return Panier::where('user_id', Auth::id())
                   ->where('formation_id', $this->id)
                   ->exists();
    }
}