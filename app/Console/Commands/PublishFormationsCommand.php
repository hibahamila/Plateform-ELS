<?php

namespace App\Console\Commands;

use App\Models\Formation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PublishFormationsCommand extends Command
{
    protected $signature = 'formations:publish';
    protected $description = 'Publie les formations programmées (heure Tunis)';

    public function handle()
    {
        $now = Carbon::now('Africa/Tunis');

        Log::channel('formations')->info('Début de la publication des formations', [
            'now' => $now->format('Y-m-d H:i:s'),
            'timezone' => 'Africa/Tunis'
        ]);

        // Récupère les formations non publiées avec date de publication dépassée
        $formations = Formation::where('status', 0)
            ->where(function($query) use ($now) {
                $query->whereNull('publish_date')
                      ->orWhere('publish_date', '<=', $now);
            })
            ->get();

        $publishedCount = 0;

        foreach ($formations as $formation) {
            try {
                $formation->update(['status' => 1]);
                $publishedCount++;

                Log::channel('formations')->info('Formation publiée', [
                    'id' => $formation->id,
                    'title' => $formation->title,
                    'publish_date' => $formation->publish_date,
                    'published_at' => $now->format('Y-m-d H:i:s')
                ]);
            } catch (\Exception $e) {
                Log::channel('formations')->error('Erreur publication formation', [
                    'id' => $formation->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $this->info("{$publishedCount} formations publiées avec succès");
        return 0;
    }
}