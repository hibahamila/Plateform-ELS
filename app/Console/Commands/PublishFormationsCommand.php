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
        $this->info("Exécution à : ".$now->format('Y-m-d H:i:s'));
    
        // Affiche les formations concernées
        $formations = Formation::where('status', 0)
            ->where(function($query) use ($now) {
                $query->whereNull('publish_date')
                     ->orWhere('publish_date', '<=', $now);
            })
            ->get();
    
        $this->table(
            ['ID', 'Titre', 'Date publication', 'Statut'],
            $formations->map(function($f) {
                return [
                    $f->id, 
                    $f->title,
                    $f->publish_date ?? 'NULL',
                    $f->status
                ];
            })->toArray()
        );

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


  


    // public function handle()
    // {
    //     $now = Carbon::now('Africa/Tunis');
    //     $this->info("=== Exécution à : ".$now->format('Y-m-d H:i:s')." ===");

    //     // 1. Statistiques initiales
    //     $totalFormations = Formation::count();
    //     $publishedCount = Formation::where('status', 1)->count();
    //     $unpublishedCount = Formation::where('status', 0)->count();

       
    //     // 2. Formations à publier maintenant
    //     $formationsToPublish = Formation::where('status', 0)
    //         ->where(function($query) use ($now) {
    //             $query->whereNull('publish_date')
    //                  ->orWhere('publish_date', '<=', $now);
    //         })
    //         ->get();

      

    //     // 3. Publication effective
    //     $newlyPublishedCount = 0;
    //     foreach ($formationsToPublish as $formation) {
    //         try {
    //             $formation->update(['status' => 1]);
    //             $newlyPublishedCount++;
                
    //             Log::channel('formations')->info('Formation publiée', [
    //                 'id' => $formation->id,
    //                 'title' => $formation->title,
    //                 'published_at' => $now->format('Y-m-d H:i:s')
    //             ]);
    //         } catch (\Exception $e) {
    //             Log::channel('formations')->error('Erreur publication', [
    //                 'id' => $formation->id,
    //                 'error' => $e->getMessage()
    //             ]);
    //         }
    //     }

    //     // 4. Statistiques finales
    //     $currentPublishedCount = Formation::where('status', 1)->count();
    //     $currentUnpublishedCount = Formation::where('status', 0)->count();

    //     $this->info("\n=== RÉSULTATS ===");
    //     $this->info("Nouvelles formations publiées: ".$newlyPublishedCount);
    //     $this->info("Total publiées maintenant: ".$currentPublishedCount);
    //     $this->info("Restantes non publiées: ".$currentUnpublishedCount);

    //     // 5. Affichage complet final
    //     $this->info("\n=== ÉTAT FINAL DES FORMATIONS ===");
    //     $this->table(
    //         ['ID', 'Titre', 'Statut', 'Date publication'],
    //         Formation::all()->map(function($f) {
    //             return [
    //                 $f->id,
    //                 $f->title,
    //                 $f->status ? 'PUBLIÉE' : 'NON PUBLIÉE',
    //                 $f->publish_date ? Carbon::parse($f->publish_date)->format('Y-m-d H:i:s') : 'IMMÉDIATE'
    //             ];
    //         })->toArray()
    //     );

    //     return 0;
    // }

}