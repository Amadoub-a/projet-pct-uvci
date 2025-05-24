<?php

namespace App\Http\Controllers;

use App\Models\CopieActe;
use App\Models\DeclarationDece;
use App\Models\DeclarationMariage;
use App\Models\DeclarationNaissance;
use App\Models\Legalisation;
use App\Models\Traitement;
use Illuminate\Http\Request;

class PayementController extends Controller
{
    public function choixPayement()
    {
        $service = session('service');
        $prestation = [];

        $idDeclaration = session('declaration_id');
        $idDemande = session('demande_id');

        if ($idDemande) {
            $demande = DeclarationNaissance::find($idDemande);

            if ($demande) {
                $prestation = [
                    'id' => $demande->id,
                    'numero' => $demande->numero_demande,
                    'montant' => $demande->montant_demande,
                ];
            }
        }

        if ($idDeclaration) {
            if(str_contains(strtolower($service), 'naissance')){
                $declaration = DeclarationNaissance::find($idDeclaration);
            }
            if(str_contains(strtolower(string: $service), 'mariage')){
                $declaration = DeclarationMariage::find($idDeclaration);
            }
            if(str_contains(strtolower(string: $service), 'décès')){
                $declaration = DeclarationDece::find($idDeclaration);
            }
            if(str_contains(strtolower(string: $service), 'légalisation')){
                $declaration = Legalisation::find($idDeclaration);
            }
            if(str_contains(strtolower(string: $service), "copie d'acte")){
                $declaration = CopieActe::find($idDeclaration);
            }
            if ($declaration) {
                $prestation = [
                    'id' => $declaration->id,
                    'numero' => $declaration->numero_declaration,
                    'montant' => $declaration->montant_declaration,
                ];
            }
        }

        return view("site.front.payment", compact('prestation', 'service'));
    }

    public function paymentSuccess(Request $request){
        $service = $request->input('service');
        $prestationId = $request->input('prestation_id');
        $montant = $request->input('montant');
        $reference = $request->input('reference');

        $traitement = new Traitement();
        $traitement->client_id = $request->user()->id;
        $traitement->etat = "Enregistré";

        if(str_contains(strtolower($service), 'naissance')){
            $Naissance = DeclarationNaissance::find($prestationId);
            $traitement->declaration_naissance_id = $Naissance->id;
        }

        if(str_contains(strtolower($service), 'mariage')){
            $Mariage = DeclarationMariage::find($prestationId);
            $traitement->declaration_mariage_id = $Mariage->id;
        }

        if(str_contains(strtolower($service), 'décès')){
            $Dece = DeclarationDece::find($prestationId);
            $traitement->declaration_deces_id = $Dece->id;
        }

        if(str_contains(strtolower($service), 'légalisation')){
            $Legalisation = Legalisation::find($prestationId);
            $traitement->legalisation_id = $Legalisation->id;
        }

        if(str_contains(strtolower($service), "copie d'acte")){
            $CopieActe = CopieActe::find($prestationId);
            $traitement->copie_acte_id = $CopieActe->id;
        }

        $traitement->created_by = $request->user()->id;
        $traitement->save();

        return view('site.front.payment-success',compact( 'service','reference','montant'));
    }

    public function paymentFailed()
    {
        return view(view: 'site.front.payment-failure');
    }
}
