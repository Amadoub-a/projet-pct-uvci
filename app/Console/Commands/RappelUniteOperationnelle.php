<?php

namespace App\Console\Commands;

use App\Models\Parc\Engin;
use App\Models\Parc\Mission;
use App\Services\TwilioService;
use Illuminate\Console\Command;
use App\Models\Garage\FicheEntree;
use App\Models\Organigramme\Unite;
use Illuminate\Support\Facades\DB;
use App\Jobs\ReppelEnginOperationnel;
use App\Models\Configuration\ConfigEnginOperationnel;

class RappelUniteOperationnelle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rappel-unite-operationnelle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permet d\'envoyer une notification pour signaler les unités qui ne sont pas opérationnelles.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $configEnginOperationnels = ConfigEnginOperationnel::all();

        foreach ($configEnginOperationnels as $config) {
            //Recuperation des engins à leurs dernieres affectations
            $engins = Engin::whereHas('derniereAffectation')->get();

            $enginsOperationnels = [];

            foreach ($engins as $engin) {
                if(in_array($engin->etat_engin_id, $config->etat_engins)){
                    $enginsOperationnels[] = [
                        'engin_id' => $engin->id,
                        'unite_id' => $engin->unite_id,
                        'en_mission' => $engin->en_mission,
                    ];
                }
            }

            $unites = [];

            foreach ($enginsOperationnels as $engin) {
               
                $uniteId = $engin['unite_id'] ?? null;

                if ($uniteId) {
                    if (!isset($unites[$uniteId])) {
                        $unite = Unite::find($uniteId);
                        $unites[$uniteId] = ["id" => $unite->id,"libelle_unite" => $unite->libelle_unite, "nombre_engins" => 0];
                    }
                    $unites[$uniteId]['nombre_engins']++;
                }

                $auGarage = FicheEntree::where('sortie', 0)
                                                ->where('engin_id', $engin['engin_id'])
                                                ->exists();
                if ($auGarage || $engin['en_mission']) {
                    $unites[$uniteId]['nombre_engins']--;
                }

                $data = [];
                if ($unites[$uniteId]['nombre_engins'] < $config->seuil_normal && $unites[$uniteId]['nombre_engins'] > $config->seuil_critique) {
                    $data = [
                        'titre' => 'Alerte : Engins opérationnels sous le seuil normal',
                        'message' => "L'unité ".$unites[$uniteId]['libelle_unite']." dispose actuellement de ".$unites[$uniteId]['nombre_engins']." engin(s), ce qui est inférieur à son seuil normal ({$config->seuil_normal}).",
                    ];
                }

                if ($unites[$uniteId]['nombre_engins'] < $config->seuil_critique) {
                    $data = [
                        'titre' => 'Alerte : Engins opérationnels sous le seuil critique',
                        'message' => "L'unité ".$unites[$uniteId]['libelle_unite']." dispose actuellement de ".$unites[$uniteId]['nombre_engins']." engins, ce qui est inférieur à son seuil critique ({$config->seuil_critique}).",
                    ];
                }

                if(!empty($data)){
                    ReppelEnginOperationnel::dispatch($data);
                }
            }
        }
    }
}
