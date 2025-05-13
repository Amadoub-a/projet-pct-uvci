<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Services\SmsService;
use Illuminate\Console\Command;
use App\Jobs\EnvoyerSmsRappelRdv;
use App\Models\Garage\RendezVous;
use App\Models\Organigramme\Unite;
use App\Models\Configuration\ConfigJourRdv;

class CommandeEnvoyerRappelRdv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:envoyer-rappel-rendez-vous';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie des SMS de rappel aux admins si un rendez vous est a quelques jours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jourConfigure = ConfigJourRdv::where("choix_defini", 1)->first();

        $nombre_jour = $jourConfigure ? $jourConfigure->nombre_jour : 0;

        $dateRdv = Carbon::now()->addDays($nombre_jour)->toDateString();
        $rendezvous = RendezVous::whereDate('date_rendez_vous', $dateRdv)->get();

        $unites = Unite::whereIn('id', $rendezvous->pluck('unite_id'))->get()->keyBy('id');

        foreach ($rendezvous as $rdv) {
            $unite = $unites->get($rdv->unite_id);

            if ($unite) {
                $data = [
                    'titre' => 'Rappel de rendez-vous',
                    'message' => "Votre rendez-vous avec l'unité {$unite->libelle_unite} pour {$rdv->motif->libelle_motif} est dans {$jourConfigure->nombre_jour} jour(s).",
                ];

                EnvoyerSmsRappelRdv::dispatch($data);
            }
        }
    }
}
