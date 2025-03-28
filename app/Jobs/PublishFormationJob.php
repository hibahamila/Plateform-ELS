<?php

namespace App\Jobs;

use App\Models\Formation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PublishFormationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        // Le constructeur peut rester vide
    }

    public function handle()
    {
        // Définir le fuseau horaire de la Tunisie
        Carbon::setLocale('fr');
        date_default_timezone_set('Africa/Tunis');

        // Récupérer l'heure actuelle dans le fuseau horaire de la Tunisie
        $now = Carbon::now('Africa/Tunis');

        // Récupérer les formations à publier
        $formations = Formation::where('status', 0)
            ->whereNotNull('publish_date')
            ->where('publish_date', '<=', $now)
            ->get();

        foreach ($formations as $formation) {
            try {
                // Mettre à jour le statut de la formation
                $formation->update([
                    'status' => 1, // Publié
                    'published_at' => $now
                ]);

                // Journaliser la publication
                Log::info("Formation publiée automatiquement : {$formation->id} - {$formation->title}");
            } catch (\Exception $e) {
                // Journaliser les erreurs éventuelles
                Log::error("Erreur de publication pour la formation {$formation->id}: " . $e->getMessage());
            }
        }

        Log::info("Vérification des formations à publier terminée. {$formations->count()} formations publiées.");
    }
}